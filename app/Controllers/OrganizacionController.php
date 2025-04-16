<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrganizacionsocialModel;
use App\Models\TipoorganizacionModel;
use App\Models\DenominacionorganizacionModel;
use App\Models\ZonalModel;
use App\Models\CargosModel;
use App\Models\JuntadirectivaModel;
use App\Models\ResolucionesModel;
use App\Models\OrganizaciondetalleModel;

class OrganizacionController extends BaseController
{

    private $organizacion, $tipoorganizacion, $denominacionorganizacion, $zonal, $cargos, $juntadirectiva, $resoluciones, $organizaciondetalle, $session;

    public function __construct()
    {
        $this->zonal = new ZonalModel();
        $this->organizacion = new OrganizacionsocialModel();
        $this->tipoorganizacion = new TipoorganizacionModel();
        $this->denominacionorganizacion = new DenominacionorganizacionModel();
        $this->cargos = new CargosModel();
        $this->juntadirectiva = new JuntadirectivaModel();
        $this->resoluciones = new ResolucionesModel();
        $this->organizaciondetalle = new OrganizaciondetalleModel();

        helper(['form']);
        $this->session = session();
    }

    public function index()
    {
        /*if (!verificar('listar usuarios', $this->session->permisos)) {
            return view('permisos');
            exit;
        }*/
        $data['active'] = 'organizaciones';
        return view('organizacion/index', $data);
    }

