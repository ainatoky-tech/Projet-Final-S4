<?php

namespace App\Controllers;

use App\Models\PrefixeModel;
use App\Models\BaremeFraisModel;
use App\Models\TypeOperationModel;
use App\Models\OperateurModel;
use App\Models\CommissionModel;

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
        $totalClients    = $db->query("SELECT COUNT(*) AS c FROM client WHERE actif = 1")->getRowArray()['c'];
        $totalGains      = $db->query("SELECT COALESCE(SUM(frais + commission), 0) AS total FROM operation WHERE id_type_operation IN (2,3)")->getRowArray()['total'];
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
        $prefixes = $db->query(
            "SELECT p.*, o.nom AS operateur_nom
             FROM prefixe p
             JOIN operateur o ON o.id = p.id_operateur
             ORDER BY p.valeur"
        )->getResultArray();
        $operateurModel = new OperateurModel();
        $operateurs = $operateurModel->findAll();

        return view('admin/prefixes', ['prefixes' => $prefixes, 'operateurs' => $operateurs]);
    }

    public function prefixeStore()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $prefixeModel = new PrefixeModel();
        $prefixeModel->insert([
            'id_operateur' => $this->request->getPost('id_operateur'),
            'valeur'       => $this->request->getPost('valeur'),
        ]);

        return redirect()->to('/admin/prefixes')->with('message', 'Préfixe ajouté.');
    }

    public function prefixeToggle($id = null)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $prefixeModel = new PrefixeModel();
        $prefixe = $prefixeModel->find($id);
        if ($prefixe) {
            $prefixeModel->update($id, ['actif' => $prefixe['actif'] ? 0 : 1]);
        }
        return redirect()->to('/admin/prefixes')->with('message', 'Statut du préfixe modifié.');
    }

    // ---- OPÉRATEURS ----

    public function operateurs()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $operateurModel = new OperateurModel();
        $operateurs = $operateurModel->orderBy('nom', 'ASC')->findAll();
        return view('admin/operateurs', ['operateurs' => $operateurs]);
    }

    public function operateurToggle($id = null)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $operateurModel = new OperateurModel();
        $op = $operateurModel->find($id);
        if ($op) {
            $operateurModel->update($id, ['actif' => $op['actif'] ? 0 : 1]);
        }
        return redirect()->to('/admin/operateurs')->with('message', 'Statut modifié.');
    }

    // ---- COMMISSIONS ----

    public function commissions()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $db = db_connect();
        $commissions = $db->query(
            "SELECT c.*, o.nom AS operateur_nom
             FROM commission c
             JOIN operateur o ON o.id = c.id_operateur
             ORDER BY o.nom"
        )->getResultArray();
        $operateurModel = new OperateurModel();
        $operateurs = $operateurModel->where('actif', 1)->findAll();

        return view('admin/commissions', ['commissions' => $commissions, 'operateurs' => $operateurs]);
    }

    public function commissionStore()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $commissionModel = new CommissionModel();
        $commissionModel->insert([
            'id_operateur' => $this->request->getPost('id_operateur'),
            'pourcentage'  => $this->request->getPost('pourcentage'),
        ]);

        return redirect()->to('/admin/commissions')->with('message', 'Commission ajoutée.');
    }

    public function commissionToggle($id = null)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $commissionModel = new CommissionModel();
        $c = $commissionModel->find($id);
        if ($c) {
            $commissionModel->update($id, ['actif' => $c['actif'] ? 0 : 1]);
        }
        return redirect()->to('/admin/commissions')->with('message', 'Statut modifié.');
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
        $typeOperationModel = new TypeOperationModel();
        $types = $typeOperationModel->findAll();

        return view('admin/baremes', ['baremes' => $baremes, 'types' => $types]);
    }

    public function baremeUpdate($id = null)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $baremeFraisModel = new BaremeFraisModel();
        $baremeFraisModel->update($id, [
            'montant_min' => $this->request->getPost('montant_min'),
            'montant_max' => $this->request->getPost('montant_max'),
            'frais'       => $this->request->getPost('frais'),
            'actif'       => $this->request->getPost('actif') ? 1 : 0,
        ]);
        return redirect()->to('/admin/baremes')->with('message', 'Barème mis à jour.');
    }

    public function baremeStore()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $baremeFraisModel = new BaremeFraisModel();
        $baremeFraisModel->insert([
            'id_type_operation' => $this->request->getPost('id_type_operation'),
            'montant_min'       => $this->request->getPost('montant_min'),
            'montant_max'       => $this->request->getPost('montant_max'),
            'frais'             => $this->request->getPost('frais'),
        ]);
        return redirect()->to('/admin/baremes')->with('message', 'Nouveau barème ajouté.');
    }

    // ---- GAINS ----

    public function gains()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;  

        $db = db_connect();
        $gains = $db->query(
            "SELECT t.libelle AS type_operation,
                    COUNT(o.id) AS nombre,
                    COALESCE(SUM(o.frais), 0) AS total_frais,
                    COALESCE(SUM(o.commission), 0) AS total_commission,
                    COALESCE(SUM(o.frais + o.commission), 0) AS total
             FROM operation o
             JOIN type_operation t ON t.id = o.id_type_operation
             WHERE o.id_type_operation IN (2,3)
             GROUP BY t.id, t.libelle"
        )->getResultArray();

        $totalGlobal = $db->query(
            "SELECT COALESCE(SUM(frais + commission), 0) AS total FROM operation WHERE id_type_operation IN (2,3)"
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
