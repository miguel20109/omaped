<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasModel extends Model
{
    protected $table            = 'personas';
    protected $primaryKey       = 'DNI';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'IDtipo_documento', 'apaterno', 'amaterno', 'nombres', 'direccion', 'estado_civil', 'ubigeo', 'restriccion', 'estado', 'foto', 'fecha_nacimiento',
		'IDsexo', 'telefono', 'correo', 'fecha_fallecimiento', 'region', 'provincia', 'distrito', 'referencia'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
	
    // Validation
	/*
    protected $validationRules      = [
        'DNI'    => [
            'rules'  => 'required|min_length[8]|is_unique[personas.DNI]',
            'errors' => [
                'required' => 'El N° de identidad es obligatorio',
                'min_length' => 'El N° de identidad debe contener 8 caracteres',
                'is_unique' => 'El N° de identidad debe único',
            ],
        ],
        'nombres' => 'required|min_length[3]',
        'apaterno' => 'required|min_length[3]',
		'amaterno' => 'required|min_length[3]',
		'IDsexo' => 'required|min_length[1]',
    ];
	*/
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
	
}
