<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizaciondetalleModel extends Model
{
    protected $table            = 'organizacionessociales_detalle';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'IDORGANIZACION', 'IDResolucion'
    ];

    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
