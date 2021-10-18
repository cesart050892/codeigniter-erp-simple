<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
$API = 'App\Controllers\Api';

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


$routes->group('api', ['namespace' => $API, []], function ($routes) {
    $routes->group('auth', function ($routes) {
        $routes->post('signup', 'Auth::store');
        $routes->post('login', 'Auth::login');
        $routes->get('logout', 'Auth::logout', ['filter' => 'api']);
    });
    $routes->get('profile', 'Users::profile', ['filter' => 'api']);
    $routes->resource('rols', ['filter' => 'api:admin', 'websafe' => 1]);
    $routes->resource('users', ['filter' => 'api:admin', 'websafe' => 1]);
    $routes->resource('clients', ['filter' => 'api:admin,guest', 'websafe' => 1]);
    $routes->resource('suppliers', ['filter' => 'api:admin,guest', 'websafe' => 1]);
    $routes->resource('products', ['filter' => 'api:admin,guest', 'websafe' => 1]);
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
