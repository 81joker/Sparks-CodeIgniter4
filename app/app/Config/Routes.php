<?php

use App\Controllers\UserController;
use App\Controllers\OrderController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\DashboardController;

/**
 * @var RouteCollection $routes
 */
//  $routes->get('/', 'Home::index');
$routes->get('/', 'DashboardController::index');




// Users 
$routes->get('/users', 'UserController::index');
$routes->get('/user/edit/(:num)', 'UserController::edit/$1');
$routes->post('/users/update/(:any)', 'UserController::update/$1');
$routes->get('/user/show/(:num)', 'UserController::show/$1');
$routes->get('/user/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');
// $routes->post('users/update/(:any)', 'UserController::update/$1');
$routes->get('/user/delete/(:num)', 'UserController::delete/$1');

$routes->get('/users/api/json', '\App\Controllers\Api\UserController::apiJson');
$routes->get('/users/api/xml', '\App\Controllers\Api\UserController::apiXml');
$routes->get('/users/api/csv', '\App\Controllers\Api\UserController::apiCsv');


// // Customer 
$routes->get('/customers', 'CustomerController::index');
$routes->get('/customer/show/(:num)', 'CustomerController::show/$1');
$routes->get('/customer/create', 'CustomerController::create');
$routes->post('/customers/store', 'CustomerController::store');
$routes->get('/customer/edit/(:num)', 'CustomerController::edit/$1');
$routes->post('/customers/update/(:any)', 'CustomerController::update/$1');
// $routes->post('customers/update/(:any)', 'CustomerController::update/$1');
$routes->get('/customer/delete/(:num)', 'CustomerController::delete/$1');




// Orders 
 $routes->get('/orders', 'OrderController::index');
$routes->get('/order/show/(:num)', 'OrderController::show/$1');
// $routes->match(['get','post'],'/order/show/(:num)', 'OrderController::show/$1');

$routes->get('/order/view/(:num)', 'OrderController::view/$1');
$routes->post('/order/updateStatus/(:any)', 'OrderController::updateStatus/$1');




// Products
// $routes->resource('products', ['controller' => 'ProductController']);
$routes->get('/products', 'ProductController::index');
$routes->get('/product/show/(:num)', 'ProductController::show/$1');
$routes->get('/product/create', 'ProductController::create');
$routes->post('/products/store', 'ProductController::store');
$routes->get('/product/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/update/(:any)', 'ProductController::update/$1');
// $routes->post('products/update/(:any)', 'ProductController::update/$1');
$routes->get('/product/delete/(:num)', 'ProductController::delete/$1');


// Auth
$routes->match(['GET','POST'],'register', 'AuthController::register');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');