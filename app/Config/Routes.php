<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Accueil::index');
$routes->get('/', 'Home::index');
$routes->get('/Accueil','Accueil::index');
$routes->post('Accueil/addToCart', 'BoutiqueController::addToCart');
$routes->post('/accueil/subscribeToNewsletter', 'Accueil::subscribeToNewsletter');

$routes->get('/signup', 'SignupController::index'); 
$routes->match(['get', 'post'], '/signup/store', 'SignupController::store');

$routes->get('/signin', 'SigninController::index');
$routes->match(['get', 'post'], '/SigninController/loginAuth', 'SigninController::loginAuth');

$routes->get('/utilisateur/checkAuth', 'UtilisateurController::checkAuth');
$routes->get('/utilisateur/getUserDetails', 'UtilisateurController::getUserDetails');
$routes->get('/utilisateur/deconnexion', 'UtilisateurController::deconnexion');
$routes->get('/profil', 'ProfilController::index');
$routes->post('/modifier-profil', 'ProfilController::modifierProfil');

$routes->get('/forgot-password', 'ForgotPasswordController::index'); 
$routes->post('/forgot-password/sendResetLink', 'ForgotPasswordController::sendResetLink');

$routes->get('/reset-password/(:any)', 'ResetPasswordController::index/$1');
$routes->post('/reset-password/updatePassword', 'ResetPasswordController::updatePassword');
$routes->get('/boutique', 'BoutiqueController::index');
$routes->get('/boutique/getProduit/(:num)', 'BoutiqueController::getProduit/$1');
$routes->get('boutique/getProduit/(:num)', 'BoutiqueController::getProduit/$1');
$routes->post('boutique/addToCart', 'BoutiqueController::addToCart');

$routes->post('addArticle', 'ArticleController::addArticle');
$routes->get('/blog', 'ArticleController::index');

$routes->get('/panier/getCartItems', 'BoutiqueController::getCartItems');
$routes->post('panier/updateQuantity', 'BoutiqueController::updateQuantity');
$routes->post('panier/removeItem', 'BoutiqueController::removeItem');
$routes->get('/commande', 'BoutiqueController::commande');
$routes->post('/commande/finalizeOrder', 'BoutiqueController::finalizeOrder');

$routes->get('/rechercheProduit', 'BoutiqueController::rechercherProduitByNom');
$routes->get('/rechercheProduit', 'BoutiqueController::rechercherProduitByNom');

$routes->post('/addProduit', 'BoutiqueController::addProduit');
$routes->get('/suppProduit/(:num)', 'BoutiqueController::suppProduit/$1');
$routes->post('/editProduit', 'BoutiqueController::editProduit');

$routes->get('/conditions_generales', 'ConditionController::index');
$routes->get('/politique_confidentialite', 'PolitiqueController::index');

$routes->post('/addCategorie', 'BoutiqueController::addCategorie');
