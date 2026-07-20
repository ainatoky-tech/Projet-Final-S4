<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Operation extends BaseController
{
    private function getCompteId($clientId)
    {
        $db = db_connect();
        $compte = $db->query("SELECT id FROM compte WHERE id_client = ?", [$clientId])->getRowArray();
        return $compte['id'] ?? null;
    }

    private function getOperateurCompteId()
    {
        $db = db_connect();
        $compte = $db->query("SELECT id FROM compte WHERE type_compte = 'OPERATEUR'")->getRowArray();
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
            $clientId  = session()->get('client_id');
            $montant   = (float) $this->request->getPost('montant');
            $compteId  = $this->getCompteId($clientId);

            if ($montant <= 0) {
                return redirect()->back()->with('error', 'Montant invalide.');
            }

            $db = db_connect();
            $db->transBegin();

            $db->query(
                "INSERT INTO operation (id_type_operation, id_client_source, id_client_destination, montant, frais)
                 VALUES (1, ?, NULL, ?, 0)",
                [$clientId, $montant]
            );
            $operationId = $db->insertID();

            $db->query(
                "INSERT INTO mouvement (id_operation, id_compte, sens, montant)
                 VALUES (?, ?, 'CREDIT', ?)",
                [$operationId, $compteId, $montant]
            );

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Erreur lors du dépôt.');
            }
            $db->transCommit();
            return redirect()->to('/dashboard')->with('message', 'Dépôt de ' . number_format($montant, 2, ',', ' ') . ' Ar effectué.');
        }

        return view('operation/depot');
    }

    public function retrait()
    {
        if ($redirect = $this->checkClient()) return $redirect;

        if ($this->request->is('post')) {
            $clientId  = session()->get('client_id');
            $montant   = (float) $this->request->getPost('montant');
            $compteId  = $this->getCompteId($clientId);
            $frais     = $this->getFrais(2, $montant);
            $total     = $montant + $frais;

            if ($montant <= 0) {
                return redirect()->back()->with('error', 'Montant invalide.');
            }

            $solde = $this->getSolde($compteId);
            if ($solde < $total) {
                return redirect()->back()->with('error', 'Solde insuffisant. (Solde: ' . number_format($solde, 2, ',', ' ') . ' Ar, Total: ' . number_format($total, 2, ',', ' ') . ' Ar)');
            }

            $db = db_connect();
            $db->transBegin();

            $db->query(
                "INSERT INTO operation (id_type_operation, id_client_source, id_client_destination, montant, frais)
                 VALUES (2, ?, NULL, ?, ?)",
                [$clientId, $montant, $frais]
            );
            $operationId = $db->insertID();

            $db->query(
                "INSERT INTO mouvement (id_operation, id_compte, sens, montant)
                 VALUES (?, ?, 'DEBIT', ?)",
                [$operationId, $compteId, $montant]
            );

            $db->query(
                "INSERT INTO mouvement (id_operation, id_compte, sens, montant)
                 VALUES (?, ?, 'DEBIT', ?)",
                [$operationId, $compteId, $frais]
            );

            $operateurCompteId = $this->getOperateurCompteId();
            $db->query(
                "INSERT INTO mouvement (id_operation, id_compte, sens, montant)
                 VALUES (?, ?, 'CREDIT', ?)",
                [$operationId, $operateurCompteId, $frais]
            );

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Erreur lors du retrait.');
            }
            $db->transCommit();
            return redirect()->to('/dashboard')->with('message', 'Retrait de ' . number_format($montant, 2, ',', ' ') . ' Ar effectué. Frais: ' . number_format($frais, 2, ',', ' ') . ' Ar.');
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

            $db = db_connect();

            $destClient = $db->query(
                "SELECT id FROM client WHERE numero = ? AND actif = 1", [$destinataire]
            )->getRowArray();

            if (!$destClient) {
                return redirect()->back()->with('error', 'Destinataire introuvable.');
            }
            if ($destClient['id'] == $clientId) {
                return redirect()->back()->with('error', 'Vous ne pouvez pas vous transférer à vous-même.');
            }

            $compteId       = $this->getCompteId($clientId);
            $destCompteId   = $this->getCompteId($destClient['id']);
            $destClientInfo = $db->query("SELECT nom FROM client WHERE id = ?", [$destClient['id']])->getRowArray();
            $frais = $this->getFrais(3, $montant);
            $total = $montant + $frais;

            $solde = $this->getSolde($compteId);
            if ($solde < $total) {
                return redirect()->back()->with('error', 'Solde insuffisant. (Solde: ' . number_format($solde, 2, ',', ' ') . ' Ar, Total: ' . number_format($total, 2, ',', ' ') . ' Ar)');
            }

            $db->transBegin();

            $db->query(
                "INSERT INTO operation (id_type_operation, id_client_source, id_client_destination, montant, frais)
                 VALUES (3, ?, ?, ?, ?)",
                [$clientId, $destClient['id'], $montant, $frais]
            );
            $operationId = $db->insertID();

            $db->query(
                "INSERT INTO mouvement (id_operation, id_compte, sens, montant)
                 VALUES (?, ?, 'DEBIT', ?)",
                [$operationId, $compteId, $montant]
            );

            $db->query(
                "INSERT INTO mouvement (id_operation, id_compte, sens, montant)
                 VALUES (?, ?, 'DEBIT', ?)",
                [$operationId, $compteId, $frais]
            );

            $db->query(
                "INSERT INTO mouvement (id_operation, id_compte, sens, montant)
                 VALUES (?, ?, 'CREDIT', ?)",
                [$operationId, $destCompteId, $montant]
            );

            $operateurCompteId = $this->getOperateurCompteId();
            $db->query(
                "INSERT INTO mouvement (id_operation, id_compte, sens, montant)
                 VALUES (?, ?, 'CREDIT', ?)",
                [$operationId, $operateurCompteId, $frais]
            );

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Erreur lors du transfert.');
            }
            $db->transCommit();
            return redirect()->to('/dashboard')->with('message', 'Transfert de ' . number_format($montant, 2, ',', ' ') . ' Ar vers ' . esc($destClientInfo['nom']) . ' effectué.');
        }

        return view('operation/transfert');
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

    public function historiques()
    {
        if ($redirect = $this->checkClient()) return $redirect;

        $clientId = session()->get('client_id');
        $compteId = $this->getCompteId($clientId);

        $db = db_connect();
        $operations = $db->query(
            "SELECT o.id, t.libelle AS type_operation,
                    o.montant, o.frais, o.date_operation,
                    m.sens, m.montant AS montant_mouvement, m.date_mouvement,
                    cs.nom AS source_nom, cd.nom AS dest_nom
             FROM mouvement m
             JOIN operation o ON o.id = m.id_operation
             JOIN type_operation t ON t.id = o.id_type_operation
             LEFT JOIN client cs ON cs.id = o.id_client_source
             LEFT JOIN client cd ON cd.id = o.id_client_destination
             WHERE m.id_compte = ?
             ORDER BY m.date_mouvement DESC",
            [$compteId]
        )->getResultArray();

        return view('operation/historiques', ['operations' => $operations]);
    }
}
