<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Dashboard Route
$routes->get('/', 'DashboardController::index');
$routes->get('dashboard', 'DashboardController::index');

$routes->group('surat-masuk', ['filter' => 'role:admin,satker,penpon'], function ($routes) {
    $routes->get('', 'IncomingLetterController::index');
    $routes->get('create', 'IncomingLetterController::create'); // Hanya untuk admin, nanti diberi role
    $routes->post('store', 'IncomingLetterController::store');
    $routes->get('show/(:num)', 'IncomingLetterController::show/$1');
    // $routes->get('edit/(:num)', 'IncomingLetterController::edit/$1');
    // $routes->put('update/(:num)', 'IncomingLetterController::update/$1'); // Cari di controller
    $routes->get('delete/(:num)', 'IncomingLetterController::delete/$1');
});

$routes->group('surat-keluar', ['filter' => 'role:admin,satker'], function ($routes) {
    $routes->get('', 'OutgoingLetterController::index');
    $routes->get('create', 'OutgoingLetterController::create');
    $routes->post('store', 'OutgoingLetterController::store');
    $routes->get('show/(:num)', 'OutgoingLetterController::show/$1');
    $routes->get('edit/(:num)', 'OutgoingLetterController::edit/$1');
    $routes->put('update/(:num)', 'OutgoingLetterController::update/$1'); // Cari di controller
    $routes->get('delete/(:num)', 'OutgoingLetterController::delete/$1');
});

$routes->get('notification', 'AjaxController::notification');

$routes->group('file-surat', ['filter' => 'role:admin,satker,penpon'], function ($routes) {
    $routes->get('view-pdf/(:segment)', 'IncomingLetterController::viewPdf/$1');
    $routes->get('download/(:any)', 'SuratController::download/$1');
});

$routes->group('disposisi', ['filter' => 'role:admin,satker'], function ($routes) {
    $routes->get('', 'DispositionController::index');
    $routes->get('create', 'DispositionController::create');
    $routes->post('store', 'DispositionController::store');
    $routes->get('edit/(:num)', 'DispositionController::edit/$1');
    $routes->put('update/(:num)', 'DispositionController::update/$1');
    $routes->delete('delete/(:num)', 'DispositionController::delete/$1');
});

$routes->group('laporan', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('surat-masuk', 'Admin\ReportController::suratMasuk');
    $routes->get('surat-keluar', 'Admin\ReportController::suratKeluar');
    $routes->get('print', 'Admin\ReportController::print');
    $routes->get('printSuratMasuk', 'Admin\ReportController::printSuratMasuk');
    $routes->get('printSuratKeluar', 'Admin\ReportController::printSuratKeluar');
});

$routes->group('manajemen-pengguna', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('(:alpha)', 'Admin\UserManagementController::index/$1');
    $routes->get('create/(:alpha)', 'Admin\UserManagementController::create/$1');
    $routes->post('store/(:alpha)', 'Admin\UserManagementController::store/$1');
    $routes->get('edit/(:alpha)/(:num)', 'Admin\UserManagementController::edit/$1/$2');
    $routes->put('update/(:num)', 'Admin\UserManagementController::update/$1');
    $routes->get('delete/(:num)', 'Admin\UserManagementController::delete/$1');
});

$routes->group('settings', ['filter' => 'role:admin,satker,penpon'], function ($routes) {
    $routes->get('', 'SettingController::index');
    $routes->put('update', 'SettingController::update');
});
