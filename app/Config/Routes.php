<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::handleRegister');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::handleLogin');

$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Auth::dashboard');

$routes->get('home', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
