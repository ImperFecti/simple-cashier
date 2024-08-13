<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/profile', 'Home::profile');

$routes->get('/tablecashier', 'Home::tablecashier');
$routes->post('/tambahcashier', 'Home::tambahcashier', ['filter' => 'role:admin']);
$routes->post('/editcashier/(:num)', 'Home::editcashier/$1', ['filter' => 'role:admin']);
$routes->post('/deletecashier', 'Home::deletecashier', ['filter' => 'role:admin']);

$routes->get('/tableproduk', 'Home::tableproduk');
$routes->post('/tambahproduk', 'Home::tambahproduk', ['filter' => 'role:admin']);
$routes->post('/editproduk/(:num)', 'Home::editproduk/$1', ['filter' => 'role:admin']);
$routes->post('/deleteproduk', 'Home::deleteproduk', ['filter' => 'role:admin']);
