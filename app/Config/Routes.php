<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');


//lab3-------------------------------------------------
$routes->get('home', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
//-----------------------------------------------------

//lab4-------------------------------------------------
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');

$routes->get('logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');
//------------------------------------------------------

// role-based dashboards
$routes->group('teacher', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Teacher::dashboard');
});
$routes->group('admin', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
});

// announcement module
$routes->get('announcements', 'Announcement::index');
//------------------------------------------------------
