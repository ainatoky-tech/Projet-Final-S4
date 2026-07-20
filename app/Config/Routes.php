<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Clients::index');
$routes->get('clients', 'Clients::index');
$routes->get('clients/create', 'Clients::create');
$routes->post('clients/store', 'Clients::store');
$routes->get('clients/delete/(:num)', 'Clients::delete/$1');
