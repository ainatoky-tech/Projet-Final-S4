<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface{
    
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        // Si pas connecté → redirection login
        if (!$session->get('client_numero')) {
            return redirect()->to('/login')->with('erreur', 'entrer un numero valide');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        throw new \Exception('Not implemented');
    }
}