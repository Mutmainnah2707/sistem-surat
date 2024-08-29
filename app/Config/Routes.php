<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home Route
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');

// Authentication Routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('authenticate', 'AuthController::authenticate');
    $routes->get('logout', 'AuthController::logout');
});

// Dashboard Route
$routes->get('dashboard', 'DashboardController::index');

// Surat Routes
$routes->get('surat/surat_masuk', 'SuratController::suratMasuk');
$routes->get('surat/surat_keluar', 'SuratController::suratKeluar');
$routes->get('surat/create_surat_masuk', 'SuratController::createSuratMasuk');
$routes->get('surat/create_surat_keluar', 'SuratController::createSuratKeluar');
$routes->get('surat/edit_surat_masuk/(:num)', 'SuratController::editSuratMasuk/$1');
$routes->get('surat/edit_surat_keluar/(:num)', 'SuratController::editSuratKeluar/$1');
$routes->get('surat/delete_surat_masuk/(:num)', 'SuratController::deleteSuratMasuk/$1');
$routes->get('surat/delete_surat_keluar/(:num)', 'SuratController::deleteSuratKeluar/$1');
$routes->post('surat/store_surat_masuk', 'SuratController::storeSuratMasuk');

$routes->post('surat/update_surat_keluar/(:num)', 'SuratController::updateSuratKeluar/$1');

$routes->post('surat/store_surat_keluar', 'SuratController::storeSuratKeluar');

// Route untuk tambah pengguna
$routes->get('admin/tambah-admin', 'AdminController::tambahAdmin');
$routes->post('admin/simpan-admin', 'AdminController::simpanAdmin');

$routes->get('admin/tambah-satker', 'AdminController::tambahSatker');
$routes->post('admin/simpan-satker', 'AdminController::simpanSatker');

$routes->get('admin/tambah-pengurus', 'AdminController::tambahPengurus');
$routes->post('admin/simpan-pengurus', 'AdminController::simpanPengurus');

// Daftar Admin
$routes->get('admin/list-admin', 'AdminController::listAdmins');

// Daftar Satker
$routes->get('admin/list-satker', 'AdminController::listSatkers');

// Daftar Pengurus Pondok
$routes->get('admin/list-pengurus', 'AdminController::listPengurus');

$routes->get('/admin/edit-admin/(:num)', 'AdminController::editAdmin/$1');
$routes->post('/admin/update-admin/(:num)', 'AdminController::updateAdmin/$1');

$routes->get('/admin/edit-satker/(:num)', 'AdminController::editSatker/$1');
$routes->post('/admin/update-satker/(:num)', 'AdminController::updateSatker/$1');

$routes->get('/admin/edit-pengurus/(:num)', 'AdminController::editPengurus/$1');
$routes->put('/admin/update-pengurus/(:num)', 'AdminController::updatePengurus/$1');

$routes->get('admin/delete-admin/(:num)', 'AdminController::deleteAdmin/$1');
$routes->get('admin/delete-satker/(:num)', 'AdminController::deleteSatker/$1');
$routes->get('admin/delete-pengurus/(:num)', 'AdminController::deletePengurus/$1');


$routes->get('admin/disposisi', 'DisposisiController::index');
$routes->get('admin/disposisi/create/(:num)', 'DisposisiController::create/$1');
$routes->post('admin/disposisi/store(:num)', 'DisposisiController::store/$1');
$routes->get('admin/disposisi/edit/(:num)', 'DisposisiController::edit/$1');
$routes->post('admin/disposisi/update/(:num)', 'DisposisiController::update/$1'); 
$routes->get('admin/disposisi/delete/(:num)', 'DisposisiController::delete/$1');

$routes->get('surat/show_surat_masuk/(:num)', 'SuratController::showSuratMasuk/$1');

$routes->get('surat/show_surat_keluar/(:num)', 'SuratController::showSuratKeluar/$1');



$routes->get('/settings', 'SettingsController::index');
$routes->post('/settings/update-password', 'SettingsController::updatePassword');

$routes->get('laporan/masuk', 'LaporanController::masuk');
$routes->get('laporan/keluar', 'LaporanController::keluar');
$routes->get('laporan/printSuratMasuk', 'LaporanController::printSuratMasuk');
$routes->get('laporan/printSuratKeluar', 'LaporanController::printSuratKeluar');



$routes->get('download/(:any)', 'SuratController::download/$1');

$routes->group('satker', function($routes) {
    // Surat Masuk Routes
    $routes->get('surat_masuk', 'Satker\SuratMasukSatkerController::index'); // Tampilkan daftar surat masuk
    $routes->get('surat_masuk/create', 'Satker\SuratMasukSatkerController::create'); // Form tambah surat masuk
    $routes->post('surat_masuk', 'Satker\SuratMasukSatkerController::store'); // Proses simpan surat masuk
    $routes->get('surat_masuk/(:num)', 'Satker\SuratMasukSatkerController::show/$1'); // Tampilkan detail surat masuk
    $routes->get('surat_masuk/(:num)/edit', 'Satker\SuratMasukSatkerController::edit/$1'); // Form edit surat masuk
    $routes->put('surat_masuk/(:num)', 'Satker\SuratMasukSatkerController::update/$1'); // Proses update surat masuk
    $routes->delete('surat_masuk/(:num)', 'Satker\SuratMasukSatkerController::delete/$1'); // Proses hapus surat masuk

    // Surat Keluar Routes
    $routes->get('surat_keluar', 'Satker\SuratKeluarSatkerController::index'); // Tampilkan daftar surat keluar
    $routes->get('surat_keluar/create', 'Satker\SuratKeluarSatkerController::createSuratKeluar'); // Form tambah surat keluar
    $routes->post('surat_keluar', 'Satker\SuratKeluarSatkerController::storeSuratKeluar'); // Proses simpan surat keluar
    $routes->get('surat_keluar/(:num)', 'Satker\SuratKeluarSatkerController::edit/$1'); // Form edit surat keluar
    $routes->post('surat_keluar/(:num)', 'Satker\SuratKeluarSatkerController::update/$1'); // Proses update surat keluar
    $routes->get('surat_keluar/(:num)/delete', 'Satker\SuratKeluarSatkerController::delete/$1'); // Proses hapus surat keluar
    $routes->get('surat_keluar/(:num)', 'Satker\SuratKeluarSatkerController::show/$1');
});

$routes->get('surat/surat_masuk_pengurus', 'Pengurus\SuratMasukPengurusController::index');
$routes->get('pengurus/surat_masuk/(:num)', 'Pengurus\SuratMasukPengurusController::show/$1');
$routes->get('surat/download/(:any)', 'SuratController::download/$1');



// Profile Route
$routes->get('profile', 'ProfileController::index');
