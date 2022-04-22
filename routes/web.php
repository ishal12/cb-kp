<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/karyawan/login', 'Auth\KaryawanLoginController@showLoginForm')->name('karyawan.login');
Route::post('/karyawan/login', 'Auth\KaryawanLoginController@login')->name('karyawan.login.submit');
Route::get('/karyawan/logout', 'Auth\KaryawanLoginController@logout')->name('karyawan.logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/karyawan/cuti', 'KaryawanCutiController');
Route::resource('/karyawan/profil', 'KaryawanProfilController');
Route::resource('/pimpinan/laporanCuti', 'PimpinanLaporanCutiController');
Route::resource('/pimpinan/pemberitahuanCuti', 'PemberitahuanCutiController');
Route::resource('/hrd/absnKalender', 'AbsensiKalenderController');
Route::put('/hrd/absnKalender/semua/{semua}', 'AbsensiKalenderController@semua')->name('absnKalender.semua');
Route::resource('/hrd/hariLibur', 'HariLiburController');
Route::resource('/hrd/absnRiwayat', 'AbsensiRiwayatController');
Route::resource('/hrd/profilKaryawan', 'MasterKaryawanController');
Route::resource('/hrd/riwayatCuti', 'RiwayatCutiController');
Route::resource('/hrd/kategoriCuti', 'KategoriCutiController');
Route::resource('/hrd/ubahSakit', 'UbahSakitController');
Route::resource('/pimpinan/perubahanCuti', 'PerubahanCutiController');
