<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');


//lab3-------------------------------------------------
//$routes->get('home', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
//-----------------------------------------------------

//lab4-------------------------------------------------
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');

$routes->get('logout', 'Auth::logout');
$routes->get('auth/dashboard', 'Auth::dashboard');
//------------------------------------------------------

//lab5--------------------------------------------------
//$routes->get('admin/dashboard', 'Admin::dashboard');
//$routes->get('teacher/dashboard', 'Teacher::dashboard');
//$routes->get('student/dashboard', 'Student::dashboard');
