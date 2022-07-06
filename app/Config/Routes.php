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
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Pages::index');
// autentikasi kontroller pages
//$routes->add('/', 'Pages::index');
$routes->addRedirect('pages/profil', 'profil');
$routes->addRedirect('pages/listuser', 'mahasiswa');
$routes->addRedirect('pages/surat', 'surat');
$routes->addRedirect('pages/formsurat', 'aktif-kuliah');
$routes->addRedirect('/', '/login');




$routes->get('/daftar', 'Pages::home');
$routes->get('/aktif-kuliah', 'Pages::formsurat', ['filter' => 'auth']);
$routes->get('/surat', 'Pages::surat', ['filter' => 'auth']);
$routes->get('/ip', 'Pages::formijinpenelitian', ['filter' => 'auth']);
$routes->get('/eip', 'Pages::editijinpenelitian', ['filter' => 'auth']);
$routes->get('/cip', 'Pages::ijinpenelitian', ['filter' => 'auth']);
$routes->get('/profil', 'Pages::profil', ['filter' => 'auth']);
$routes->get('/mahasiswa', 'Pages::listuser', ['filter' => 'auth']);
$routes->get('/riwayat', 'Mahasiswa::riwayat', ['filter' => 'auth']);
$routes->get('/dashboard', 'Mahasiswa::dashboard', ['filter' => 'auth']);
$routes->get('/logout', 'Pages::logout', ['filter' => 'auth']);



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
