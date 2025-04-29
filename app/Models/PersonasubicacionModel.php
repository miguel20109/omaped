<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasubicacionModel extends Model
{
    protected $table            = 'personas_ubicacion';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'DNI', 'IDsolicitante', 'subiendo', 'izquierda', 'derecha', 'columna', 'nivel', 'largo', 'ancho', 'alto', 'IDsepultura', 'IDencargado'
    ];
				
    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
