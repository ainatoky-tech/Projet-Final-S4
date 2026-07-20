<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\UtilisateurModel;

class Auth extends BaseController
{
    public function loginClient()
    {
        if ($this->request->is('post')) {
            $numero = $this->request->getPost('numero');

            $clientModel = new ClientModel();
            $client = $clientModel->where('numero', $numero)->where('actif', 1)->first();

            if ($client) {
                session()->set([
                    'client_id'  => $client['id'],
                    'nom'        => $client['nom'],
                    'numero'     => $client['numero'],
                    'logged_in'  => true,
                    'user_type'  => 'client',
                ]);
                return redirect()->to('/dashboard');
            }
            return redirect()->back()->with('error', 'Numéro inconnu ou compte inactif.');
        }
        return view('auth/login_client');
    }

    public function loginAdmin()
    {
        if ($this->request->is('post')) {
            $login    = $this->request->getPost('login');
            $password = $this->request->getPost('password');

            $utilisateurModel = new UtilisateurModel();
            $user = $utilisateurModel->where('login', $login)->where('password', $password)->first();

            if ($user) {
                session()->set([
                    'admin_id'  => $user['id'],
                    'login'     => $user['login'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                    'user_type' => 'admin',
                ]);
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->back()->with('error', 'Identifiants invalides.');
        }
        return view('auth/login_admin');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
