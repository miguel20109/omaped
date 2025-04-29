<?php

namespace App\Models;

use CodeIgniter\Model;

class JuntadirectivaModel extends Model
{
    protected $table            = 'juntadirectiva';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'idorganizacion', 'dni', 'idcargo', 'idresolucion', 'impreso', 'estado', 'fechaimpresion', 'fechaentrega'
    ];
}
