<?php

namespace App\Models;

use CodeIgniter\Model;

class UbigeoProvinciaModel extends Model
{
    protected $table            = 'ubigeo_provincia';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'provincia'
    ];
}
