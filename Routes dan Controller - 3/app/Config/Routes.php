<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', [\App\Controllers\Home::class, 'index']);
$routes->get('/Test', [\App\Controllers\Test::class, 'index']);
$routes->get('/About', [\App\Controllers\About::class, 'index']);
$routes->get('/Services', [\App\Controllers\Services::class, 'index']);
$routes->get('/Users', [\App\Controllers\Admin\Users::class, 'index']);
