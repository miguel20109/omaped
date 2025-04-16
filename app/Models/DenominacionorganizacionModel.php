<?php

namespace App\Models;

use CodeIgniter\Model;

class DenominacionorganizacionModel extends Model
{
    protected $table            = 'denominacionorganizacionsocial';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'Descripcion','IdTipoOrganizacionSocial'
    ];
}
