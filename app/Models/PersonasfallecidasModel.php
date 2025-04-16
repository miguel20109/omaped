<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasfallecidasModel extends Model
{
    protected $table            = 'personas_fallecidas';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'DNI', 'IDlugar', 'IDcementerio', 'procedencia', 'IDdeclarante'
    ];

    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
