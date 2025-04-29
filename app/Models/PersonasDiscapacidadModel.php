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
		'oficio', 'noestudia', 'limita_capacidad', 'gustaria_capacitarse', 'trabaja', 'trabajaen', 'ingreso_mensual', 'idcondicion_laboral', 'trabajo_antes',
        'idorigendiscapacidad', 'discapacidad_otro', 'fecha_discapacidad', 'idrehabilitacion', 'tipo_rehabilitacion', 'personas_discapacidad', 'idactividad',
        'respuesta_actividad', 'idorganizacion', 'respuesta_organizacion', 'trabajo', 'vivienda', 'transporte', 'comunidad', 'ancho', 'profundidad', 'altura',
        'observacion_vivienda', 'observacion_salud', 'observacion_economica', 'observacion', 'recomendaciones', 'croquis', 'sugerencias',
		'certificado', 'institucion_otorgo', 'carnet_conadis', 'seguro', 'apoderado', 'carnet_vigencia', 'cuantos_viven', 'limita_trabajo'
    ];

    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
