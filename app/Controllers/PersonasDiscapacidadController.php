<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\PersonasModel;
use App\Models\PersonasfallecidasModel;
use App\Models\PersonasDiscapacidadModel;
use App\Models\PersonasubicacionModel;
use App\Models\PersonasubicacionhistorialModel;
use App\Models\CementeriosModel;
use App\Models\LugarModel;
use App\Models\SepulturaModel;
use App\Models\TramiteModel;
use App\Models\CorrelativoModel;
use App\Models\OrdenModel;
use App\Models\SolicitudModel;
use App\Models\AutorizacionesModel;
use App\Models\UsuariosModel;
use App\Models\AniosModel;
use App\Models\MesesModel;
use App\Models\SexoModel;
use App\Models\TipoDocumentoModel;
use App\Models\ContenedorOmapedModel;
use App\Models\PersonasDiscapacidadSaludModel;
use App\Models\PersonasDiscapacidadFamiliarModel;

class PersonasDiscapacidadController extends BaseController
{

    private $fallecidos, $persona, $roles, $reglas, $session, $cementerios, $lugar, $ubicacion, $ubicacionhistorial, $sepultura, $tramite, $correlativo, $ordenes, $solicitud, $autorizaciones, $usuarios, $meses, $anios, $sexo, $tipodocumento, $combos, $personadiscapacitada, $salud, $familiar;

    public function __construct()
    {
        $this->persona = new PersonasModel();
        $this->fallecidos = new PersonasfallecidasModel();
        $this->ubicacion = new PersonasubicacionModel();
        $this->ubicacionhistorial = new PersonasubicacionhistorialModel();
        $this->roles = new RolesModel();
        $this->cementerios = new CementeriosModel();
        $this->lugar = new LugarModel();
        $this->sepultura = new SepulturaModel();
        $this->tramite = new TramiteModel();
        $this->correlativo = new CorrelativoModel();
        $this->ordenes = new OrdenModel();
        $this->solicitud = new SolicitudModel();
        $this->autorizaciones = new AutorizacionesModel();
        $this->usuarios = new UsuariosModel();
        $this->anios = new AniosModel();
        $this->meses = new MesesModel();
        $this->sexo = new SexoModel();
        $this->tipodocumento = new TipoDocumentoModel();
        $this->personadiscapacitada = new PersonasDiscapacidadModel();
        $this->combos = new ContenedorOmapedModel();
        $this->salud = new PersonasDiscapacidadSaludModel();
		$this->familiar = new PersonasDiscapacidadFamiliarModel();

        helper(['form']);
        $this->session = session();
    }

