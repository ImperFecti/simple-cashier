<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/simpanTagihan', 'Home::simpanTagihan');

// profile user management
$routes->get('/profile', 'User::profile');
$routes->get('/profile', 'User::editprofile');
$routes->post('/updateprofile/(:num)', 'User::updateprofile/$1');
$routes->get('/ubahpassword', 'User::ubahpassword');
$routes->post('/updatepassword/(:num)', 'User::updatepassword/$1');

// tagihan management
$routes->get('/tabletagihan', 'Tagihan::tabletagihan');
$routes->post('/simpanTagihan', 'Tagihan::simpanTagihan', ['filter' => 'role:admin']);
$routes->post('/deletetagihan', 'Tagihan::deletetagihan', ['filter' => 'role:admin']);
$routes->get('/buktitagihan/(:num)', 'Tagihan::buktitagihan/$1');

// cashier management
$routes->get('/tablecashier', 'Cashier::tablecashier', ['filter' => 'role:admin']);
$routes->post('/tambahcashier', 'Cashier::tambahcashier', ['filter' => 'role:admin']);
$routes->post('/deletecashier', 'Cashier::deletecashier', ['filter' => 'role:admin']);
$routes->post('/editcashier/(:num)', 'Cashier::editcashier/$1', ['filter' => 'role:admin']);

// product management
$routes->get('/tableproduk', 'Product::tableproduk');
$routes->post('/tambahproduk', 'Product::tambahproduk', ['filter' => 'role:admin']);
$routes->post('/deleteproduk', 'Product::deleteproduk', ['filter' => 'role:admin']);
$routes->post('/editproduk/(:num)', 'Product::editproduk/$1', ['filter' => 'role:admin']);

// category management
$routes->get('/tablekategori', 'Kategori::tablekategori');
$routes->post('/tambahkategori', 'Kategori::tambahkategori', ['filter' => 'role:admin']);
$routes->post('/deletekategori', 'Kategori::deletekategori', ['filter' => 'role:admin']);
$routes->post('/editkategori/(:num)', 'Kategori::editkategori/$1', ['filter' => 'role:admin']);

// pembayaran management
$routes->get('/tablepembayaran', 'Pembayaran::tablepembayaran');
$routes->post('/tambahpembayaran', 'Pembayaran::tambahpembayaran', ['filter' => 'role:admin']);
$routes->post('/deletepembayaran', 'Pembayaran::deletepembayaran', ['filter' => 'role:admin']);
$routes->post('/editpembayaran/(:num)', 'Pembayaran::editpembayaran/$1', ['filter' => 'role:admin']);
