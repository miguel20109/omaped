<?php

namespace App\Models;

use CodeIgniter\Model;

class AniosModel extends Model
{
    protected $table            = 'anios';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
		'ID', 'nombre'
	];
}
