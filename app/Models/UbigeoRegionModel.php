<?php

namespace App\Models;

use CodeIgniter\Model;

class UbigeoRegionModel extends Model
{
    protected $table            = 'ubigeo_region';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'region'
    ];
}
