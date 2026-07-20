<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth
$routes->get('/', 'Auth::loginClient');
$routes->get('login/client', 'Auth::loginClient');
$routes->post('login/client', 'Auth::loginClient');
$routes->get('login/admin', 'Auth::loginAdmin');
$routes->post('login/admin', 'Auth::loginAdmin');
$routes->get('logout', 'Auth::logout');
