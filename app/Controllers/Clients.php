<?php

namespace App\Controllers;

use App\Models\ClientModel;

class Clients extends BaseController
{
    public function index()
    {
        $clientModel = new ClientModel();
        $clients     = $clientModel->findAll();
        return view('clients/index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients/create');
    }

    public function store()
    {
        $clientModel = new ClientModel();
        $data        = $this->request->getPost();
        $clientModel->insert($data);
        return redirect()->to('/clients')->with('message', 'Client ajouté avec succès.');
    }

    public function delete($id = null)
    {
        $clientModel = new ClientModel();
        $clientModel->delete($id);
        return redirect()->to('/clients')->with('message', 'Client supprimé.');
    }
}
