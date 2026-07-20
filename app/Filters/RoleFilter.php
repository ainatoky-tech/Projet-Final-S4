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
        $user = $session->get('user');
        // $arguments contient le(s) rôle(s) autorisé(s)
        // ex: ['admin'] ou ['admin', 'bibliothecaire']
        if (!$user || !in_array($user['role'], $arguments ?? [])) {
            return redirect()->to('/')->with('erreur', 'Accès refusé : droits insuffisants');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        throw new \Exception('Not implemented');
    }
}