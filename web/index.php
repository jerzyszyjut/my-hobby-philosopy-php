<?php
require '../vendor/autoload.php';
require '../Router.php';
require '../NotificationsHandler.php';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

NotificationsHandler::start();

$router = new Router();
$router->get('/', 'BasicWebsiteController::index');
$router->get('/quotes', 'BasicWebsiteController::quotes');
$router->get('/settings', 'BasicWebsiteController::settings');
$router->get('/sources', 'BasicWebsiteController::sources');
$router->get('/philosophers/presocratics', 'BasicWebsiteController::presocratics');
$router->get('/philosophers/spa', 'BasicWebsiteController::spa_philosophers');
$router->get('/philosophers/remaining', 'BasicWebsiteController::remaining_philosophers');

$router->get('/gallery', 'GalleryController::index');
$router->get('/gallery/add', 'GalleryController::upload_form');
$router->post('/gallery/upload', 'GalleryController::upload');
$router->get('/gallery/view-image', 'GalleryController::view_image');
$router->post('/gallery/add_to_favourite', 'GalleryController::add_to_favourite');
$router->post('/gallery/remove_from_favourite', 'GalleryController::remove_from_favourite');
$router->get('/gallery/favourites', 'GalleryController::favourites');

$router->get('/register', 'UserController::register_form');
$router->post('/register_user', 'UserController::register_user');
$router->get('/login', 'UserController::login_form');
$router->post('/login_user', 'UserController::login_user');
$router->get('/logout', 'UserController::logout');

$router->errors['404'] = 'BasicWebsiteController::error404';
$router->errors['403'] = 'BasicWebsiteController::error403';

$view = $router->dispatch();
$view->render();
