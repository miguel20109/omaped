<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\EstadoresolucionModel;
use App\Models\ResolucionesModel;
use App\Models\AniosModel;

class ResolucionesController extends BaseController
{

    private $resoluciones, $anios, $estadoresolucion, $roles, $reglas, $session;

    public function __construct()
    {
        $this->resoluciones = new ResolucionesModel();
        $this->estadoresolucion = new EstadoresolucionModel();
        $this->anios = new AniosModel();
        $this->roles = new RolesModel();

        helper(['form']);
        $this->session = session();
    }

    public function index()
    {
        if (!verificar('listar resolucion', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
        $data['active'] = 'resoluciones';
        return view('resoluciones/index', $data);
    }

    public function listar()
    {
        //->where(['anio'=>'2024','escaneado'=>'0'])
        $this->resoluciones->select('resolucion.ID,resolucion.Numero,resolucion.Anio,resolucion.Siglas, DATE_FORMAT(resolucion.InicioVigencia, "%d/%m/%Y") as InicioVigencia,DATE_FORMAT(resolucion.FinVigencia, "%d/%m/%Y") as FinVigencia, resolucion.vigente, estadoresolucion.Descripcion as Estado,resolucion.Archivo, resolucion.escaneado, irorganizacion(resolucion.id) as idorganizacion');
        $data = $this->resoluciones->join('estadoresolucion', 'resolucion.Estado = estadoresolucion.ID')->findAll();
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

        $data['anios'] = $this->anios->where('ID <=', $year)->findAll();
        $data['active'] = 'resoluciones';
        return view('resoluciones/nuevo', $data);
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

                $desde = $this->request->getVar('inicio_numero');
                $hasta = $this->request->getVar('fin_numero');
                $cbanio = $this->request->getVar('cbanio');
                $siglas = $this->request->getVar('siglas');

                for($i=$desde; $i<=$hasta; $i++){
                    
                    $numero = str_pad($i, 4, "0", STR_PAD_LEFT);

                    $condiciones = ['Anio' => $cbanio, 'Numero' => $numero];
                    $cantidad = $this->resoluciones->where($condiciones)->countAllResults();

                    if ($cantidad==0) {

                        $data = $this->resoluciones->insert([
                            'Numero' => $numero,
                            'Anio' => $cbanio,
                            'Siglas' => $siglas,
                            'InicioVigencia' => null,
                            'FinVigencia' => null,
                            'Fechaemision' => null,
                            'Estado' => '0',
                            'Archivo' => "pdf_resoluciones/RSG_N_$numero-$cbanio-SGPV.pdf",
                        ]);  

                    }  
                }

                if ($data > 0) {
                    return redirect()->to(base_url('resoluciones'))->with('respuesta', [
                        'type' => 'success',
                        'msg' => 'RESOLUCIONES REGISTRADAS',
                    ]);
                } else {
                    return redirect()->to(base_url('resoluciones'))->with('respuesta', [
                        'type' => 'danger',
                        'msg' => 'ERROR AL REGISTRAR',
                    ]);
                }

            } else {
                //$data['validacion'] = $this->validator;
                $data['anios'] = $this->anios->where('ID <=', $year)->findAll();
                //$data['rol'] = $this->request->getVar('rol');
                $data['active'] = 'resoluciones';
                return view('resoluciones/nuevo', $data);
            }
        /*} else {
            return view('permisos');
        }*/
    }

    public function edit($idResolucion)
    {
        $year = date("Y");

        if (!verificar('editar usuario', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
        
        $data['estadores'] = $this->estadoresolucion->findAll();
        $data['anios'] = $this->anios->where('ID <=', $year)->findAll();
        $data['resolucion'] = $this->resoluciones->where('id', $idResolucion)->first();
        $data['active'] = 'resoluciones';
        return view('resoluciones/edit', $data);
    }

    public function update($idResolucion)
    {

        $fechaemision = $this->request->getVar('fechaemision')==''? null : $this->request->getVar('fechaemision');
        $desdefecha = $this->request->getVar('desdefecha')==''? null : $this->request->getVar('desdefecha');
        $hastafecha = $this->request->getVar('hastafecha')==''? null : $this->request->getVar('hastafecha');

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
                $data = $this->resoluciones->update($idResolucion, [
                    'FechaEmision' => $fechaemision,
                    'InicioVigencia' => $desdefecha,
                    'FinVigencia' => $hastafecha,
                    'Estado' => $this->request->getVar('cbestado')
                ]);

                if ($data > 0) {
                    return redirect()->to(base_url('resoluciones'))->with('respuesta', [
                        'type' => 'success',
                        'msg' => 'RESOLUCIÓN MODIFICADA',
                    ]);
                } else {
                    return redirect()->to(base_url('resoluciones'))->with('respuesta', [
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
}
