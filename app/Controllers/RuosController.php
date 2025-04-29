<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\RuosModel;

class RuosController extends BaseController
{
    private $ruos, $session, $roles;

    public function __construct()
    {
        $this->ruos = new RuosModel();
        $this->roles = new RolesModel();

        helper(['form']);
        $this->session = session();
    }

    public function index()
    {
        $data['active'] = 'ruos';
        return view('ruos/index', $data);
    }

    public function listar()
    {
        
        $data = $this->ruos->select("ID,concat(resolucion,'-',anio) as resolucion,nombre_organizacion_social,nombre_apellido,dni,desde,hasta,expediente,estado_resolucion,zonal,anio,siglas")->where(['estado'=>'1'])->findAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}
