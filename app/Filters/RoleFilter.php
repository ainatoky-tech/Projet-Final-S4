<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Override;

class RoleFilter implements FilterInterface{
    
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $user = $session->get('role');
        // On vérifie directement si la valeur de $user est dans les arguments autorisés
        if (!$user || !in_array($user, $arguments ?? [])) {
            return redirect()->to('/')->with('erreur', 'Accès refusé : droits insuffisants');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        throw new \Exception('Not implemented');
    }
}