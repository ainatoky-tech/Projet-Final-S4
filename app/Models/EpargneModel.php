<?php

namespace App\Models;

use CodeIgniter\Model;

class EpargneModel extends Model
{
    protected $table         = 'epargne';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['pourcentage'];

    public function displayEpargne(){ 
        return $this->findAll();
    }

    public function calculMontantAEnregistrer($epargne,$montantDeduit){
        $Epargne = ($montantDeduit * $epargne)/100;
        $MontantToREgister = $montantDeduit - $Epargne;
        return (float) $MontantToREgister;
    } 
}

