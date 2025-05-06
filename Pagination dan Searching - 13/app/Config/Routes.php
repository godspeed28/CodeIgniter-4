<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', [\App\Controllers\Pages::class, 'index']);
$routes->get('/Pages/about', [\App\Controllers\Pages::class, 'about']);
$routes->get('/Pages/contact', [\App\Controllers\Pages::class, 'contact']);
$routes->get('/Books', [\App\Controllers\Books::class, 'index']);
$routes->get('/Orang', [\App\Controllers\Orang::class, 'index']);
$routes->get('/Books/create', [\App\Controllers\Books::class, 'create']);
$routes->get('/Books/edit/(:segment)', [\App\Controllers\Books::class, 'edit/$1']);
$routes->post('/Books/update/(:segment)', [\App\Controllers\Books::class, 'update/$1']);
$routes->post('/Books/save', [\App\Controllers\Books::class, 'save']);
$routes->delete('/Books/(:num)', [\App\Controllers\Books::class, 'delete/$1']);
$routes->get('/Books/(:any)', [\App\Controllers\Books::class, 'detail/$1']);
