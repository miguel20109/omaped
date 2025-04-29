<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasDiscapacidadFamiliarModel extends Model
{
    protected $table            = 'personas_discapacidad_familia';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'IdPersona', 'nombres_completos', 'edad', 'parentesco', 'ocupacion', 'instruccion', 'estado'
    ];
    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
