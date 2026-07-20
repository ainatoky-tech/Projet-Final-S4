<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Client extends BaseController
{
    public function dashboard()
    {
        if (!session()->get('logged_in') || session()->get('user_type') !== 'client') {
            return redirect()->to('/login/client');
        }

        $clientId = session()->get('client_id');
        $db = db_connect();

        $compte = $db->query("SELECT id FROM compte WHERE id_client = ?", [$clientId])->getRowArray();
        $compteId = $compte['id'];

        $solde = $db->query(
            "SELECT COALESCE(SUM(CASE WHEN sens = 'CREDIT' THEN montant ELSE 0 END), 0) -
                    COALESCE(SUM(CASE WHEN sens = 'DEBIT' THEN montant ELSE 0 END), 0) AS solde
             FROM mouvement WHERE id_compte = ?",
            [$compteId]
        )->getRowArray();

        return view('client/dashboard', [
            'nom'    => session()->get('nom'),
            'numero' => session()->get('numero'),
            'solde'  => $solde['solde'] ?? 0,
        ]);
    }
}
