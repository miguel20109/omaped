<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\EstadoresolucionModel;
use App\Models\ExpedienteshistorialModel;
use App\Models\AniosModel;
use App\Models\MesesModel;
use App\Models\TramiteModel;
use App\Models\SolicitudModel;

class ExcelEditorController extends BaseController
{

    private $historial, $anios, $meses, $tramite, $solicitud, $estadoresolucion, $roles, $reglas, $session;

    public function __construct()
    {
        $this->historial = new ExpedienteshistorialModel();
        $this->estadoresolucion = new EstadoresolucionModel();
        $this->anios = new AniosModel();
		$this->meses = new MesesModel();
		$this->tramite = new TramiteModel();
		$this->solicitud = new SolicitudModel();
        $this->roles = new RolesModel();

        helper(['form']);
        $this->session = session();
    }

    public function index()
    {
        /*
		if (!verificar('listar historial', $this->session->permisos)) {
            return view('permisos');
            exit;
        }
		        */
        $data['active'] = 'historial';

		return view('exceleditor/index', $data);
    }

    public function listar()
    {
		/*
				$data = $this->historial->select('ID, nicho, inhumacion')->orderBy('ID', 'ASC')->limit(10)->find();
		*/		

		$rows = $this->anios->select('ID, nombre')->findAll();

		$data["data"] = array();
		
		if(count($rows)){
			foreach($rows AS $row){
				$entry = array(
					'ID' =>$row['ID'],
					'nombre' =>$row['nombre'],
				);
				$data["data"][] = $entry;
			}
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
	}
	
    public function guardar($data)
    {
		$data = json_decode($data);
		
		foreach ($data as $key => $value) {
			$this->anios->update($value[0], ['nombre' => $value[1]]);
		}

		$data=array('result' =>'ok');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
	}
	
    public function solicitudes()
    {
		
		$data['anios'] = $this->anios->findAll();
		$data['meses'] = $this->meses->findAll();
        $data['tramite'] = $this->tramite->findAll();
		$data['anio'] = date('Y');
		$data['mes'] = date('m');
		
        $data['active'] = 'historial';

		return view('exceleditor/solicitudes', $data);
    }
	
    public function listarsolicitudes($cbtramite, $mes, $anio)
    {

		//$rows = $this->solicitud->select('ID, numero, IDsolicitante')->findAll();
		
		$where = "IDtramite=$cbtramite and DATE_FORMAT(created_at, '%m')=$mes and DATE_FORMAT(created_at, '%Y')=$anio and estado in('1','2')";
		$rows = $this->solicitud->select('ID, numero, IDsolicitante, expediente, fecha_expediente, recibo, fecha_pago')->where($where)->orderBy('ID', 'ASC')->limit(200)->find();
		
		$data["data"] = array();
		
		if(count($rows)){
			foreach($rows as $row){
				$entry = array(
					'ID' =>$row['ID'],
					'numero' =>$row['numero'],
					'IDsolicitante' =>$row['IDsolicitante'],
					'expediente' =>$row['expediente'],
					'fecha_expediente' =>$row['fecha_expediente'],
					'recibo' =>$row['recibo'],
					'fecha_pago' =>$row['fecha_pago'],
				);
				$data["data"][] = $entry;
			}
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
	}
	
    public function guardarsolicitudes($data)
    {
		$data = json_decode($data);
		
		foreach ($data as $key => $value) {

			$id = $value[0];
			$data = [
				'expediente' => $value[3],
				'fecha_expediente' => $value[4],
				'recibo' => $value[5],
				'fecha_pago' => $value[6]
			];
			$this->solicitud->where('ID', $id)->set($data)->update();
			
		}

		$data=array('result' =>'ok');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
	}
}
