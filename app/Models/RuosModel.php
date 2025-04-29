<?php

namespace App\Models;

use CodeIgniter\Model;

class RuosModel extends Model
{
    protected $table            = 'ruos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['expediente,nombare_organizacion_social,nombre_apellido,dni,resolucion,estado_resolucion,desde,hasta,zonal,anio,siglas,estado'];

}
