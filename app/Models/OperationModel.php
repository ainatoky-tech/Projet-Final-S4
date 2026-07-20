<?php

namespace App\Models;

use CodeIgniter\Model;

class OperationModel extends Model{
    protected $table = 'operation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_type_operation','id_client_source','montant','frais','date_operation'];
}