    public function index()
    {
        if (!verificar('listar fallecidos', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
        $data['active'] = 'fallecidos';
        return view('personasfallecidas/index', $data);
    }

    public function listar()
    {
        $this->fallecidos->select("a.dni, concat(a.apaterno,' ',a.amaterno,' ',a.nombres) as nombres, concat(b.apaterno,' ',b.amaterno,' ',b.nombres) as declarante, b.telefono, personas_fallecidas.iddeclarante, personas_fallecidas.updated_at");
        $this->fallecidos->join('personas as a', 'personas_fallecidas.dni = a.dni');
        $data = $this->fallecidos->join('personas as b', 'personas_fallecidas.iddeclarante = b.dni')->orderBy('updated_at', 'DESC')->findAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function new($dni)
    {
        if (!verificar('nuevo personas', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
        $this->persona->select("
			 personas.*
			,b.id
			,b.idvivienda
			,b.idviven
			,b.idconstruccion
			,b.idservicios
			,b.espadre
			,b.contacto
			,b.telefono
			,b.numerohijos
			,b.idinstruccion
			,b.idestudios
			,b.noestudia
			,b.oficio
			,b.limita_capacidad
			,b.gustaria_capacitarse
			,b.trabaja
			,b.trabajaen
			,b.ingreso_mensual
			,b.idcondicion_laboral
			,b.trabajo_antes
            ,b.idorigendiscapacidad
            ,b.discapacidad_otro
            ,b.fecha_discapacidad
            ,b.idrehabilitacion
            ,b.tipo_rehabilitacion
            ,b.personas_discapacidad
            ,b.idactividad
            ,b.respuesta_actividad
            ,b.idorganizacion
            ,b.respuesta_organizacion
            ,b.trabajo
            ,b.vivienda
            ,b.transporte
            ,b.comunidad
            ,b.ancho
            ,b.profundidad
            ,b.altura
            ,b.observacion_vivienda
            ,b.observacion_salud
            ,b.observacion_economica
            ,b.observacion
            ,b.recomendaciones
            ,b.croquis
			,b.certificado
			,b.institucion_otorgo
			,b.carnet_conadis
			,b.seguro
			,b.apoderado
			,b.carnet_vigencia
			,b.cuantos_viven
			,b.sugerencias
			,b.limita_trabajo
		");
        $data['persona'] = $this->persona->join('personas_discapacidad as b', 'personas.DNI = b.DNI', 'LEFT')->where('personas.DNI', $dni)->first();

        $data['sexo'] = $this->sexo->findAll();
        $data['tipodocumento'] = $this->tipodocumento->findAll();
        $data['cbvivienda'] = $this->combos->where(['idtabla' => '3', 'indicador' => '2'])->findAll();
        $data['cbvivenforma'] = $this->combos->where(['idtabla' => '8', 'indicador' => '2'])->findAll();
        $data['cbconstruccion'] = $this->combos->where(['idtabla' => '13', 'indicador' => '2'])->findAll();
        $data['cbservicios'] = $this->combos->where(['idtabla' => '18', 'indicador' => '2'])->findAll();
        $data['cbinstruccion'] = $this->combos->where(['idtabla' => '23', 'indicador' => '2'])->findAll();
        $data['cbestudios'] = $this->combos->where(['idtabla' => '33', 'indicador' => '2'])->findAll();
        $data['cbsino'] = $this->combos->where(['idtabla' => '38', 'indicador' => '2'])->findAll();
        $data['cbcondicion_laboral'] = $this->combos->where(['idtabla' => '41', 'indicador' => '2'])->findAll();
        $data['cbsalud'] = $this->combos->where(['idtabla' => '47', 'indicador' => '2'])->findAll();
        $data['cborigendiscapacidad'] = $this->combos->where(['idtabla' => '89', 'indicador' => '2'])->findAll();
		$data['cbactividad_discapacidad'] = $this->combos->where(['idtabla' => '95', 'indicador' => '2'])->findAll();
		$data['cbsegurosalud'] = $this->combos->where(['idtabla' => '163', 'indicador' => '2'])->findAll();

        $data['active'] = 'personas';
        return view('personasdiscapacidad/nuevo', $data);
    }

    public function create()
    {

        if ($this->request->is('post') && verificar('nuevo personas', $this->session->permisos)) {

            $dni = $this->request->getVar('dni');
            $id_discapacidad = $this->request->getVar('id_discapacidad');
            $buscar = empty($id_discapacidad) ? '1' : '2';


            if ($this->request->is('post')) {
                $data = [
                    'DNI' => $dni,
                    'idvivienda' => $this->request->getVar('cbvivienda'),
                    'idviven' => $this->request->getVar('cbvivenforma'),
                    'idconstruccion' => $this->request->getVar('cbconstruccion'),
                    'idservicios' => $this->request->getVar('cbservicios'),
                    'espadre' => $this->request->getVar('cbespadre'),
                    'contacto' => $this->request->getVar('contacto'),
                    'telefono' => $this->request->getVar('telefono'),
                    'numerohijos' => $this->request->getVar('numero_hijos'),
                    'idinstruccion' => $this->request->getVar('cbinstruccion'),
                    'idestudios' => $this->request->getVar('cbestudios'),
                    'oficio' => $this->request->getVar('oficio'),
                    'noestudia' => $this->request->getVar('noestudia'),
                    'limita_capacidad' => $this->request->getVar('limita_capacidad'),
                    'gustaria_capacitarse' => $this->request->getVar('gustaria_capacitarse'),
                    'trabaja' => $this->request->getVar('cbtrabaja'),
                    'trabajaen' => $this->request->getVar('trabajaen'),
                    'ingreso_mensual' => $this->request->getVar('ingreso_mensual'),
                    'idcondicion_laboral' => $this->request->getVar('cbcondicion_laboral'),
                    'trabajo_antes' => $this->request->getVar('cbtrabajo_anteriormente'),
                    'idorigendiscapacidad' => $this->request->getVar('cborigendiscapacidad'),
                    'discapacidad_otro' => $this->request->getVar('discapacidad_otro'),
                    'fecha_discapacidad' => $this->request->getVar('fecha_discapacidad'),   
                    'idrehabilitacion' => $this->request->getVar('cbrehabilitacion'), 
                    'tipo_rehabilitacion' => $this->request->getVar('tipo_rehabilitacion'), 
                    'personas_discapacidad' => $this->request->getVar('personas_discapacidad'),
                    'idactividad' => $this->request->getVar('cbactividad'), 
                    'respuesta_actividad' => $this->request->getVar('respuesta_actividad'),
                    'idorganizacion' => $this->request->getVar('cborganizacion'), 
                    'respuesta_organizacion' => $this->request->getVar('respuesta_organizacion'),
                    'trabajo' => $this->request->getVar('cbtrabajo'),
                    'vivienda' => $this->request->getVar('cbvivienda2'),
                    'transporte' => $this->request->getVar('cbtransporte'),
                    'comunidad' => $this->request->getVar('cbcomunidad'),
                    'ancho' => $this->request->getVar('ancho'),
                    'profundidad' => $this->request->getVar('profundidad'),
                    'altura' => $this->request->getVar('altura'),
                    'observacion_vivienda' => $this->request->getVar('observacion_vivienda'),
                    'observacion_salud' => $this->request->getVar('observacion_salud'),
                    'observacion_economica' => $this->request->getVar('observacion_economica'),
                    'observacion' => $this->request->getVar('observacion'),
                    'recomendaciones' => $this->request->getVar('recomendaciones'),
                    'croquis' => $this->request->getVar('croquis'),
					'certificado' => $this->request->getVar('cbcertificado'),
					'institucion_otorgo' => $this->request->getVar('institucion_otorgo'),
					'carnet_conadis' => $this->request->getVar('cbcarnet_conadis'),
					'seguro' => $this->request->getVar('cbsegurosalud'),
					'apoderado' => $this->request->getVar('apoderado'),
					'carnet_vigencia' => $this->request->getVar('carnet_vigencia'),
					'cuantos_viven' => $this->request->getVar('cuantos_viven'),
					'sugerencias' => $this->request->getVar('sugerencias'),
					'limita_trabajo' => $this->request->getVar('limita_trabajo')
                ];

                if ($buscar == '1') {
                    if ($this->personadiscapacitada->insert($data) === false) {
                        $data['errors'] = $this->persona->errors();
                        $data['active'] = 'personas';
                        return view('personas/nuevo', $data);
                    }
                }

                if ($buscar == '2') {
                    if ($this->personadiscapacitada->where('DNI', $dni)->set($data)->update() === false) {
                        $data['errors'] = $this->persona->errors();
                        $data['persona'] = $this->persona->where('DNI', $dni)->first();
                        $data['active'] = 'personas';
                        return view('personasfallecidas/edit', $data);
                    }
                }

                return redirect()->to(base_url('personas'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'PERSONA REGISTRADA',
                ]);
            } else {
                $data['persona'] = $this->persona->where('DNI', $dni)->first();
                $data['sexo'] = $this->sexo->findAll();
                $data['tipodocumento'] = $this->tipodocumento->findAll();
                $data['cbvivienda'] = $this->combos->where(['idtabla' => '3', 'indicador' => '2'])->findAll();
                $data['cbvivenforma'] = $this->combos->where(['idtabla' => '8', 'indicador' => '2'])->findAll();
                $data['cbconstruccion'] = $this->combos->where(['idtabla' => '13', 'indicador' => '2'])->findAll();
                $data['cbservicios'] = $this->combos->where(['idtabla' => '18', 'indicador' => '2'])->findAll();
                $data['active'] = 'personas';
                return view('personas/nuevo', $data);
            }
        } else {
            return view('permisos');
        }
    }

    public function declarar($dni, $declarante, $fecha)
    {
        //if ($this->request->is('post') && verificar('nuevo cliente', $this->session->permisos)){

        //if ($this->request->is('post')){

        $data_persona = [
            'fecha_fallecimiento' => $fecha
        ];

        $this->persona->where('dni', $dni)->set($data_persona)->update();

        $data_difunto = [
            'DNI' => $dni,
            'IDdeclarante' => $declarante,
            'IDcementerio' => '0',
            'IDlugar' => '0',
            'procedencia' => '',
            'estado' => '1',
        ];

        $this->fallecidos->insert($data_difunto);

        $data_ubicacion = [
            'DNI' => $dni,
            'IDsolicitante' => $declarante,
            'subiendo' => '0.00',
            'izquierda' => '0.00',
            'derecha' => '0.00',
            'columna' => '0.00',
            'nivel' => '0.00',
            'largo' => '0.00',
            'ancho' => '0.00',
            'alto' => '0.00',
            'IDsepultura' => '0',
        ];

        $this->ubicacion->insert($data_ubicacion);

        $data['dni'] = $dni;
        echo json_encode($data);
        die();
    }

    public function edit($idPersona)
    {

        if (!verificar('editar fallecidos', $this->session->permisos)) {
            return view('permisos');
            exit;
        }

        $data['cementerios'] = $this->cementerios->findAll();
        $data['lugar'] = $this->lugar->findAll();
        $data['sepultura'] = $this->sepultura->findAll();
        $data['tramite'] = $this->tramite->findAll();
        $data['usuarios'] = $this->usuarios->where('estado', '1')->orderBy('nombre', 'ASC')->findAll();

        $data['persona'] = $this->persona->where('DNI', $idPersona)->first();

        $this->fallecidos->select("a.dni, personas_fallecidas.IDdeclarante, IDcementerio, IDlugar, procedencia, concat(a.apaterno,' ',a.amaterno,' ',a.nombres) as declarante, a.telefono");
        $data['fallecidos'] = $this->fallecidos->join('personas as a', 'personas_fallecidas.IDdeclarante = a.dni')->where('personas_fallecidas.dni', $idPersona)->first();


        $data['ubicacion'] = $this->ubicacion->where('DNI', $idPersona)->first();

        $data['active'] = 'fallecidos';
        return view('personasfallecidas/edit', $data);
    }

    public function update($idPersona)
    {
        //if ($this->request->is('put') && verificar('editar cliente', $this->session->permisos)){
        if ($this->request->is('put')) {

            $data_difunto = [
                'IDcementerio' => $this->request->getVar('cbcementerio'),
                'IDlugar' => $this->request->getVar('cblugar'),
                'procedencia' => $this->request->getVar('procedencia')
            ];

            $data_ubicacion = [
                'subiendo' => $this->request->getVar('subiendo'),
                'columna' => $this->request->getVar('columna'),
                'largo' => $this->request->getVar('largo'),
                'izquierda' => $this->request->getVar('izquierda'),
                'nivel' => $this->request->getVar('nivel'),
                'ancho' => $this->request->getVar('ancho'),
                'derecha' => $this->request->getVar('derecha'),
                'alto' => $this->request->getVar('alto'),
                'IDsepultura' => $this->request->getVar('cbsepultura'),
                'IDencargado' => $this->request->getVar('cbusuarios')
            ];

            //if ($this->fallecidos->update($idPersona, $data) === false) {

            if ($this->fallecidos->where('dni', $idPersona)->set($data_difunto)->update() === false) {
                //$data['errors'] = $this->fallecidos->errors();
                $data['fallecidos'] = $this->fallecidos->where('DNI', $idPersona)->first();
                //$data['active'] = 'cliente';
                //return view('personasfallecidas/edit', $data);
            }

            if ($this->ubicacion->where('dni', $idPersona)->set($data_ubicacion)->update() === false) {
                $data['errors'] = $this->fallecidos->errors();
                $data['ubicacion'] = $this->ubicacion->where('DNI', $idPersona)->first();
                $data['active'] = 'fallecidos';
                return view('personasfallecidas/edit', $data);
            }

            return redirect()->to(base_url('personasfallecidas/' . $idPersona . '/edit'))->with('respuesta', [
                'type' => 'success',
                'msg' => 'DECLARACION MODIFICADO',
            ]);
        } else {
            return view('permisos');
        }
    }

    public function generacroquis()
    {
        $dni_difunto = $this->request->getVar('dni_difunto');
        $dni_solicitante = $this->request->getVar('dni_solicitante');
        $cbtramite = $this->request->getVar('cbtramite');
        $idcementerio = $this->request->getVar('id_cementerio');

        if ($this->request->is('post') || $cbtramite <> '0') {

            $nro['correlativo'] = $this->correlativo->where('id', '3')->first();
            $secuencia = $nro['correlativo']['Numero'] + 1;
            $anio = $nro['correlativo']['Anio'];

            $this->correlativo->update('3', ['Numero' => $secuencia]);

            $nro['correlativo'] = $this->correlativo->where('id', '3')->first();
            $secuencia = $nro['correlativo']['Numero'];
            $anio = $nro['correlativo']['Anio'];

            $row['ubicacion'] = $this->ubicacion->where('DNI', $dni_difunto)->first();

            $numero = str_pad($secuencia, 5, "0", STR_PAD_LEFT) . '-' . $anio;

            $subiendo = $row['ubicacion']['subiendo'];
            $izquierda = $row['ubicacion']['izquierda'];
            $derecha = $row['ubicacion']['derecha'];
            $columna = $row['ubicacion']['columna'];
            $nivel = $row['ubicacion']['nivel'];
            $largo = $row['ubicacion']['largo'];
            $ancho = $row['ubicacion']['ancho'];
            $alto = $row['ubicacion']['alto'];
            $IDsepultura = $row['ubicacion']['IDsepultura'];

            $data = $this->ubicacionhistorial->insert([
                'numero' => $numero,
                'DNI' => $dni_difunto,
                'IDsolicitante' => $dni_solicitante,
                'IDtramite' => $cbtramite,
                'subiendo' => $subiendo,
                'izquierda' => $izquierda,
                'derecha' => $derecha,
                'columna' => $columna,
                'nivel' => $nivel,
                'largo' => $largo,
                'ancho' => $ancho,
                'alto' => $alto,
                'IDcementerio' => $idcementerio,
                'IDsepultura' => $IDsepultura
            ]);

            if ($data > 0) {
                return redirect()->to(base_url('personasfallecidas/' . $dni_difunto . '/edit'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'CROQUIS REGISTRADO',
                ]);
            } else {
                return redirect()->to(base_url('personasfallecidas/' . $dni_difunto . '/edit'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL REGISTRAR',
                ]);
            }
        } else {
            //$data['validacion'] = $this->validator;
            //$data['anios'] = $this->anios->where('ID <=', $year)->findAll();
            //$data['rol'] = $this->request->getVar('rol');
            $data['active'] = 'fallecidos';
            return view('personasfallecidas/' . $dni_difunto . '/edit', $data);
        }
    }

    public function listardiscapacidad($idPersona)
    {

        $this->salud->select("
         personas_discapacidad_salud.ID
        ,personas_discapacidad_salud.IdPersona
        ,personas_discapacidad_salud.idcontenedor
        ,personas_discapacidad_salud.respuesta
        ,a.descripcion as discapacidad
		,b.descripcion as discapacidad_en
		,b.idtabla"
        );
        $this->salud->join('contenedor_omaped as a', 'personas_discapacidad_salud.idcontenedor = a.ID');
		$data = $this->salud->join('contenedor_omaped as b', 'b.ID = a.value')->where(['personas_discapacidad_salud.IdPersona'=>$idPersona, 'personas_discapacidad_salud.idtabla'=>'47', 'personas_discapacidad_salud.estado'=>'1'])->orderBy('b.idtabla', 'ASC')->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listaractividades($idPersona)
    {

        $this->salud->select("
         personas_discapacidad_salud.ID
        ,personas_discapacidad_salud.IdPersona
        ,personas_discapacidad_salud.idcontenedor
        ,personas_discapacidad_salud.respuesta
        ,a.descripcion as discapacidad
		,b.descripcion as discapacidad_en
		,b.idtabla"
        );
        $this->salud->join('contenedor_omaped as a', 'personas_discapacidad_salud.idcontenedor = a.ID');
		$data = $this->salud->join('contenedor_omaped as b', 'b.ID = a.value')->where(['personas_discapacidad_salud.IdPersona'=>$idPersona, 'personas_discapacidad_salud.idtabla'=>'95', 'personas_discapacidad_salud.estado'=>'1'])->orderBy('b.idtabla', 'ASC')->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
	
    public function listarfamiliar($idPersona)
    {
		$data = $this->familiar->where(['IdPersona' => $idPersona, 'estado'=>'1'])->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
	
    public function agregardiscapacidad($dni, $cdsalud, $cbrespuesta)
    {

        $data = $this->salud->insert([
            'IdPersona' => $dni,
            'idcontenedor' => $cdsalud,
            'respuesta' => $cbrespuesta,
			'idtabla' => '47',
        ]);

        if ($data > 0) {
            return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                'type' => 'success',
                'msg' => 'ORDEN REGISTRADA',
            ]);
        } else {
            return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                'type' => 'danger',
                'msg' => 'ERROR AL REGISTRAR',
            ]);
        }
    }

    public function agregaractividades($dni, $cbactividad_discapacidad, $cbrespuesta_actividad)
    {

        $data = $this->salud->insert([
            'IdPersona' => $dni,
            'idcontenedor' => $cbactividad_discapacidad,
            'respuesta' => $cbrespuesta_actividad,
			'idtabla' => '95',
        ]);

        if ($data > 0) {
            return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                'type' => 'success',
                'msg' => 'ORDEN REGISTRADA',
            ]);
        } else {
            return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                'type' => 'danger',
                'msg' => 'ERROR AL REGISTRAR',
            ]);
        }
    }
	
    public function agregarfamiliar($dni, $nombres_completos, $edad, $parentesco, $ocupacion, $instruccion)
    {
        $data = $this->familiar->insert([
            'IdPersona' => $dni,
            'nombres_completos' => $nombres_completos,
            'edad' => $edad,
			'parentesco' => $parentesco,
			'ocupacion' => $ocupacion,
			'instruccion' => $instruccion,
        ]);

        if ($data > 0) {
            return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                'type' => 'success',
                'msg' => 'ORDEN REGISTRADA',
            ]);
        } else {
            return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                'type' => 'danger',
                'msg' => 'ERROR AL REGISTRAR',
            ]);
        }
    }
	
    public function listaorden($idPersona)
    {

        $this->ordenes->select("orden_inhumacion.ID, numero, concat(a.apaterno,' ',a.amaterno,' ',a.nombres) as declarante, a.telefono");
        $data = $this->ordenes->join('personas as a', 'orden_inhumacion.IDdeclarante = a.dni')->where('orden_inhumacion.IDdifunto', $idPersona)->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generasolicitud()
    {
        $dni_difunto = $this->request->getVar('dni_difunto');
        $dni_solicitante = $this->request->getVar('dni_solicitante');
        $cbtramite = $this->request->getVar('cbtramite');
        $idcementerio = $this->request->getVar('id_cementerio');
        $idsepultura = $this->request->getVar('id_sepultura');

        if ($this->request->is('post') || $cbtramite <> '0') {

            $nro['correlativo'] = $this->tramite->where('id', $cbtramite)->first();
            $secuencia = $nro['correlativo']['contador'] + 1;
            $anio = $nro['correlativo']['anio'];
            $monto = $nro['correlativo']['monto'];

            $this->tramite->update($cbtramite, ['contador' => $secuencia]);

            $nro['correlativo'] = $this->tramite->where('id', $cbtramite)->first();
            $secuencia = $nro['correlativo']['contador'];
            $anio = $nro['correlativo']['anio'];

            $row['ubicacion'] = $this->ubicacion->where('DNI', $dni_difunto)->first();

            $numero = str_pad($secuencia, 5, "0", STR_PAD_LEFT) . '-' . $anio;

            $data = $this->solicitud->insert([
                'numero' => $numero,
                'IDdifunto' => $dni_difunto,
                'IDsolicitante' => $dni_solicitante,
                'IDcementerio' => $idcementerio,
                'IDsepultura' => $idsepultura,
                'IDtramite' => $cbtramite,
                'monto' => $monto,
            ]);

            if ($data > 0) {
                return redirect()->to(base_url('personasfallecidas/' . $dni_difunto . '/edit'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'SOLICITUD REGISTRADA',
                ]);
            } else {
                return redirect()->to(base_url('personasfallecidas/' . $dni_difunto . '/edit'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL REGISTRAR',
                ]);
            }
        } else {
            //$data['validacion'] = $this->validator;
            //$data['anios'] = $this->anios->where('ID <=', $year)->findAll();
            //$data['rol'] = $this->request->getVar('rol');
            $data['active'] = 'fallecidos';
            return view('personasfallecidas/' . $dni_difunto . '/edit', $data);
        }
    }

    public function listasolicitud($idPersona)
    {

        $this->solicitud->select("solicitudes.ID, numero, concat(a.apaterno,' ',a.amaterno,' ',a.nombres) as solicitante, a.telefono, b.Descripcion as tramite, b.reporte");
        $this->solicitud->join('personas as a', 'solicitudes.IDsolicitante = a.dni');
        $data = $this->solicitud->join('tramite as b', 'solicitudes.IDtramite = b.ID', 'LEFT')->where('solicitudes.IDdifunto', $idPersona)->where('solicitudes.estado', '1')->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function solicitudes()
    {
        if (!verificar('listar solicitudes', $this->session->permisos)) {
            return view('permisos');
            exit;
        }

        $data['anios'] = $this->anios->findAll();
        $data['meses'] = $this->meses->findAll();
        $data['tramite'] = $this->tramite->findAll();
        $data['active'] = 'solicitudes';

        $data['anio'] = date('Y');
        $data['mes'] = date('m');

        return view('personasfallecidas/solicitudes', $data);
    }

    public function listasolicitudes($cbtramite, $mes, $anio)
    {
        //$where = null;
        //$where = array('b.ID' => '1');
        //$where = array('numero' => $cbtramite);

        $where = "b.ID=$cbtramite and DATE_FORMAT(solicitudes.created_at, '%m')=$mes and DATE_FORMAT(solicitudes.created_at, '%Y')=$anio and solicitudes.estado in('1','2')";

        $this->solicitud->select("solicitudes.ID, numero, concat(a.apaterno,' ',a.amaterno,' ',a.nombres) as solicitante, a.telefono, b.Descripcion as tramite, b.reporte, solicitudes.IDtramite, solicitudes.estado");
        $this->solicitud->join('personas as a', 'solicitudes.IDsolicitante = a.dni');
        $data = $this->solicitud->join('tramite as b', 'solicitudes.IDtramite = b.ID', 'LEFT')->where($where)->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editsolicitud($id)
    {
        /*
        if (!verificar('editar cliente', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
		*/

        $data['solicitud'] = $this->solicitud->where('ID', $id)->first();
        $data['tramite'] = $this->tramite->where('ID', $data['solicitud']['IDtramite'])->first();
        $data['persona'] = $this->persona->where('DNI', $data['solicitud']['IDsolicitante'])->first();
        $data['active'] = 'solicitudes';

        return view('personasfallecidas/editsolicitud', $data);
    }

    public function updatesolicitud($id)
    {
        //if ($this->request->is('put') && verificar('editar cliente', $this->session->permisos)){
        if ($this->request->is('post')) {

            $data_solicitud = [
                'expediente' => $this->request->getVar('numero'),
                'fecha_expediente' => $this->request->getVar('fecha_exp'),
                'recibo' => $this->request->getVar('recibo'),
                'fecha_pago' => $this->request->getVar('fecha_pago'),
                'recibos' => $this->request->getVar('recibos')
            ];

            if ($this->solicitud->where('id', $id)->set($data_solicitud)->update() === false) {
                //$data['errors'] = $this->fallecidos->errors();
                // $data['ubicacion'] = $this->ubicacion->where('DNI', $idPersona)->first();
                $data['active'] = 'solicitudes';
                return view('personasfallecidas/' . $id . '/editsolicitud', $data);
            }

            return redirect()->to(base_url('personasfallecidas/' . $id . '/editsolicitud'))->with('respuesta', [
                'type' => 'success',
                'msg' => 'SOLICITUD MODIFICADA',
            ]);
        } else {
            return view('permisos');
        }
    }

    public function listaautorizaciones($cbtramite, $mes, $anio)
    {
        //$where = null;
        //$where = array('b.ID' => '1');
        //$where = array('numero' => $cbtramite);

        //$where = array('b.ID' => $cbtramite, 'autorizaciones.estado' => '1');

        $where = "b.ID=$cbtramite and DATE_FORMAT(autorizaciones.created_at, '%m')=$mes and DATE_FORMAT(autorizaciones.created_at, '%Y')=$anio and autorizaciones.estado in('1')";

        $this->autorizaciones->select("autorizaciones.ID, numero, concat(a.apaterno,' ',a.amaterno,' ',a.nombres) as solicitante, a.telefono, b.Descripcion as tramite, autorizaciones.reporte, autorizaciones.IDtramite");
        $this->autorizaciones->join('personas as a', 'autorizaciones.IDsolicitante = a.dni');
        $data = $this->autorizaciones->join('tramite as b', 'autorizaciones.IDtramite = b.ID', 'LEFT')->where($where)->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function deletesalud($id, $dni)
    {
        
            //&& verificar('eliminar usuario', $this->session->permisos)) {
            $data = $this->salud->update($id, ['estado' => '0']);
            if ($data) {
                return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'SE QUITO EL ITEM',
                ]);
            } else {
                return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL QUITAR',
                ]);
            }
		/*
		if ($this->request->is('delete')) {
        } else {
            return view('permisos');
        }
		*/
    }
	
    public function deletefamilia($id, $dni)
    {
        
            //&& verificar('eliminar usuario', $this->session->permisos)) {
            $data = $this->familiar->update($id, ['estado' => '0']);
            if ($data) {
                return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'SE QUITO EL ITEM',
                ]);
            } else {
                return redirect()->to(base_url('personasdiscapacidad/' . $dni . '/new'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL QUITAR',
                ]);
            }
        /*
		if ($this->request->is('delete')) {
		} else {
            return view('permisos');
        }
		*/
    }
}
