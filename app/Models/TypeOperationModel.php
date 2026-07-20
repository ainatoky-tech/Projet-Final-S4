<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeOperationModel extends Model{
    protected $table = 'type_operation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['libelle'];

    public function register($data){
        return $this->save($data);
    }

    public function choiceOperation($id){
        return $this->find($id);
    }
}