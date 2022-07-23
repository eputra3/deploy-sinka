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
$routes->setDefaultController('Home');
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

// Landing Page
$routes->get('/', 'LandingPage::index');
$routes->get('/kumpulan-jadwal-imunisasi', 'LandingPage::kumpulanJadwalImunisasi');
$routes->get('artikel-berita-detail/(:any)', 'LandingPage::detail/$1');
$routes->get('/kumpulan-artikel-berita', 'LandingPage::kumpulanArtikelBerita');

// Restricting Admin
$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/dasbor', 'Dasbor::dasbor', ['filter' => 'role:admin']);
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);

// Restricting User
// $routes->get('/user', 'User::index', ['filter' => 'role:user']);
// $routes->get('/user/index', 'User::index', ['filter' => 'role:user']);

// Anak
$routes->get('/anak', 'Anak::index');
$routes->get('anak-detail/(:any)', 'Anak::detail/$1');
$routes->get('/anak-buat-baru', 'Anak::buatBaru', ['as' => 'tambah-anak']);
// $routes->get('/anak-buat-baru', 'Anak::buatBaru', ['as' => 'ambilDataKotaKabupaten']);
$routes->post('anak-buat-baru', 'Anak::simpan', ['as' => 'simpan-anak']);
$routes->get('/anak-ubah/(:any)', 'Anak::ubah/$1', ['as' => 'ubah-anak']);
$routes->post('anak-ubah/(:num)', 'Anak::perbaharuiData/$1', ['as' => 'perbaharui-anak']);
$routes->delete('anak-hapus/(:num)', 'Anak::hapus/$1', ['as' => 'hapus-anak']);

// Ayah
$routes->get('/ayah', 'Ayah::index');
$routes->get('ayah-detail/(:any)', 'Ayah::detail/$1');
$routes->get('/ayah-buat-baru', 'Ayah::buatBaru', ['as' => 'tambah-ayah']);
// $routes->get('/ayah-buat-baru', 'Ayah::buatBaru', ['as' => 'ambilDataKotaKabupaten']);
$routes->post('ayah-buat-baru', 'Ayah::simpan', ['as' => 'simpan-ayah']);
$routes->get('/ayah-ubah/(:any)', 'Ayah::ubah/$1', ['as' => 'ubah-ayah']);
$routes->post('ayah-ubah/(:num)', 'Ayah::perbaharuiData/$1', ['as' => 'perbaharui-ayah']);
$routes->delete('ayah-hapus/(:num)', 'Ayah::hapus/$1', ['as' => 'hapus-ayah']);

// Ibu
$routes->get('/ibu', 'Ibu::index');
$routes->get('ibu-detail/(:any)', 'Ibu::detail/$1');
$routes->get('/ibu-buat-baru', 'Ibu::buatBaru', ['as' => 'tambah-ibu']);
// $routes->get('/ayah-buat-baru', 'Ayah::buatBaru', ['as' => 'ambilDataKotaKabupaten']);
$routes->post('ibu-buat-baru', 'Ibu::simpan', ['as' => 'simpan-ibu']);
$routes->get('/ibu-ubah/(:any)', 'Ibu::ubah/$1', ['as' => 'ubah-ibu']);
$routes->post('ibu-ubah/(:num)', 'Ibu::perbaharuiData/$1', ['as' => 'perbaharui-ibu']);
$routes->delete('ibu-hapus/(:num)', 'Ibu::hapus/$1', ['as' => 'hapus-ibu']);

// Riwayat Imunisasi
$routes->get('/riwayat-imunisasi', 'RiwayatImunisasi::index');
$routes->get('riwayat-imunisasi-detail/(:any)', 'RiwayatImunisasi::detail/$1');
$routes->get('/riwayat-imunisasi-buat-baru', 'RiwayatImunisasi::buatBaru', ['as' => 'tambah-riwayat-imunisasi']);
// $routes->get('/riwayat-imunisasi-buat-baru', 'RiwayatImunisasi::buatBaru', ['as' => 'ambilDataKotaKabupaten']);
$routes->post('riwayat-imunisasi-buat-baru', 'RiwayatImunisasi::simpan', ['as' => 'simpan-riwayat-imunisasi']);
$routes->get('/riwayat-imunisasi-ubah/(:any)', 'RiwayatImunisasi::ubah/$1', ['as' => 'ubah-riwayat-imunisasi']);
$routes->post('riwayat-imunisasi-ubah/(:num)', 'RiwayatImunisasi::perbaharuiData/$1', ['as' => 'perbaharui-riwayat-imunisasi']);
$routes->delete('riwayat-imunisasi-hapus/(:num)', 'RiwayatImunisasi::hapus/$1', ['as' => 'hapus-riwayat-imunisasi']);

