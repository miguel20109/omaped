<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\EstadoresolucionModel;
use App\Models\ExpedienteshistorialModel;
use App\Models\AniosModel;

class HistorialController extends BaseController
{

    private $historial, $anios, $estadoresolucion, $roles, $reglas, $session;

    public function __construct()
    {
        $this->historial = new ExpedienteshistorialModel();
        $this->estadoresolucion = new EstadoresolucionModel();
        $this->anios = new AniosModel();
        $this->roles = new RolesModel();

        helper(['form']);
        $this->session = session();
    }

    public function index()
    {
        if (!verificar('listar historial', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
        $data['active'] = 'historial';
        return view('historial/index', $data);
    }

    public function listar()
    {
        //->where(['anio'=>'2024','escaneado'=>'0'])
        $data = $this->historial->select('ID, nicho, inhumacion, DATE_FORMAT(fecha, "%d/%m/%Y") as fecha, solicitante, celular, difunto, DATE_FORMAT(fecha_fallecimiento, "%d/%m/%Y") as fecha_fallecimiento, cementerio, recibo_nicho, recibo_inhumacion, DATE_FORMAT(fecha_pago, "%d/%m/%Y") as fecha_pago, monto')->findAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}
