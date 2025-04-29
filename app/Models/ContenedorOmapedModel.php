<?php

namespace App\Models;

use CodeIgniter\Model;

class ContenedorOmapedModel extends Model
{
    protected $table            = 'contenedor_omaped';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ID', 'Descripcion', 'indicador', 'idtabla', 'value'
    ];
    // Dates
    /*
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    */
}
