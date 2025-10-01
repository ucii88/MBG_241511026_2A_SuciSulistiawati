<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('dashboard', 'Dashboard::index');  
$routes->get('dashboard/gudang', 'Dashboard::gudang');  
$routes->get('permintaan', 'Permintaan::index');  
$routes->get('permintaan/create', 'Permintaan::create'); 
$routes->get('bahan/create', 'Bahan::create'); 