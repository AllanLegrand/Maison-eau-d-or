<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
<<<<<<< HEAD
$routes->get('/', 'Accueil::index');
=======
$routes->get('/', 'Home::index');

$routes->get('/forgot-password', 'ForgotPasswordController::index'); 
$routes->post('/forgot-password/sendResetLink', 'ForgotPasswordController::sendResetLink');
>>>>>>> 6eab0dc6d80d55f578ae2b5b82bbd2c861e1bd84
