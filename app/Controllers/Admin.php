<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends BaseController
{
    private function checkAdmin()
    {
        if (!session()->get('logged_in') || session()->get('user_type') !== 'admin') {
            return redirect()->to('/login/admin');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $db = db_connect();

        $totalClients   = $db->query("SELECT COUNT(*) AS c FROM client WHERE actif = 1")->getRowArray()['c'];
        $totalGains     = $db->query("SELECT COALESCE(SUM(frais), 0) AS total FROM operation WHERE id_type_operation IN (2,3)")->getRowArray()['total'];
        $totalOperations = $db->query("SELECT COUNT(*) AS c FROM operation")->getRowArray()['c'];

        return view('admin/dashboard', [
            'total_clients'    => $totalClients,
            'total_gains'      => $totalGains,
            'total_operations' => $totalOperations,
        ]);
    }

    // ---- PREFIXES ----

    public function prefixes()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $db = db_connect();
        $prefixes = $db->query("SELECT * FROM prefixe ORDER BY valeur")->getResultArray();
        return view('admin/prefixes', ['prefixes' => $prefixes]);
    }

    public function prefixeStore()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $valeur = $this->request->getPost('valeur');

        $db = db_connect();
        $db->query("INSERT INTO prefixe (valeur) VALUES (?)", [$valeur]);

        return redirect()->to('/admin/prefixes')->with('message', 'Préfixe ajouté.');
    }

    public function prefixeToggle($id = null)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $db = db_connect();
        $p = $db->query("SELECT actif FROM prefixe WHERE id = ?", [$id])->getRowArray();
        if ($p) {
            $nouveau = $p['actif'] ? 0 : 1;
            $db->query("UPDATE prefixe SET actif = ? WHERE id = ?", [$nouveau, $id]);
        }
        return redirect()->to('/admin/prefixes')->with('message', 'Statut du préfixe modifié.');
    }

    // ---- BARÈMES ----

    public function baremes()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $db = db_connect();
        $baremes = $db->query(
            "SELECT b.*, t.libelle AS type_libelle
             FROM bareme_frais b
             JOIN type_operation t ON t.id = b.id_type_operation
             ORDER BY t.libelle, b.montant_min"
        )->getResultArray();
        $types = $db->query("SELECT * FROM type_operation")->getResultArray();
        return view('admin/baremes', ['baremes' => $baremes, 'types' => $types]);
    }

    public function baremeUpdate($id = null)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $montantMin = $this->request->getPost('montant_min');
        $montantMax = $this->request->getPost('montant_max');
        $frais      = $this->request->getPost('frais');
        $actif      = $this->request->getPost('actif') ? 1 : 0;

        $db = db_connect();
        $db->query(
            "UPDATE bareme_frais SET montant_min = ?, montant_max = ?, frais = ?, actif = ? WHERE id = ?",
            [$montantMin, $montantMax, $frais, $actif, $id]
        );
        return redirect()->to('/admin/baremes')->with('message', 'Barème mis à jour.');
    }

    // ---- GAINS ----

    public function gains()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $db = db_connect();
        $gains = $db->query(
            "SELECT t.libelle AS type_operation,
                    COUNT(o.id) AS nombre,
                    COALESCE(SUM(o.frais), 0) AS total_frais
             FROM operation o
             JOIN type_operation t ON t.id = o.id_type_operation
             WHERE o.id_type_operation IN (2,3)
             GROUP BY t.id, t.libelle"
        )->getResultArray();

        $totalGlobal = $db->query(
            "SELECT COALESCE(SUM(frais), 0) AS total FROM operation WHERE id_type_operation IN (2,3)"
        )->getRowArray()['total'];

        return view('admin/gains', ['gains' => $gains, 'total_global' => $totalGlobal]);
    }

    // ---- COMPTES CLIENTS ----

    public function comptes()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $db = db_connect();
        $clients = $db->query(
            "SELECT c.id, c.nom, c.numero, c.actif AS client_actif,
                    COALESCE(SUM(CASE WHEN m.sens = 'CREDIT' THEN m.montant ELSE 0 END), 0) -
                    COALESCE(SUM(CASE WHEN m.sens = 'DEBIT' THEN m.montant ELSE 0 END), 0) AS solde
             FROM client c
             JOIN compte cp ON cp.id_client = c.id
             LEFT JOIN mouvement m ON m.id_compte = cp.id
             GROUP BY c.id
             ORDER BY c.nom"
        )->getResultArray();

        return view('admin/comptes', ['clients' => $clients]);
    }
}
