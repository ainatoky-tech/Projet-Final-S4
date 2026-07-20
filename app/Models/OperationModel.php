<?php

namespace App\Models;

use CodeIgniter\Model;

class OperationModel extends Model{
    protected $table = 'operation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_type_operation','id_client_source','montant','frais','date_operation'];

    public function insertion($data){
        return $this->save($data);
    }
    public function dispatch($id){
        return $this->findAll();
    }
    public function getMontantEnJeuByid($id){
        return $this->select('montant')->where('id_client_sources',$id)->first();
    }



    /*dans le cas d'un retrait dans le compte*/
    public function calculerTotalRetrait($montant,$idClient){
        $bareme = new BaremeFraisModel();
        $frais = $bareme->getMinMaxMontant($montant,2);
        return $montant+$frais;
    }

    public function calculNouveauSolde($montant,$id_clientSelectionner){
        $bareme = new BaremeFraisModel();
        $mvmt = new MouvementModel();
        $soldeActuel = $mvmt->getSolde($id_clientSelectionner);
        $retrait = $this->calculerTotalRetrait($montant,$id_clientSelectionner);
        $nouveauSolde = $soldeActuel - $retrait;
        if($soldeActuel < $retrait){
            return false;
        }
        return [
            'id_compte' => $id_clientSelectionner,
            'montant'   => -$retrait, // Valeur totale négative pour le mouvement[cite: 4, 6]
            'date'      => date('Y-m-d H:i:s')
        ];
    }

    public function preparerMouvementDepot($montant, $idCompte) {
        // Le dépôt est toujours positif
        return [
            'id_compte' => $idCompte,
            'montant'   => $montant, 
            'date_mouvement' => date('Y-m-d H:i:s')
        ];
    }
}