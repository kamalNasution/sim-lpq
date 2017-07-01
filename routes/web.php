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

Route::get('/login', function () {
    return view('login');
});

Route::get('/jadwal', 'ControllerJadwal@jadwal_KBM');

Route::get('/user/dasbor', function () {
    return view('user.dasbor');
});

Route::get('/user/akun', function () {
    return view('user.akun');
});

Route::get('/user/kelompok', function () {
    return view('user.kelompok');
});

Route::get('/user/penjadwalan', function () {
    return view('user.penjadwalan');
});

Route::get('/user/penjadwalan-hapus', function () {
    return view('user.penjadwalan-hapus');
});

Route::get('/user/program-edit', function () {
    return view('user.program-edit');
});

Route::get('/user/program-hapus', function () {
    return view('user.program-hapus');
});

Route::get('/user/program-tambah', function () {
    return view('user.program-tambah');
});

Route::get('/user/spp', function () {
    return view('user.spp');
});

Route::get('/admin/anggota', function () {
    return view('admin.anggota');
});

Route::get('/admin/beranda', function () {
    return view('admin.beranda');
});
Route::get('/admin/dasbor', function () {
    return view('admin.dasbor');
});

Route::get('/admin/download', function () {
    return view('admin.download');
});

Route::get('/admin/santri', function () {
    return view('admin.santri');
});
Route::get('/admin/pengajar', function () {
    return view('admin.pengajar');
});
Route::get('/admin/kelompok', function () {
    return view('admin.kelompok');
});


//Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('daftar', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('daftar', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::group(['prefix' => 'dasbor', 'middleware' => ['role:member']], function() {
    Route::get('/', 'ControllerMember@index');

    Route::get('/akun', 'ControllerMember@edit');
    Route::post('/akun/edit', 'ControllerMember@simpan');

    Route::get('/program/tambah', 'ControllerMember@program_baru');
    Route::post('/program/tambah/pengajar', 'ControllerPengajar@tambah');
    Route::post('/program/tambah/santri', 'ControllerSantri@tambah');

    Route::get('/program/edit', 'ControllerMember@program_edit');
    Route::post('/program/edit/pengajar', 'ControllerPengajar@simpan');
    Route::post('/program/edit/santri', 'ControllerSantri@simpan');

    Route::get('/program/hapus', 'ControllerMember@program_konfirmasiHapus');
    Route::post('/program/hapus/pengajar', 'ControllerPengajar@hapus');
    Route::post('/program/hapus/santri', 'ControllerSantri@hapus');

    Route::get('/penjadwalan', 'ControllerJadwal@index');
    Route::post('/penjadwalan/tambah', 'ControllerJadwal@tambah');
    Route::post('/penjadwalan/edit', 'ControllerJadwal@simpan');
    Route::get('/penjadwalan/hapus', 'ControllerJadwal@konfirmasiHapus');
    Route::post('/penjadwalan/hapus', 'ControllerJadwal@hapus');

    Route::get('/kelompok', 'ControllerKelompok@index');

    Route::get('/spp', 'ControllerSPP@index');

    //Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::get('/', 'ControllerAdmin@index');
    Route::post('/pengaturan/edit', 'ControllerAdmin@pengaturan_simpan');
    Route::get('/download', 'ControllerAdmin@download');
    Route::post('/download/proses', 'ControllerAdmin@download_proses');

    Route::get('/anggota', 'ControllerMember@member_index');
    Route::post('/anggota/tambah', 'ControllerMember@tambah');
    Route::post('/anggota/edit', 'ControllerMember@simpan');
    Route::post('/anggota/hapus', 'ControllerMember@hapus');

    Route::get('/pengajar', 'ControllerPengajar@index');
    Route::post('/pengajar/tambah', 'ControllerPengajar@tambah');
    Route::post('/pengajar/edit', 'ControllerPengajar@simpan');
    Route::post('/pengajar/hapus', 'ControllerPengajar@hapus');

    Route::get('/santri', 'ControllerPengajar@santri');
    Route::post('/santri/tambah', 'ControllerSantri@tambah');
    Route::post('/santri/edit', 'ControllerSantri@simpan');
    Route::post('/santri/hapus', 'ControllerSantri@hapus');

    Route::get('/kelompok', 'ControllerKelompok@index');
    Route::post('/kelompok/jadwal/tambah', 'ControllerJadwal@tambah');
    Route::post('/kelompok/jadwal/edit', 'ControllerJadwal@simpan');
    Route::post('/kelompok/jadwal/hapus', 'ControllerJadwal@hapus');
    Route::post('/kelompok/tambah', 'ControllerKelompok@tambah');
    Route::post('/kelompok/hapus', 'ControllerKelompok@hapus');

    Route::get('/spp', 'ControllerSPP@index');
    Route::post('/spp/edit', 'ControllerSPP@simpan');

    //Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
