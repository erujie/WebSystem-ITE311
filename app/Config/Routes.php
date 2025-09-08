<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// make dashboard the app root
$routes->get('/', 'Auth::dashboard');
$routes->get('/dashboard', 'Auth::dashboard');

// auth
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// public pages (keep)
$routes->get('/home', 'Home::index');    // optional
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
