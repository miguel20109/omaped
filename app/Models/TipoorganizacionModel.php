<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoorganizacionModel extends Model
{
    protected $table            = 'tipoorganizacionsocial';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Descripcion'
    ];
}
