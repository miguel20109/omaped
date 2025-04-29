<?php

namespace App\Models;

use CodeIgniter\Model;

class MesesModel extends Model
{
    protected $table            = 'meses';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

}
