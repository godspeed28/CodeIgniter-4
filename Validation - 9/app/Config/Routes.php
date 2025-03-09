<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', [\App\Controllers\Pages::class, 'index']);
$routes->get('/Pages/about', [\App\Controllers\Pages::class, 'about']);
$routes->get('/Pages/contact', [\App\Controllers\Pages::class, 'contact']);
$routes->get('/Books', [\App\Controllers\Books::class, 'index']);
$routes->get('/Books/create', [\App\Controllers\Books::class, 'create']);
$routes->post('/Books/save', [\App\Controllers\Books::class, 'save']);
$routes->get('/Books/(:segment)', [\App\Controllers\Books::class, 'detail/$1']);