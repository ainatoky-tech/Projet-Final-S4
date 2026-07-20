<?php

namespace App\Models;

use CodeIgniter\Model;

class MouvementModel extends Model{
    protected $table = 'mouvement';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_operation','id_compte','sens','montant','date_mouvement'];
}