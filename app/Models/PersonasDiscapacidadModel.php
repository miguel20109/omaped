<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasDiscapacidadModel extends Model
{
    protected $table            = 'personas_discapacidad';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'DNI', 'idvivienda', 'idviven', 'idconstruccion', 'idservicios', 'espadre', 'contacto', 'telefono', 'numerohijos', 'idinstruccion', 'idestudios',
		'oficio', 'noestudia', 'limita_capacidad', 'gustaria_capacitarse', 'trabaja', 'trabajaen', 'ingreso_mensual', 'idcondicion_laboral', 'trabajo_antes'
    ];

    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
