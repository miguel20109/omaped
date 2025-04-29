<?php

namespace App\Models;

use CodeIgniter\Model;

class UbigeoDistritoModel extends Model
{
    protected $table            = 'ubigeo_distrito';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'distrito'
    ];
}
