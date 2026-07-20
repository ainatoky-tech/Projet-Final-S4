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
        if (!$session->get('operateur')) {
            return redirect()->to('/login')->with('erreur', 'Connectez-vous pour accéder à cette page');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        throw new \Exception('Not implemented');
    }
}