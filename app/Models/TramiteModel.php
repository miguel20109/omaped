<?php

namespace App\Models;

use CodeIgniter\Model;

class TramiteModel extends Model
{
    protected $table            = 'tramite';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Descripcion', 'reporte', 'contador','contador_autorizacion', 'reporte', 'reporte_autorizacion'
    ];
    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
