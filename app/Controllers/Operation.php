<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\CompteModel;
use App\Models\OperationModel;
use App\Models\MouvementModel;
    
class Operation extends BaseController
{
    private function getCompteId($clientId)
    {
        $compteModel = new CompteModel();
        $compte = $compteModel->where('id_client', $clientId)->first();
        return $compte['id'] ?? null;
    }

    private function getOperateurCompteId()
    {
        $compteModel = new CompteModel();
        $compte = $compteModel->where('type_compte', 'OPERATEUR')->first();
        return $compte['id'] ?? null;
    }

    private function getFrais($typeOperationId, $montant)
    {
        $db = db_connect();
        $bareme = $db->query(
            "SELECT frais FROM bareme_frais
             WHERE id_type_operation = ? AND montant_min <= ? AND montant_max >= ? AND actif = 1",
            [$typeOperationId, $montant, $montant]
        )->getRowArray();
        return $bareme['frais'] ?? 0;
    }

    private function getCommission($numero)
    {
        $prefix = substr($numero, 0, 3);
        $db = db_connect();
        $com = $db->query(
            "SELECT c.pourcentage FROM commission c
             JOIN prefixe p ON p.id_operateur = c.id_operateur
             WHERE p.valeur = ? AND c.actif = 1 AND p.actif = 1",
            [$prefix]
        )->getRowArray();
        return $com['pourcentage'] ?? 0;
    }

    private function getSolde($compteId)
    {
        $db = db_connect();
        $solde = $db->query(
            "SELECT COALESCE(SUM(CASE WHEN sens = 'CREDIT' THEN montant ELSE 0 END), 0) -
                    COALESCE(SUM(CASE WHEN sens = 'DEBIT' THEN montant ELSE 0 END), 0) AS solde
             FROM mouvement WHERE id_compte = ?",
            [$compteId]
        )->getRowArray();
        return $solde['solde'] ?? 0;
    }

    private function checkClient()
    {
        if (!session()->get('logged_in') || session()->get('user_type') !== 'client') {
            return redirect()->to('/login/client');
        }
        return null;
    }

    public function depot()
    {
        if ($redirect = $this->checkClient()) return $redirect;

        if ($this->request->is('post')) {
            $epargne = $this->request->getPost('epargne');
            $clientId = session()->get('client_id');
            $montant  = (float) $this->request->getPost('montant');
            $compteId = $this->getCompteId($clientId);
            $epargneModel = new EpargneModel();
            $montantfinale = $epargneModel->calculMontantAEnregistrer($epargne,$montant);

            if ($montantfinale <= 0) {
                return redirect()->back()->with('error', 'Montant invalide.');
            }


            $db = db_connect();
            $db->transBegin();

            $operationModel = new OperationModel();
            $operationModel->insert([
                'id_type_operation' => 1,
                'id_client_source'  => $clientId,
                'montant'           => $montantfinale,
                'frais'             => 0,
                'commission'        => 0,
            ]);
            $operationId = $operationModel->getInsertID();

            $mouvementModel = new MouvementModel();
            $mouvementModel->insert([
                'id_operation' => $operationId,
                'id_compte'    => $compteId,
                'sens'         => 'CREDIT',
                'montant'      => $montant,
            ]);

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Erreur lors du dépôt.');
            }
            $db->transCommit();
            return redirect()->to('/dashboard')->with('message', 'Dépôt de ' . number_format($montantfinale, 2, ',', ' ') . ' Ar effectué.');
        }

