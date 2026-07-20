<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table         = 'client';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['nom', 'numero', 'date_creation', 'actif'];

    public function getAllClients()
    {
        return $this->where('actif', 1)
                    ->orderBy('nom', 'ASC')
                    ->findAll();
    }
}
