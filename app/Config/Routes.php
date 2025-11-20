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

$routes->post('/course/enroll', 'Course::enroll');

$routes->get('/admin/course/(:num)/upload', 'Materials::upload/$1');
$routes->post('/admin/course/(:num)/upload', 'Materials::upload/$1');
$routes->get('/materials/delete/(:num)', 'Materials::delete/$1');
$routes->get('/materials/download/(:num)', 'Materials::download/$1');
//------------------------------------------------------

/* MidtermExam------------------------------------------
$routes->group('teacher', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Teacher::dashboard');
});
$routes->group('admin', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
});

$routes->get('announcements', 'Announcement::index');
*/