    public function listar()
    {
        $data = $this->organizacion->select('ID, nombre_organizacion_social, vigencia(ID) as vigencia, zonal, siop')->findAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function new()
    {
        $year = date("Y");
        /*
        if (!verificar('nuevo usuario', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
        */

        $data['zonal'] = $this->zonal->findAll();
        $data['tipoorganizacion'] = $this->tipoorganizacion->findAll();
        $tipoorganizacionsocial = '0';
        $data['denominacionorganizacion'] = $this->denominacionorganizacion->where('IdTipoOrganizacionSocial', $tipoorganizacionsocial)->findAll();
        $data['active'] = 'organizaciones';
        return view('organizacion/nuevo', $data);
    }

    public function create()
    {

        $year = date("Y");
        /*       if (verificar('nuevo usuario', $this->session->permisos)) {
            $this->reglas = [
                'nombre' => [
                    'rules' => 'required'
                ],
                'apellido' => [
                    'rules' => 'required'
                ],
                'telefono' => [
                    'rules' => 'required|min_length[9]|is_unique[usuarios.telefono]'
                ],
                'correo' => [
                    'rules' => 'required|valid_email|is_unique[usuarios.correo]'
                ],
                'direccion' => [
                    'rules' => 'required'
                ],
                'rol' => [
                    'rules' => 'required'
                ],
                'clave' => [
                    'rules' => 'required|min_length[5]'
                ],
                'confirmar' => [
                    'rules' => 'required|min_length[5]|matches[clave]'
                ]
            ];
*/
        //if ($this->request->is('post') && $this->validate($this->reglas)) {
        if ($this->request->is('post')) {
            
            $data['max'] = $this->organizacion->selectMax('ID')->first();
            $newid = ((int)$data['max']['ID']) + 1;

            $numero = str_pad($newid, 6, "0", STR_PAD_LEFT);

            $condiciones = ['ID' => $numero];
            $cantidad = $this->organizacion->where($condiciones)->countAllResults();

            if ($cantidad == 0) {

                $data = $this->organizacion->insert([
                    'ID' => $numero,
                    'nombre_organizacion_social' => $this->request->getVar('nom_org'),
                    'IDtipoorganizacionsocial' => $this->request->getVar('cbtipoorganizacion'),
                    'IDdenominacionorganizacionsocial' => $this->request->getVar('cbdenomina'),
                    'FechaConstitucion' => $this->request->getVar('fecha_cons'),
                    'DireccionLocal' => $this->request->getVar('domicilio_org'),
                    'FinesOrganizacionSocial' => $this->request->getVar('fines'),
                    'NumeroMiembros' => $this->request->getVar('num_miem'),
                    'SIOP' => $this->request->getVar('siop_org'),
                    'Zonal' => $this->request->getVar('cbzonal'),
                ]);

            }

            if ($data > 0) {
                return redirect()->to(base_url('organizacion'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'SE REGISTRO LA ORGANIZACION CON EL CODIGO: '.$numero,
                ]);
            } else {
                return redirect()->to(base_url('organizacion'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL REGISTRAR',
                ]);
            }
        }
        /*} else {
            return view('permisos');
        }*/
    }

    public function edit($idOrganizacion)
    {
        /*

        if (!verificar('editar usuario', $this->session->permisos)) {
            return view('permisos');
            exit;
        }

        $data['estadores'] = $this->estadoresolucion->findAll();
        $data['anios'] = $this->anios->where('ID <=', $year)->findAll();
        */

        $this->resoluciones->select("id,numero,anio,siglas,finvigencia,vigente,estado");
        $data['resoluciones'] = $this->resoluciones->where('id not in(SELECT idresolucion FROM organizacionessociales_detalle) and estado>0')->orderBy('anio', 'ASC')->orderBy('numero', 'ASC')->findAll();

        $data['zonal'] = $this->zonal->findAll();
        $data['tipoorganizacion'] = $this->tipoorganizacion->findAll();
        $data['organizacion'] = $this->organizacion->where('ID', $idOrganizacion)->first();

        $tipoorganizacionsocial = $data['organizacion']['IDtipoorganizacionsocial'];

        $data['denominacionorganizacion'] = $this->denominacionorganizacion->where('IdTipoOrganizacionSocial', $tipoorganizacionsocial)->findAll();
        $data['active'] = 'organizaciones';

        return view('organizacion/edit', $data);
    }

    public function update($idOrganizacion)
    {
        //if (verificar('editar usuario', $this->session->permisos)) {
        /*
            $this->reglas = [
                'id_usuario'    => 'is_natural_no_zero',
                'nombre' => [
                    'rules' => 'required'
                ],
                'apellido' => [
                    'rules' => 'required'
                ],
                'telefono' => [
                    'rules' => 'required|min_length[9]|is_unique[usuarios.telefono,id,{id_usuario}]'
                ],
                'correo' => [
                    'rules' => 'required|valid_email|is_unique[usuarios.correo,id,{id_usuario}]'
                ],
                'direccion' => [
                    'rules' => 'required'
                ],
                'rol' => [
                    'rules' => 'required'
                ]
            ];
*/
        //if ($this->request->is('put') && $this->validate($this->reglas)) {
        $data = $this->organizacion->update($idOrganizacion, [
            'nombre_organizacion_social' => $this->request->getVar('nom_org'),
            'IDtipoorganizacionsocial' => $this->request->getVar('cbtipoorganizacion'),
            'IDdenominacionorganizacionsocial' => $this->request->getVar('cbdenomina'),
            'FechaConstitucion' => $this->request->getVar('fecha_cons'),
            'DireccionLocal' => $this->request->getVar('domicilio_org'),
            'FinesOrganizacionSocial' => $this->request->getVar('fines'),
            'NumeroMiembros' => $this->request->getVar('num_miem'),
            'SIOP' => $this->request->getVar('siop_org'),
            'Zonal' => $this->request->getVar('cbzonal'),
        ]);
        
        if ($data > 0) {
            return redirect()->to(base_url('organizacion'))->with('respuesta', [
                'type' => 'success',
                'msg' => 'ORGANIZACIÓN SOCIAL MODIFICADA',
            ]);
        } else {
            return redirect()->to(base_url('organizacion'))->with('respuesta', [
                'type' => 'danger',
                'msg' => 'ERROR AL MODIFICAR',
            ]);
        }
        /*} else {
                $data['validacion'] = $this->validator;
                $data['roles'] = $this->roles->where('estado', '1')->findAll();
                $data['rol'] = $this->request->getVar('rol');
                $data['usuario'] = $this->usuarios->where('id', $idUsuario)->first();
                $data['active'] = 'usuario';
                return view('usuarios/edit', $data);
            }*/

        //} else {
        //    return view('permisos');
        //}
    }

    public function juntadirectiva($idOrganizacion)
    {
        #->where('ID in(6,37,10,23,75,5)')
        
        $data['organizacion'] = $this->organizacion->select('ID, nombre_organizacion_social')->where('ID', $idOrganizacion)->first();
        $data['cargos'] = $this->cargos->orderBy('Descripcion', 'ASC')->findAll();

        $condiciones = ['organizacionessociales_detalle.IDORGANIZACION' => $idOrganizacion, 'resolucion.estado' => '1'];
        $this->organizaciondetalle->select("resolucion.ID, resolucion.Numero, resolucion.Anio, resolucion.Siglas");
        $this->organizaciondetalle->join('resolucion', 'resolucion.ID = organizacionessociales_detalle.IDResolucion');
        $data['resoluciones'] = $this->organizaciondetalle->where($condiciones)->orderBy('resolucion.anio desc, resolucion.numero desc')->findAll();
        
        $rows = count($data['resoluciones']);
        
        if ($rows > 0){
            $idresolucion = $data['resoluciones'][0]['ID'];
        }else{
            $idresolucion=0;
        }

        $data['idresolucion'] = $idresolucion;
        $data['active'] = 'organizaciones';

        return view('organizacion/juntadirectiva', $data);
    }

    public function listardirectiva($idOrganizacion, $idResolucion)
    {
        $condiciones = ['juntadirectiva.idorganizacion' => $idOrganizacion, 'juntadirectiva.idresolucion' => $idResolucion, 'juntadirectiva.estado' => '1'];

        $this->juntadirectiva->select("ROW_NUMBER() OVER (ORDER BY juntadirectiva.id ) as item, juntadirectiva.id, juntadirectiva.dni, cargos.Descripcion as cargo, personas.nombres, concat(personas.apaterno,' ',personas.amaterno) as apellidos, juntadirectiva.impreso, personas.telefono ,personas.correo ");
        $this->juntadirectiva->join('personas', 'juntadirectiva.dni = personas.dni');
        $data = $this->juntadirectiva->join('cargos', 'juntadirectiva.idcargo = cargos.ID')->where($condiciones)->orderBy('item', 'ASC')->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function agregardirectiva()
    {
        $idOrganizacion = $this->request->getVar('id_organizacion');
        if ($this->request->is('post')) {

            $dni = $this->request->getVar('dni');
            $cbcargos = $this->request->getVar('cbcargos');
            $idResolucion = $this->request->getVar('cbresoluciones');

            $condiciones = ['idorganizacion' => $idOrganizacion, 'idresolucion' => $idResolucion, 'dni' => $dni];
            $cantidad = $this->juntadirectiva->where($condiciones)->countAllResults();

            if ($cantidad == 0) {
                $data = $this->juntadirectiva->insert([
                    'idorganizacion' => $idOrganizacion,
                    'dni' => $dni,
                    'idcargo' => $cbcargos,
                    'idresolucion' => $idResolucion,
                    'impreso' => '0',
                    'estado' => '1',
                ]);
            }


            if ($data > 0) {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/juntadirectiva'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'RESOLUCIONES REGISTRADAS',
                ]);
            } else {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/juntadirectiva'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL REGISTRAR',
                ]);
            }
        } else {
            //$data['validacion'] = $this->validator;
            //$data['anios'] = $this->anios->where('ID <=', $year)->findAll();
            //$data['rol'] = $this->request->getVar('rol');
            $data['active'] = 'organizaciones';
            return view('organizacion/' . $idOrganizacion . '/juntadirectiva', $data);
        }
    }

    public function deletedirectiva($idDirectivo, $idOrganizacion)
    {
        if ($this->request->is('delete')) {
            //&& verificar('eliminar usuario', $this->session->permisos)) {
            $data = $this->juntadirectiva->update($idDirectivo, ['estado' => '0']);
            if ($data) {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/juntadirectiva'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'DIRIGENTE DADO DE BAJA',
                ]);
            } else {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/juntadirectiva'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL ELIMINAR',
                ]);
            }
        } else {
            return view('permisos');
        }
    }

    public function listaresoluciones($idOrganizacion)
    {

        //$this->resoluciones->join('estadoresolucion', 'resolucion.Estado = estadoresolucion.ID');

        $this->resoluciones->select("ROW_NUMBER() OVER (ORDER BY resolucion.id) as item, resolucion.id,numero,anio,siglas,finvigencia,vigente, estadoresolucion.Descripcion as Estado");
        $this->resoluciones->join('estadoresolucion', 'resolucion.Estado = estadoresolucion.ID');
        $data = $this->resoluciones->where('resolucion.id in(SELECT idresolucion FROM organizacionessociales_detalle where idorganizacion=' . $idOrganizacion . ') and resolucion.estado > 0')->orderBy('anio', 'ASC')->orderBy('numero', 'ASC')->findAll();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function agregaresolucion()
    {
        $idOrganizacion = $this->request->getVar('id_organizacion');

        if ($this->request->is('post')) {

            $idResolucion = $this->request->getVar('cbresoluciones');

            $data = $this->organizaciondetalle->insert([
                'IDORGANIZACION' => $idOrganizacion,
                'IDResolucion' => $idResolucion
            ]);

            if ($data > 0) {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/edit'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'RESOLUCIONES REGISTRADAS',
                ]);
            } else {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/edit'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL REGISTRAR',
                ]);
            }
        } else {
            //$data['validacion'] = $this->validator;
            //$data['anios'] = $this->anios->where('ID <=', $year)->findAll();
            //$data['rol'] = $this->request->getVar('rol');
            $data['active'] = 'organizaciones';
            return view('organizacion/' . $idOrganizacion . '/edit', $data);
        }
    }

    public function impresioncredencial($idResolucion)
    {
        $fecha_hoy = date('Y-m-d H:i:s');

        $data = $this->juntadirectiva->where('idresolucion', $idResolucion)->set(['impreso' => '1', 'fechaimpresion' => $fecha_hoy])->update();

            /*
            if ($data > 0) {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/edit'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'RESOLUCIONES REGISTRADAS',
                ]);
            } else {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/edit'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL REGISTRAR',
                ]);
            }
            */
    }

    public function entregacredencial($idResolucion)
    {
        $fecha_hoy = date('Y-m-d H:i:s');

        $data = $this->juntadirectiva->where('idresolucion', $idResolucion)->set(['impreso' => '2', 'fechaentrega' => $fecha_hoy])->update();

            /*
            if ($data > 0) {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/edit'))->with('respuesta', [
                    'type' => 'success',
                    'msg' => 'RESOLUCIONES REGISTRADAS',
                ]);
            } else {
                return redirect()->to(base_url('organizacion/' . $idOrganizacion . '/edit'))->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL REGISTRAR',
                ]);
            }
            */
    }

    public function cbdenomina($idTipo)
    {
        $data = $this->denominacionorganizacion->select('id, descripcion','idtipoorganizacionsocial')->where('idtipoorganizacionsocial', $idTipo)->orderBy('idtipoorganizacionsocial', 'ASC')->orderBy('id', 'ASC')->findAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
}
