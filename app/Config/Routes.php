<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Auth::login');
$routes->match(['get', 'post'], 'auth/login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('dashboard', 'Dashboard::index');  
$routes->get('dashboard/gudang', 'Dashboard::gudang');  
$routes->get('dashboard/dapur', 'Dashboard::dapur');  
$routes->get('permintaan', 'Permintaan::index');  
$routes->get('permintaan/create', 'Permintaan::create');  
$routes->post('permintaan/store', 'Permintaan::store');  
$routes->get('permintaan/approve/(:num)', 'Permintaan::approve/$1');  
$routes->post('permintaan/reject/(:num)', 'Permintaan::reject/$1');  
$routes->get('bahan', 'Bahan::index');  
$routes->get('bahan/create', 'Bahan::create'); 
$routes->post('bahan/store', 'Bahan::store');  
$routes->match(['get', 'post'], 'bahan/edit/(:num)', 'Bahan::edit/$1');  
$routes->post('bahan/update/(:num)', 'Bahan::update/$1');  
$routes->get('bahan/delete/(:num)', 'Bahan::delete/$1');  