<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizacionsocialModel extends Model
{
    protected $table            = 'organizacionessociales';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre_organizacion_social', 'IDtipoorganizacionsocial',
        'IDdenominacionorganizacionsocial', 'SIOP', 'FechaConstitucion', 'NumeroMiembros', 'Zonal',
        'DireccionLocal', 'FinesOrganizacionSocial', 'UbicacionLocal'
    ];
}
