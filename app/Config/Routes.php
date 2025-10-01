<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('dashboard', 'Dashboard::index');

$routes->group('users', function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('create', 'Users::create');
    $routes->post('store', 'Users::store');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->post('update/(:num)', 'Users::update/$1');
    $routes->post('delete/(:num)', 'Users::delete/$1');
});