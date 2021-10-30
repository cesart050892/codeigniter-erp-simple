<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers\Web');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('App\Controllers\Errors');
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');


$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {

    $routes->group('auth', function ($routes) {
        $routes->post('signup', 'Auth::create');
        $routes->post('login', 'Auth::login');
        $routes->get('logout', 'Auth::logout', ['filter' => 'api']);
    });

    $routes->get('profile', 'Users::profile', ['filter' => 'api']);
    $routes->post('purchases/add/(:num)', 'Products::updatePrice/$1', ['filter' => 'api']);
    $routes->get('settings/(:segment)', 'Settings::option/$1', ['filter' => 'api']);
    $routes->get('temp/generate(:any)', 'TempDetailsInvoice::generate/$1', ['filter' => 'api']);
    $routes->resource('rols',       ['placeholder' => '(:num)', 'filter' => 'api:admin,guest', 'websafe' => 1]);
    $routes->resource('users',      ['placeholder' => '(:num)', 'filter' => 'api:admin,guest', 'websafe' => 1]);
    $routes->resource('clients',    ['placeholder' => '(:num)', 'filter' => 'api:admin,guest', 'websafe' => 1]);
    $routes->resource('suppliers',  ['placeholder' => '(:num)', 'filter' => 'api:admin,guest', 'websafe' => 1]);
    $routes->resource('products',   ['placeholder' => '(:num)', 'filter' => 'api:admin,guest', 'websafe' => 1]);
    $routes->resource('purchases',  ['placeholder' => '(:num)', 'filter' => 'api:admin,guest', 'websafe' => 1]);
    $routes->resource('settings',   ['placeholder' => '(:num)', 'filter' => 'api', 'websafe' => 1]);
    $routes->resource('temp',       ['controller' => 'TempDetailsInvoice', 'filter' => 'api:admin,guest', 'websafe' => 1]);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
