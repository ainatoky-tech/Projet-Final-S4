<?php

namespace App\Models;

use CodeIgniter\Model;

class MouvementModel extends Model{
    protected $table = 'mouvement';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_operation','id_compte','sens','montant','date_mouvement'];

    public function getSolde($idCompte){
        $res = $this->select("SUM(CASE WHEN sens = 'CREDIT' THEN montant ELSE 0 END) - 
                          SUM(CASE WHEN sens = 'DEBIT' THEN montant ELSE 0 END) as solde")
                ->where('id_compte', $idCompte)
                ->first();
        return (float)($res['solde'] ?? 0);
    }
    public function InsertMouvement($data){
        return $this->save($data);
    }
}