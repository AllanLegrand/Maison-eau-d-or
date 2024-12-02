<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Accueil::index');
$routes->get('/', 'Home::index');
$routes->get('/Accueil','Accueil::index');

$routes->get('/forgot-password', 'ForgotPasswordController::index'); 
$routes->post('/forgot-password/sendResetLink', 'ForgotPasswordController::sendResetLink');
