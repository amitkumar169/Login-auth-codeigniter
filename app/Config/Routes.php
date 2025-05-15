<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('auth', 'Auth::index');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/registerUser', 'Auth::registerUser');
$routes->post('auth/loginUser', 'Auth::loginUser');
$routes->post('auth/loginUser', 'Auth::loginUser');
$routes->get('Dashboard', 'Dashboard::index');
$routes->post('auth/uploadImage', 'Auth::uploadImage');
$routes->get('dashboard/index', 'Dashboard::index');
$routes->get('auth/logout', 'Auth::logout');


