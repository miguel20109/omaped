<?php

namespace App\Models;

use CodeIgniter\Model;

class ResolucionesModel extends Model
{
    protected $table            = 'resolucion';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Numero', 'Anio', 'Siglas', 'InicioVigencia', 'FinVigencia', 'Estado', 'Archivo', 'Expediente','vigente','FechaEmision'
    ];

    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
