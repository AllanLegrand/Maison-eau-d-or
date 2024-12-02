<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/signup', 'SignupController::index'); 
$routes->match(['get', 'post'], '/signup/store', 'SignupController::store');

$routes->get('/signin', 'SigninController::index');
$routes->match(['get', 'post'], '/SigninController/loginAuth', 'SigninController::loginAuth');

$routes->get('/forgot-password', 'ForgotPasswordController::index'); 
$routes->post('/forgot-password/sendResetLink', 'ForgotPasswordController::sendResetLink');