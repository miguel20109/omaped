<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudModel extends Model
{
    protected $table            = 'solicitudes';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'numero', 'IDdifunto', 'IDsolicitante', 'IDcementerio', 'IDsepultura', 'IDtramite', 'monto','created_at',
		'expediente', 'fecha_expediente', 'recibo', 'fecha_pago', 'recibos', 'estado'
	];

    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
