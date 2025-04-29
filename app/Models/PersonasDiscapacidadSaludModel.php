<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasDiscapacidadSaludModel extends Model
{
    protected $table            = 'personas_discapacidad_salud';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'IdPersona', 'idcontenedor', 'respuesta', 'idtabla', 'estado'
    ];
    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