        return view('operation/depot');
    }

    public function retrait()
    {
        if ($redirect = $this->checkClient()) return $redirect;

        if ($this->request->is('post')) {
            $clientId = session()->get('client_id');
            $montant  = (float) $this->request->getPost('montant');
            $compteId = $this->getCompteId($clientId);
            $frais    = $this->getFrais(2, $montant);
            $total    = $montant + $frais;

            if ($montant <= 0) {
                return redirect()->back()->with('error', 'Montant invalide.');
            }

            $solde = $this->getSolde($compteId);
            if ($solde < $total) {
                return redirect()->back()->with('error', 'Solde insuffisant.');
            }

            $db = db_connect();
            $db->transBegin();

            $operationModel = new OperationModel();
            $operationModel->insert([
                'id_type_operation' => 2,
                'id_client_source'  => $clientId,
                'montant'           => $montant,
                'frais'             => $frais,
                'commission'        => 0,
            ]);
            $operationId = $operationModel->getInsertID();

            $mouvementModel = new MouvementModel();
            $mouvementModel->insertBatch([
                ['id_operation' => $operationId, 'id_compte' => $compteId, 'sens' => 'DEBIT', 'montant' => $montant],
                ['id_operation' => $operationId, 'id_compte' => $compteId, 'sens' => 'DEBIT', 'montant' => $frais],
                ['id_operation' => $operationId, 'id_compte' => $this->getOperateurCompteId(), 'sens' => 'CREDIT', 'montant' => $frais],
            ]);

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Erreur lors du retrait.');
            }
            $db->transCommit();
            return redirect()->to('/dashboard')->with('message', 'Retrait de ' . number_format($montant, 2, ',', ' ') . ' Ar effectué.');
        }

        return view('operation/retrait');
    }

    public function transfert()
    {
        if ($redirect = $this->checkClient()) return $redirect;

        if ($this->request->is('post')) {
            $clientId     = session()->get('client_id');
            $montant      = (float) $this->request->getPost('montant');
            $destinataire = $this->request->getPost('destinataire');

            if ($montant <= 0) {
                return redirect()->back()->with('error', 'Montant invalide.');
            }
            $promotion  = $this->getPromotion();
            $frais      = $this->getFrais(3, $montant);
            //$frais      = $frais - $promotion/100;
            $commission = 0;

            $pct = $this->getCommission($destinataire);
            if ($pct > 0) {
                $commission = round($montant * $pct / 100, 2);
            }

            $total    = $montant + $frais + $commission;

            $compteId = $this->getCompteId($clientId);

            $solde = $this->getSolde($compteId);
            if ($solde < $total) {
                return redirect()->back()->with('error', 'Solde insuffisant.');
            }
            if ($destinataire === session()->get('numero')) {
                return redirect()->back()->with('error', 'Vous ne pouvez pas vous transférer à vous-même.');
            }

            $db = db_connect();
            $db->transBegin();

            $operationModel = new OperationModel();
            $operationModel->insert([
                'id_type_operation'  => 3,
                'id_client_source'   => $clientId,
                'numero_destination' => $destinataire,
                'montant'            => $montant,
                'frais'              => $frais,
                'commission'         => $commission,
            ]);
            $operationId = $operationModel->getInsertID();

            $operateurCompteId = $this->getOperateurCompteId();
            $mouvements = [
                ['id_operation' => $operationId, 'id_compte' => $compteId, 'sens' => 'DEBIT', 'montant' => $montant],
                ['id_operation' => $operationId, 'id_compte' => $compteId, 'sens' => 'DEBIT', 'montant' => $frais],
                ['id_operation' => $operationId, 'id_compte' => $compteId, 'sens' => 'DEBIT', 'montant' => $commission],
                ['id_operation' => $operationId, 'id_compte' => $operateurCompteId, 'sens' => 'CREDIT', 'montant' => $frais],
                ['id_operation' => $operationId, 'id_compte' => $operateurCompteId, 'sens' => 'CREDIT', 'montant' => $commission],
            ];

            $mouvementModel = new MouvementModel();
            $mouvementModel->insertBatch($mouvements);

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Erreur lors du transfert.');
            }
            $db->transCommit();
            return redirect()->to('/dashboard')->with('message', 'Transfert de ' . number_format($montant, 2, ',', ' ') . ' Ar vers ' . esc($destinataire) . ' effectué. Frais: ' . number_format($frais, 2, ',', ' ') . ' Ar' . ($commission > 0 ? ', Commission: ' . number_format($commission, 2, ',', ' ') . ' Ar' : '') . '.');
        }

        return view('operation/transfert');
    }

    public function historiques()
    {
        if ($redirect = $this->checkClient()) return $redirect;

        $clientId = session()->get('client_id');
        $compteId = $this->getCompteId($clientId);

        $db = db_connect();
        $operations = $db->query(
            "SELECT o.id, t.libelle AS type_operation,
                    o.montant, o.frais, o.commission, o.numero_destination, o.date_operation,
                    m.sens, m.montant AS montant_mouvement, m.date_mouvement,
                    cs.nom AS source_nom
             FROM mouvement m
             JOIN operation o ON o.id = m.id_operation
             JOIN type_operation t ON t.id = o.id_type_operation
             LEFT JOIN client cs ON cs.id = o.id_client_source
             WHERE m.id_compte = ?
             ORDER BY m.date_mouvement DESC",
            [$compteId]
        )->getResultArray();

        return view('operation/historiques', ['operations' => $operations]);
    }

    public function displayOption(){
       if ($redirect = $this->checkClient()) return $redirect;
        $clientId = session()->get('client_id');

        $db = db_connect();
        $operations = $db->query(
            "SELECT * FROM epargne"
        )->getResultArray();

        return view('operation/depot', ['operations' => $operations]);
    }
}
