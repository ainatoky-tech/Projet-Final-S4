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

// Client
$routes->get('dashboard', 'Client::dashboard');

// Operations
$routes->get('operations/depot', 'Operation::depot');
$routes->post('operations/depot', 'Operation::depot');
$routes->get('operations/retrait', 'Operation::retrait');
$routes->post('operations/retrait', 'Operation::retrait');
$routes->get('operations/transfert', 'Operation::transfert');
$routes->post('operations/transfert', 'Operation::transfert');
$routes->get('operations/historiques', 'Operation::historiques');
