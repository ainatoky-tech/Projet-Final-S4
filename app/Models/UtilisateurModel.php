<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id';
    protected $allowedFields = ['login','password','role'];

    public function register($data){
        return $this->save($data);
    }
    public function existing($data){
        return $this->select()->where('password', $data)
                              ->orWhere('login')
                              ->first();
    }
}