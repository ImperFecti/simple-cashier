<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// profile user management
$routes->get('/profile', 'User::profile');

// cashier management
$routes->get('/tablecashier', 'Cashier::tablecashier', ['filter' => 'role:admin']);
$routes->post('/tambahcashier', 'Cashier::tambahcashier', ['filter' => 'role:admin']);
$routes->post('/editcashier/(:num)', 'Cashier::editcashier/$1', ['filter' => 'role:admin']);
$routes->post('/deletecashier', 'Cashier::deletecashier', ['filter' => 'role:admin']);

// product management
$routes->get('/tableproduk', 'Product::tableproduk');
$routes->post('/tambahproduk', 'Product::tambahproduk', ['filter' => 'role:admin']);
$routes->post('/editproduk/(:num)', 'Product::editproduk/$1', ['filter' => 'role:admin']);
$routes->post('/deleteproduk', 'Product::deleteproduk', ['filter' => 'role:admin']);
