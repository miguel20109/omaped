<?php

namespace App\Models;

use CodeIgniter\Model;

class AutorizacionesModel extends Model
{
    protected $table            = 'autorizaciones';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'numero', 'IDdifunto', 'IDsolicitante', 'IDcementerio', 'IDsepultura', 'IDtramite', 'IDencargado', 'subiendo', 'izquierda', 'derecha', 'columna', 'nivel', 'largo', 'ancho', 'alto', 'created_at', 'IDusuario',
		'expediente','fecha_expediente', 'recibo', 'fecha_pago', 'recibos', 'reporte'
	];

    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
