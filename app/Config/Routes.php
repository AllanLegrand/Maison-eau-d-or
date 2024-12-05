<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Accueil::index');
$routes->get('/', 'Home::index');
$routes->get('/Accueil','Accueil::index');

$routes->get('/signup', 'SignupController::index'); 
$routes->match(['get', 'post'], '/signup/store', 'SignupController::store');

$routes->get('/signin', 'SigninController::index');
$routes->match(['get', 'post'], '/SigninController/loginAuth', 'SigninController::loginAuth');

$routes->get('/forgot-password', 'ForgotPasswordController::index'); 
$routes->post('/forgot-password/sendResetLink', 'ForgotPasswordController::sendResetLink');

$routes->get('/reset-password/(:any)', 'ResetPasswordController::index/$1');
$routes->post('/reset-password/updatePassword', 'ResetPasswordController::updatePassword');
$routes->get('/boutique', 'BoutiqueController::index');
$routes->get('/boutique/getProduit/(:num)', 'BoutiqueController::getProduit/$1');
$routes->get('boutique/getProduit/(:num)', 'BoutiqueController::getProduit/$1');
$routes->post('boutique/addToCart', 'BoutiqueController::addToCart');

$routes->get('/blog', 'ArticleController::index');

$routes->get('/panier/getCartItems', 'BoutiqueController::getCartItems');
$routes->get('/rechercheProduit', 'BoutiqueController::rechercherProduitByNom');