<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class BaremeFraisModel extends Model{
    protected $table = 'bareme_frais';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_type_operation','montant_min','montant_max','frais','actif'];

    public function insertionNewBarem($data){
        return $this->insert($data);
    }
    public function dispatch(){
        return $this->findAll();
    }
    /*fonction pour l'opérateur en lui même*/
    public function modify($id,$data){
        return $this->update($id,$data);
    }

    public function getMinMaxMontant($montant,$idTypeOperation){
        $res = $this->select('frais')
                ->where('montant_min <=', $montant)
                ->where('montant_max >=', $montant)
                ->where('actif', 1)
                ->where('id_type_operation', $idTypeOperation)
                ->first();
        return $res ? (float)$res['frais'] : 0;
    }


}