// Riwayat Pertumbuhan
$routes->get('/riwayat-pertumbuhan', 'RiwayatPertumbuhan::index');
$routes->get('riwayat-pertumbuhan-detail/(:any)', 'RiwayatPertumbuhan::detail/$1');
$routes->get('/riwayat-pertumbuhan-buat-baru', 'RiwayatPertumbuhan::buatBaru', ['as' => 'tambah-riwayat-pertumbuhan']);
// $routes->get('/riwayat-pertumbuhan-buat-baru', 'RiwayatPertumbuhan::buatBaru', ['as' => 'ambilDataKotaKabupaten']);
$routes->post('riwayat-pertumbuhan-buat-baru', 'RiwayatPertumbuhan::simpan', ['as' => 'simpan-riwayat-pertumbuhan']);
$routes->get('/riwayat-pertumbuhan-ubah/(:any)', 'RiwayatPertumbuhan::ubah/$1', ['as' => 'ubah-riwayat-pertumbuhan']);
$routes->post('riwayat-pertumbuhan-ubah/(:num)', 'RiwayatPertumbuhan::perbaharuiData/$1', ['as' => 'perbaharui-riwayat-pertumbuhan']);
$routes->delete('riwayat-pertumbuhan-hapus/(:num)', 'RiwayatPertumbuhan::hapus/$1', ['as' => 'hapus-riwayat-pertumbuhan']);

// Jenis Imunisasi
$routes->get('/jenis-imunisasi', 'JenisImunisasi::index');
$routes->get('jenis-imunisasi-detail/(:any)', 'JenisImunisasi::detail/$1');
$routes->get('/jenis-imunisasi-buat-baru', 'JenisImunisasi::buatBaru', ['as' => 'tambah-jenis-imunisasi']);
$routes->post('jenis-imunisasi-buat-baru', 'JenisImunisasi::simpan', ['as' => 'simpan-jenis-imunisasi']);
$routes->get('/jenis-imunisasi-ubah/(:any)', 'JenisImunisasi::ubah/$1', ['as' => 'ubah-jenis-imunisasi']);
$routes->post('jenis-imunisasi-ubah/(:num)', 'JenisImunisasi::perbaharuiData/$1', ['as' => 'perbaharui-jenis-imunisasi']);
$routes->delete('jenis-imunisasi-hapus/(:num)', 'JenisImunisasi::hapus/$1', ['as' => 'hapus-jenis-imunisasi']);

// Jadwal Imunisasi
$routes->get('/jadwal-imunisasi', 'JadwalImunisasi::index');
$routes->get('jadwal-imunisasi-detail/(:any)', 'JadwalImunisasi::detail/$1');
$routes->get('/jadwal-imunisasi-buat-baru', 'JadwalImunisasi::buatBaru', ['as' => 'tambah-jadwal-imunisasi']);
$routes->get('/jadwal-imunisasi-buat-baru', 'JadwalImunisasi::buatBaru', ['as' => 'ambilDataKotaKabupaten']);
$routes->post('jadwal-imunisasi-buat-baru', 'JadwalImunisasi::simpan', ['as' => 'simpan-jadwal-imunisasi']);
$routes->get('/jadwal-imunisasi-ubah/(:any)', 'JadwalImunisasi::ubah/$1', ['as' => 'ubah-jadwal-imunisasi']);
$routes->post('jadwal-imunisasi-ubah/(:num)', 'JadwalImunisasi::perbaharuiData/$1', ['as' => 'perbaharui-jadwal-imunisasi']);
$routes->delete('jadwal-imunisasi-hapus/(:num)', 'JadwalImunisasi::hapus/$1', ['as' => 'hapus-jadwal-imunisasi']);

// Faskes
$routes->get('/faskes', 'Faskes::index');
$routes->get('faskes-detail/(:any)', 'Faskes::detail/$1');
$routes->get('/faskes-buat-baru', 'Faskes::buatBaru', ['as' => 'tambah-faskes']);
// $routes->get('/faskes-buat-baru', 'Faskes::buatBaru', ['as' => 'ambilDataKotaKabupaten']);
$routes->post('faskes-buat-baru', 'Faskes::simpan', ['as' => 'simpan-faskes']);
$routes->get('/faskes-ubah/(:any)', 'Faskes::ubah/$1', ['as' => 'ubah-faskes']);
$routes->post('faskes-ubah/(:num)', 'Faskes::perbaharuiData/$1', ['as' => 'perbaharui-faskes']);
$routes->delete('faskes-hapus/(:num)', 'Faskes::hapus/$1', ['as' => 'hapus-faskes']);

