<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/forgot-password', 'ForgotPasswordController::index'); 
$routes->post('/forgot-password/sendResetLink', 'ForgotPasswordController::sendResetLink');