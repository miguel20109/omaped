<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersonasModel;
use App\Models\SexoModel;
use App\Models\TipoDocumentoModel;
use App\Models\CorrelativoModel;
use App\Models\UbigeoRegionModel;
use App\Models\UbigeoProvinciaModel;
use App\Models\UbigeoDistritoModel;

class PersonasController extends BaseController
{

    private $persona, $sexo, $session, $correlativo, $tipodocumento, $region, $provincia, $distrito;

    public function __construct()
    {
        $this->persona = new PersonasModel();
        $this->sexo = new SexoModel();
		$this->tipodocumento = new TipoDocumentoModel();
		$this->correlativo = new CorrelativoModel();
		$this->region = new UbigeoRegionModel();
		$this->provincia = new UbigeoProvinciaModel();
		$this->distrito = new UbigeoDistritoModel();

        helper(['form']);
        $this->session = session();
    }

    public function index()
    {
        if (!verificar('listar personas', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
        $data['active'] = 'personas';
        return view('personas/index', $data);
    }

    public function listar()
    {
        $data = $this->persona->select("dni, concat(apaterno,' ',amaterno,' ',nombres) as nombres, direccion, telefono, updated_at")->where('estado', '1')->orderBy('updated_at', 'DESC')->findAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function new()
    {
        if (!verificar('nuevo personas', $this->session->permisos)) {
            return view('permisos');
            exit;
        }

        $data['cbregion'] = $this->region->findAll();
        $data['cbprovincia'] = $this->provincia->where('ID', '0000')->findAll();
		$data['cbdistrito'] = $this->distrito->where('ID', '000000')->findAll();
		
        $data['sexo'] = $this->sexo->findAll();
		$data['tipodocumento'] = $this->tipodocumento->findAll();
		//$data['estadocivil'] = $this->estadocivil->findAll();
        $data['active'] = 'personas';
        return view('personas/nuevo', $data);
    }

    public function create()
    {

        if ($this->request->is('post') && verificar('nuevo personas', $this->session->permisos)) {

/*
                'dni' => [
                    'rules' => 'required|min_length[8]'
                ],
*/
            $this->reglas = [
                'nombre' => [
                    'rules' => 'required|min_length[3]',
                ],
                'apellido_pat' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'El apellido paterno es obligatorio',
                        'min_length' => 'El apellido paterno debe tener al menos 3 caracteres de longitud.',
                    ]
                ],
                'apellido_mat' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'El apellido paterno es obligatorio',
                        'min_length' => 'El apellido paterno debe tener al menos 3 caracteres de longitud.',
                    ]
                ],
                'direccion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Registrar una dirección es obligatorio.',
						'min_length' => 'La dirección debe tener al menos 2 caracteres de longitud.',
                    ]
                ],
                'cbsexo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'seleccionar el sexo es obligatorio'
                    ]
                ]
            ];
			
			$cbtiporegistro = $this->request->getVar('cbtiporegistro');
			
			$dni = $this->request->getVar('dni');
			
			$tipos = array('E', 'N', 'S');
			
			if (in_array($cbtiporegistro, $tipos, true)) {
				
				$nro['contador'] = $this->correlativo->where('inicial', $cbtiporegistro)->first();
				$secuencia = $nro['contador']['Numero'] + 1;
				
				$this->correlativo->where('inicial', $cbtiporegistro)->set(['Numero' => $secuencia])->update();
				
				$nro['contador'] = $this->correlativo->where('inicial', $cbtiporegistro)->first();
				$secuencia = $nro['contador']['Numero'];
				
				$dni = $cbtiporegistro . str_pad($secuencia, 7, "0", STR_PAD_LEFT);
			}
			
            if ($this->request->is('post') && $this->validate($this->reglas)) {
				
				$foto = $this->request->getVar('foto');
				
                $data = [
					'IDtipo_documento' => $this->request->getVar('cbtipodocumento'),
                    'DNI' => $dni,
                    'apaterno' => $this->request->getVar('apellido_pat'),
                    'amaterno' => $this->request->getVar('apellido_mat'),
                    'nombres' => $this->request->getVar('nombre'),
                    'fecha_nacimiento' => $this->request->getVar('fechanacimiento'),
                    'IDsexo' => $this->request->getVar('cbsexo'),
                    'direccion' => $this->request->getVar('direccion'),
                    'telefono' => $this->request->getVar('telefono'),
                    'correo' => $this->request->getVar('correo'),
                    'estado_civil' => $this->request->getVar('estado_civil'),
                    'ubigeo' => $this->request->getVar('ubigeo'),
                    'restriccion' => $this->request->getVar('restriccion'),
                    'estado' => '1',
                    'foto' => $foto,
                    'fecha_fallecimiento' => $this->request->getVar('fechafallecimiento'),
					'region' => $this->request->getVar('cbregion'),
					'provincia' => $this->request->getVar('cbprovincia'),
					'distrito' => $this->request->getVar('cbdistrito'),
					'referencia' => $this->request->getVar('referencia')
                ];
				
				$foto = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $foto);
				//descarga foto

				$baseFromJavascript = "data:image/png;base64," . $foto;

				// elimine la parte que no necesitamos de la imagen proporcionada y decodifíquela
				$fotodata = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));

				$filepath = "./img_dni/" . $dni . ".png"; // or image.jpg

				// Guarde la imagen en una ruta definida
				file_put_contents($filepath, $fotodata);
				
                if ($this->persona->insert($data) === false) {
                    $data['errors'] = $this->persona->errors();
                    $data['active'] = 'personas';
                    return view('personas/nuevo', $data);
                }
                return redirect()->to(base_url('personas'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'PERSONA REGISTRADA',
                ]);
            } else {
                $data['validacion'] = $this->validator();
				$data['cbregion'] = $this->region->findAll();
				$data['cbprovincia'] = $this->provincia->where('ID', '0000')->findAll();
				$data['cbdistrito'] = $this->distrito->where('ID', '000000')->findAll();
                $data['sexo'] = $this->sexo->findAll();
				$data['tipodocumento'] = $this->tipodocumento->findAll();
                $data['active'] = 'personas';
                return view('personas/nuevo', $data);
            }
        } else {
            return view('permisos');
        }
    }

    public function edit($idPersona)
    {
        if (!verificar('editar personas', $this->session->permisos)) {
            return view('permisos');
            exit;
        }

        $data['sexo'] = $this->sexo->findAll();
		$data['tipodocumento'] = $this->tipodocumento->findAll();
        $data['persona'] = $this->persona->where('DNI', $idPersona)->first();
		$cbregion = $data['persona']['region'];
		$cbprovincia = $data['persona']['provincia'];
		
        $data['cbregion'] = $this->region->findAll();
        $data['cbprovincia'] = $this->provincia->like('ID', $cbregion, 'after')->findAll();
		$data['cbdistrito'] = $this->distrito->like('ID', $cbprovincia, 'after')->findAll();
		
        $data['active'] = 'personas';
        return view('personas/edit', $data);
    }

    public function update($idPersona)
    {
        //if ($this->request->is('put') && verificar('editar personas', $this->session->permisos)){
        if ($this->request->is('put')) {
            $data = [
                'apaterno' => $this->request->getVar('apellido_pat'),
                'amaterno' => $this->request->getVar('apellido_mat'),
                'nombres' => $this->request->getVar('nombre'),
                'fecha_nacimiento' => $this->request->getVar('fechanacimiento'),
                'IDsexo' => $this->request->getVar('cbsexo'),
                'direccion' => $this->request->getVar('direccion'),
                'telefono' => $this->request->getVar('telefono'),
                'correo' => $this->request->getVar('correo'),
                'estado_civil' => $this->request->getVar('estado_civil'),
                'ubigeo' => $this->request->getVar('ubigeo'),
                'restriccion' => $this->request->getVar('restriccion'),
				'region' => $this->request->getVar('cbregion'),
				'provincia' => $this->request->getVar('cbprovincia'),
				'distrito' => $this->request->getVar('cbdistrito'),
				'referencia' => $this->request->getVar('referencia')
            ];

            if ($this->persona->update($idPersona, $data) === false) {
                $data['errors'] = $this->persona->errors();
                $data['cliente'] = $this->persona->where('DNI', $idPersona)->first();
                $data['active'] = 'personas';
                return view('personas/edit', $data);
            }

            return redirect()->to(base_url('personas'))->with('respuesta', [
                'type' => 'success',
                'msg' => 'PERSONA MODIFICADO',
            ]);
        } else {
            return view('permisos');
        }
    }

    public function consultardni($dni)
    {

        $rows = $this->persona->where('DNI', $dni)->countAllResults();

        if ($rows == 0) {

            $url = "http://172.16.20.31/Pide-2/apilocal/webservice.php?dni=$dni&usuario=APIlocal&clave=APIlocal";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $data = curl_exec($ch);
            curl_close($ch);

            $datajson = json_decode($data);

            $ApePaterno = trim($datajson->consultarResponse->return->datosPersona->apPrimer);
            $ApePaterno = str_replace("'", "\'", $ApePaterno);
            $ApeMaterno = trim($datajson->consultarResponse->return->datosPersona->apSegundo);
            $ApeMaterno = str_replace("'", "\'", $ApeMaterno);
            $Nombres = trim($datajson->consultarResponse->return->datosPersona->prenombres);
            $Nombres = str_replace("'", "\'", $Nombres);
            $Direccion = trim($datajson->consultarResponse->return->datosPersona->direccion);
            $Direccion = str_replace("'", "\'", $Direccion);
            $EstadoCivil = trim($datajson->consultarResponse->return->datosPersona->estadoCivil);
            $Ubigeo = trim($datajson->consultarResponse->return->datosPersona->ubigeo);
            $Restriccion = trim($datajson->consultarResponse->return->datosPersona->restriccion);
            $FotoPer = $datajson->consultarResponse->return->datosPersona->foto;
            $FotoPer = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $FotoPer);

            $this->persona->insert([
                'DNI' => $dni,
                'apaterno' => $ApePaterno,
                'amaterno' => $ApeMaterno,
                'nombres' => $Nombres,
                'direccion' => $Direccion,
                'estado_civil' => $EstadoCivil,
                'ubigeo' => $Ubigeo,
                'restriccion' => $Restriccion,
                'estado' => '1',
                'foto' => $FotoPer
            ]);

            curl_close($ch);

            //descarga foto

            $baseFromJavascript = "data:image/png;base64," . $FotoPer;

            // elimine la parte que no necesitamos de la imagen proporcionada y decodifíquela
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));

            $filepath = "./img_dni/" . $dni . ".png"; // or image.jpg

            // Guarde la imagen en una ruta definida
            file_put_contents($filepath, $data);
        }

        $data = $this->persona->where('DNI', $dni)->first();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function consultarpide($dni)
    {

        if (strlen($dni) == 8) {

            $url = "http://172.16.20.31/Pide-2/apilocal/webservice.php?dni=$dni&usuario=APIlocal&clave=APIlocal";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $data = curl_exec($ch);
            curl_close($ch);

            $datajson = json_decode($data);

            $ApePaterno = trim($datajson->consultarResponse->return->datosPersona->apPrimer);
            $ApePaterno = str_replace("'", "\'", $ApePaterno);
            $ApeMaterno = trim($datajson->consultarResponse->return->datosPersona->apSegundo);
            $ApeMaterno = str_replace("'", "\'", $ApeMaterno);
            $Nombres = trim($datajson->consultarResponse->return->datosPersona->prenombres);
            $Nombres = str_replace("'", "\'", $Nombres);
            $Direccion = trim($datajson->consultarResponse->return->datosPersona->direccion);
            $Direccion = str_replace("'", "\'", $Direccion);
            $EstadoCivil = trim($datajson->consultarResponse->return->datosPersona->estadoCivil);
            $Ubigeo = trim($datajson->consultarResponse->return->datosPersona->ubigeo);
            $Restriccion = trim($datajson->consultarResponse->return->datosPersona->restriccion);
            $FotoPer = $datajson->consultarResponse->return->datosPersona->foto;
            $FotoPer = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $FotoPer);

            $data = array(
                'DNI' => $dni,
                'apaterno' => $ApePaterno,
                'amaterno' => $ApeMaterno,
                'nombres' => $Nombres,
                'direccion' => $Direccion,
                'estado_civil' => $EstadoCivil,
                'ubigeo' => $Ubigeo,
                'restriccion' => $Restriccion,
                'estado' => '1',
                'foto' => $FotoPer
            );

            curl_close($ch);
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function consultardni_old2($dni)
    {

        $webservice_url = "https://previ.pe/previ/formularios/dniapi.php";

        $data_post = array('user_id' => '42066094');

        $rows = $this->persona->where('DNI', $dni)->countAllResults();

        if ($rows == 0) {

            $url = "https://previ.pe/previ/formularios/dniapi.php";

            $fields = array('user_id' => $dni); //Lima

            $fields_string = http_build_query($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            $data = curl_exec($ch);
            curl_close($ch);

            $datajson = json_decode($data);

            $ApePaterno = trim($datajson->apellidoPaterno);
            $ApePaterno = str_replace("'", "\'", $ApePaterno);
            $ApeMaterno = trim($datajson->apellidoMaterno);
            $ApeMaterno = str_replace("'", "\'", $ApeMaterno);
            $Nombres = trim($datajson->nombres);
            $Nombres = str_replace("'", "\'", $Nombres);

            $this->persona->insert([
                'DNI' => $dni,
                'apaterno' => $ApePaterno,
                'amaterno' => $ApeMaterno,
                'nombres' => $Nombres,
                'direccion' => '',
                'estadocivil' => '',
                'ubigeo' => '',
                'restriccion' => 'TEMPORAL 3',
                'estado' => '1',
                'foto' => ''
            ]);

            curl_close($ch);

            //descarga foto
            /*
            $baseFromJavascript = "data:image/png;base64," . $FotoPer;

            // elimine la parte que no necesitamos de la imagen proporcionada y decodifíquela
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));

            $filepath = "./img_dni/" . $dni . ".png"; // or image.jpg

            // Guarde la imagen en una ruta definida
            file_put_contents($filepath, $data);
            */
        }

        $data = $this->persona->where('DNI', $dni)->first();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function consultardni_old($dni)
    {

        $webservice_url = "http://172.16.20.31/ws_pide/Reniec.svc?wsdl";

        $request_param = '<?xml version="1.0" encoding="utf-8"?>
		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
		   <soapenv:Header/>
		   <soapenv:Body>
			  <tem:GetDatosPersonasReniec>
				 <!--Optional:-->
				 <tem:NroDocumento>' . $dni . '</tem:NroDocumento>
			  </tem:GetDatosPersonasReniec>
		   </soapenv:Body>
		</soapenv:Envelope>';

        $headers = array(
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: http://tempuri.org/IReniec/GetDatosPersonasReniec',
            'Content-Length: ' . strlen($request_param)
        );

        $rows = $this->persona->where('DNI', $dni)->countAllResults();

        //bloqueador por que dejo de funcionar el api

        if ($rows == 0) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $webservice_url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request_param);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);

            $data = curl_exec($ch);

            $soap = simplexml_load_string($data);

            $soap->registerXPathNamespace('a', 'http://schemas.datacontract.org/2004/07/WCF_PideMdc');

            $ApePaterno = trim($soap->xpath('//a:ApePaterno')[0]);
            $ApePaterno = str_replace("'", "\'", $ApePaterno);
            $ApeMaterno = trim($soap->xpath('//a:ApeMaterno')[0]);
            $ApeMaterno = str_replace("'", "\'", $ApeMaterno);
            $Nombres = trim($soap->xpath('//a:Nombres')[0]);
            $Nombres = str_replace("'", "\'", $Nombres);
            $Direccion = trim($soap->xpath('//a:Direccion')[0]);
            $Direccion = str_replace("'", "\'", $Direccion);
            $EstadoCivil = trim($soap->xpath('//a:EstadoCivil')[0]);
            $Ubigeo = trim($soap->xpath('//a:Ubigeo')[0]);
            $Restriccion = trim($soap->xpath('//a:Restriccion')[0]);
            $FotoPer = $soap->xpath('//a:FotoPer')[0];
            $FotoPer = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $FotoPer);

            $this->persona->insert([
                'DNI' => $dni,
                'apaterno' => $ApePaterno,
                'amaterno' => $ApeMaterno,
                'nombres' => $Nombres,
                'direccion' => $Direccion,
                'estadocivil' => $EstadoCivil,
                'ubigeo' => $Ubigeo,
                'restriccion' => $Restriccion,
                'estado' => '1',
                'foto' => $FotoPer
            ]);

            curl_close($ch);

            //descarga foto

            $baseFromJavascript = "data:image/png;base64," . $FotoPer;

            // elimine la parte que no necesitamos de la imagen proporcionada y decodifíquela
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));

            $filepath = "./img_dni/" . $dni . ".png"; // or image.jpg

            // Guarde la imagen en una ruta definida
            file_put_contents($filepath, $data);
        }

        $data = $this->persona->where('DNI', $dni)->first();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
	
    public function cbprovincia($id)
    {
        $data = $this->provincia->like('ID', $id, 'after')->orderBy('ID', 'ASC')->findAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
	
    public function cbdistrito($id)
    {
        $data = $this->distrito->like('ID', $id, 'after')->orderBy('ID', 'ASC')->findAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
