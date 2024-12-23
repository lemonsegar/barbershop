<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Layout::index');
$routes->get('/baru', 'Baru::index');
$routes->get('/bio', 'Baru::biodata');
$routes->get('/pro', 'produk::index');
$routes->get('/detail', 'produk::detail');

$routes->get('/booking', 'Booking::index');
$routes->get('/booking/create', 'Booking::create');
$routes->post('/booking/store', 'Booking::store');
$routes->get('/booking/edit/(:num)', 'Booking::edit/$1');
$routes->post('/booking/update/(:num)', 'Booking::update/$1');
$routes->delete('/booking/delete/(:num)', 'Booking::delete/$1');