// Artikel
$routes->get('/artikel', 'Artikel::index');
$routes->get('artikel-detail/(:any)', 'Artikel::detail/$1');
$routes->get('/artikel-buat-baru', 'Artikel::buatBaru', ['as' => 'tambah-artikel']);
$routes->post('artikel-buat-baru', 'Artikel::simpan', ['as' => 'simpan-artikel']);
$routes->get('/artikel-ubah/(:any)', 'Artikel::ubah/$1', ['as' => 'ubah-artikel']);
$routes->post('artikel-ubah/(:num)', 'Artikel::perbaharuiData/$1', ['as' => 'perbaharui-artikel']);
$routes->delete('artikel-hapus/(:num)', 'Artikel::hapus/$1', ['as' => 'hapus-artikel']);

// Artikel Kategori
$routes->get('/artikel-kategori', 'ArtikelKategori::index');
$routes->get('artikel-kategori-detail/(:any)', 'ArtikelKategori::detail/$1');
$routes->get('/artikel-kategori-buat-baru', 'ArtikelKategori::buatBaru', ['as' => 'tambah-artikel-kategori']);
$routes->post('artikel-kategori-buat-baru', 'ArtikelKategori::simpan', ['as' => 'simpan-artikel-kategori']);
$routes->get('/artikel-kategori-ubah/(:any)', 'ArtikelKategori::ubah/$1', ['as' => 'ubah-artikel-kategori']);
$routes->post('artikel-kategori-ubah/(:num)', 'ArtikelKategori::perbaharuiData/$1', ['as' => 'perbaharui-artikel-kategori']);
$routes->delete('artikel-kategori-hapus/(:num)', 'ArtikelKategori::hapus/$1', ['as' => 'hapus-artikel-kategori']);

// Imunisasi
$routes->get('/imunisasi', 'Imunisasi::index');



// Kota dan Kabupaten
$routes->get('/kota-kabupaten', 'KotaKabupaten::index');
$routes->get('kota-kabupaten-detail/(:any)', 'KotaKabupaten::detail/$1');
$routes->get('/kota-kabupaten-buat-baru', 'KotaKabupaten::buatBaru', ['as' => 'tambah-kota-kabupaten']);
$routes->post('kota-kabupaten-baru', 'KotaKabupaten::simpan', ['as' => 'simpan-kota-kabupaten']);
$routes->get('/kota-kabupaten-ubah/(:any)', 'KotaKabupaten::ubah/$1', ['as' => 'ubah-kota-kabupaten']);
$routes->post('kota-kabupaten-ubah/(:num)', 'KotaKabupaten::perbaharuiData/$1', ['as' => 'perbaharui-kota-kabupaten']);
$routes->delete('kota-kabupaten-hapus/(:num)', 'KotaKabupaten::hapus/$1', ['as' => 'hapus-kota-kabupaten']);

// Kecamatan
$routes->get('/kecamatan', 'Kecamatan::index');
$routes->get('kecamatan-detail/(:any)', 'Kecamatan::detail/$1');
$routes->get('/kecamatan-buat-baru', 'Kecamatan::buatBaru', ['as' => 'tambah-kecamatan']);
$routes->post('kecamatan-baru', 'Kecamatan::simpan', ['as' => 'simpan-kecamatan']);
$routes->get('/kecamatan-ubah/(:any)', 'Kecamatan::ubah/$1', ['as' => 'ubah-kecamatan']);
$routes->post('kecamatan-ubah/(:num)', 'Kecamatan::perbaharuiData/$1', ['as' => 'perbaharui-kecamatan']);
$routes->delete('kecamatan-hapus/(:num)', 'Kecamatan::hapus/$1', ['as' => 'hapus-kecamatan']);

// Kelurahan
$routes->get('/kelurahan-desa', 'KelurahanDesa::index');
$routes->get('kelurahan-desa-detail/(:any)', 'KelurahanDesa::detail/$1');
$routes->get('/kelurahan-desa-buat-baru', 'KelurahanDesa::buatBaru', ['as' => 'tambah-kelurahan-desa']);
$routes->post('kelurahan-desa-baru', 'KelurahanDesa::simpan', ['as' => 'simpan-kelurahan-desa']);
$routes->get('/kelurahan-desa-ubah/(:any)', 'KelurahanDesa::ubah/$1', ['as' => 'ubah-kelurahan-desa']);
$routes->post('kelurahan-desa-ubah/(:num)', 'KelurahanDesa::perbaharuiData/$1', ['as' => 'perbaharui-kelurahan-desa']);
$routes->delete('kelurahan-desa-hapus/(:num)', 'KelurahanDesa::hapus/$1', ['as' => 'hapus-kelurahan-desa']);

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
