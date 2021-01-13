<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/downloadsql', function(){
    $pathToFile = 'dump.sql';
    Spatie\DbDumper\Databases\MySql::create()
        ->setHost(env('DB_HOST'))
        ->setDbName(env('DB_DATABASE'))
        ->setUserName(env('DB_USERNAME'))
        ->setPassword(env('DB_PASSWORD'))
        ->dumpToFile($pathToFile);

    return response()->download($pathToFile);
});

Auth::routes();

Route::group(['middleware' => ['admin']], function () {
    //Admin
    Route::get('/admin/home', 'Admin\AdminHomeController@index')->name('admin.home');
    Route::resource('admin/siswa', 'Admin\AdminSiswaController');
    Route::resource('admin/guru', 'Admin\AdminGuruController');
    Route::resource('admin/spp', 'Admin\AdminSppController');
    Route::resource('admin/kegiatan', 'Admin\AdminKegiatanController');
    Route::put('admin/guru/password/{guru}', 'Admin\AdminGuruController@reset')->name('admin.guru.reset');
    Route::get('admin/laporan/spp', 'Admin\AdminSppController@laporan')->name('admin.laporan.home');
    Route::get('admin/laporan/spp/cetak', 'Admin\AdminSppController@cetak')->name('admin.spp.cetak');
    Route::get('admin/spp/resi/{id}', 'Admin\AdminSppController@resi')->name('admin.spp.resi');
    //
    Route::get('admin/absen/siswa', 'Admin\AdminAbsenSiswaController@index')->name('admin.absen.siswa.index');
    Route::get('admin/absen/siswa/create', 'Admin\AdminAbsenSiswaController@create')->name('admin.absen.siswa.create');
    Route::post('admin/absen/siswa/store', 'Admin\AdminAbsenSiswaController@store')->name('admin.absen.siswa.store');
    Route::get('admin/absen/siswa/edit/{id}', 'Admin\AdminAbsenSiswaController@edit')->name('admin.absen.siswa.edit');
    Route::put('admin/absen/siswa/update/{id}', 'Admin\AdminAbsenSiswaController@update')->name('admin.absen.siswa.update');
    Route::delete('admin/absen/siswa/delete/{id}', 'Admin\AdminAbsenSiswaController@delete')->name('admin.absen.siswa.delete');
    Route::get('admin/monitoring/siswa', 'Admin\AdminMonitoringSiswaController@index')->name('admin.monitoring.index');
    Route::get('admin/monitoring/siswa/create', 'Admin\AdminMonitoringSiswaController@create')->name('admin.monitoring.create');
    Route::post('admin/monitoring/siswa/store', 'Admin\AdminMonitoringSiswaController@store')->name('admin.monitoring.store');
    Route::get('admin/monitoring/siswa/edit/{id}', 'Admin\AdminMonitoringSiswaController@edit')->name('admin.monitoring.edit');
    Route::put('admin/monitoring/siswa/update/{id}', 'Admin\AdminMonitoringSiswaController@update')->name('admin.monitoring.update');
    Route::delete('admin/monitoring/siswa/delete/{id}', 'Admin\AdminMonitoringSiswaController@delete')->name('admin.monitoring.delete');
    //
    Route::get('admin/absen/guru', 'Admin\AdminAbsenGuruController@index')->name('admin.absen.guru.index');
    Route::get('admin/absen/guru/create', 'Admin\AdminAbsenGuruController@create')->name('admin.absen.guru.create');
    Route::post('admin/absen/guru/store', 'Admin\AdminAbsenGuruController@store')->name('admin.absen.guru.store');
    Route::get('admin/absen/guru/edit/{id}', 'Admin\AdminAbsenGuruController@edit')->name('admin.absen.guru.edit');
    Route::put('admin/absen/guru/update/{id}', 'Admin\AdminAbsenGuruController@update')->name('admin.absen.guru.update');
    Route::delete('admin/absen/guru/delete/{id}', 'Admin\AdminAbsenGuruController@delete')->name('admin.absen.guru.delete');
    //
    Route::get('admin/change_password/index', 'Admin\AdminChangePasswordController@index')->name('admin.change.password.index');
    Route::post('admin/change_password/index', 'Admin\AdminChangePasswordController@store')->name('admin.change.password.store');
    // 
    Route::get('admin/guru/export/export_excel', 'Admin\AdminGuruController@export_excel')->name('admin.guru.export_excel');
    Route::get('admin/guru/import/import_excel', 'Admin\AdminGuruController@import_excel_view')->name('admin.guru.import_excel_view');
    Route::post('admin/guru/import/import_excel/store', 'Admin\AdminGuruController@import_excel')->name('admin.guru.import_excel');

    Route::get('admin/siswa/export/export_excel', 'Admin\AdminSiswaController@export_excel')->name('admin.siswa.export_excel');
    Route::get('admin/siswa/import/import_excel', 'Admin\AdminSiswaController@import_excel_view')->name('admin.siswa.import_excel_view');
    Route::post('admin/siswa/import/import_excel/store', 'Admin\AdminSiswaController@import_excel')->name('admin.siswa.import_excel');

    Route::get('admin/absen_guru/export/export_excel', 'Admin\AdminAbsenGuruController@export_excel')->name('admin.absen_guru.export_excel');
    Route::get('admin/absen_guru/import/import_excel', 'Admin\AdminAbsenGuruController@import_excel_view')->name('admin.absen_guru.import_excel_view');
    Route::post('admin/absen_guru/import/import_excel/store', 'Admin\AdminAbsenGuruController@import_excel')->name('admin.absen_guru.import_excel');

    Route::get('admin/kegiatan/export/export_excel', 'Admin\AdminKegiatanController@export_excel')->name('admin.kegiatan.export_excel');
    Route::get('admin/kegiatan/import/import_excel', 'Admin\AdminKegiatanController@import_excel_view')->name('admin.kegiatan.import_excel_view');
    Route::post('admin/kegiatan/import/import_excel/store', 'Admin\AdminKegiatanController@import_excel')->name('admin.kegiatan.import_excel');
    // 
    Route::get('admin/database', 'Admin\AdminDatabaseController@index')->name('admin.database.index');
    Route::get('admin/database/create', 'Admin\AdminDatabaseController@create')->name('admin.database.create');
    Route::post('admin/database/store', 'Admin\AdminDatabaseController@store')->name('admin.database.store');
    Route::get('admin/database/download', function(){
        $pathToFile = 'database.sql';
        Spatie\DbDumper\Databases\MySql::create()
            ->setHost(env('DB_HOST'))
            ->setDbName(env('DB_DATABASE'))
            ->setUserName(env('DB_USERNAME'))
            ->setPassword(env('DB_PASSWORD'))
            ->dumpToFile($pathToFile);
    
        return response()->download($pathToFile);
    })->name('admin.database.download_database');
});


Route::group(['middleware' => ['guru']], function () {
    //Guru
    Route::get('/guru/home', 'Guru\GuruHomeController@index')->name('guru.home');
    // Route::resource('guru/siswa', 'Guru\GuruSiswaController');
    Route::get('guru/siswa', 'Guru\GuruSiswaController@index')->name('guru.siswa.index');
    Route::get('guru/siswa/show/{id}', 'Guru\GuruSiswaController@show')->name('guru.siswa.show');
    Route::get('guru/siswa/create', 'Guru\GuruSiswaController@create')->name('guru.siswa.create');
    Route::post('guru/siswa/store', 'Guru\GuruSiswaController@store')->name('guru.siswa.store');
    Route::get('guru/siswa/edit/{id}', 'Guru\GuruSiswaController@edit')->name('guru.siswa.edit');
    Route::post('guru/siswa/update/{id}', 'Guru\GuruSiswaController@update')->name('guru.siswa.update');
    Route::delete('guru/siswa/delete/{id}', 'Guru\GuruSiswaController@delete')->name('guru.siswa.delete');
    
    // Route::resource('guru/spp', 'Guru\GuruSppController');
    Route::get('guru/spp', 'Guru\GuruSppController@index')->name('guru.spp.index');
    Route::get('guru/spp/create', 'Guru\GuruSppController@create')->name('guru.spp.create');
    Route::post('guru/spp/store', 'Guru\GuruSppController@store')->name('guru.spp.store');
    Route::get('guru/spp/edit/{id}', 'Guru\GuruSppController@edit')->name('guru.spp.edit');
    Route::put('guru/spp/update/{id}', 'Guru\GuruSppController@update')->name('guru.spp.update');
    Route::delete('guru/spp/delete/{id}', 'Guru\GuruSppController@delete')->name('guru.spp.delete');
    
    // Route::resource('guru/kegiatan', 'Guru\GuruKegiatanController');
    Route::get('guru/kegiatan', 'Guru\GuruKegiatanController@index')->name('guru.kegiatan.index');
    Route::get('guru/kegiatan/create', 'Guru\GuruKegiatanController@create')->name('guru.kegiatan.create');
    Route::post('guru/kegiatan/store', 'Guru\GuruKegiatanController@store')->name('guru.kegiatan.store');
    Route::get('guru/kegiatan/edit/{id}', 'Guru\GuruKegiatanController@edit')->name('guru.kegiatan.edit');
    Route::put('guru/kegiatan/update/{id}', 'Guru\GuruKegiatanController@update')->name('guru.kegiatan.update');
    Route::delete('guru/kegiatan/delete/{id}', 'Guru\GuruKegiatanController@delete')->name('guru.kegiatan.delete');
    
    Route::get('guru/laporan/spp', 'Guru\GuruSppController@laporan')->name('guru.laporan.home');
    Route::get('guru/laporan/spp/cetak', 'Guru\GuruSppController@cetak')->name('guru.spp.cetak');
    Route::get('guru/spp/resi/{id}', 'Guru\GuruSppController@resi')->name('guru.spp.resi');
    //
    Route::get('guru/absen/siswa', 'Guru\GuruAbsenSiswaController@index')->name('guru.absen.siswa.index');
    Route::get('guru/absen/siswa/create', 'Guru\GuruAbsenSiswaController@create')->name('guru.absen.siswa.create');
    Route::post('guru/absen/siswa/store', 'Guru\GuruAbsenSiswaController@store')->name('guru.absen.siswa.store');
    Route::get('guru/absen/siswa/edit/{id}', 'Guru\GuruAbsenSiswaController@edit')->name('guru.absen.siswa.edit');
    Route::put('guru/absen/siswa/update/{id}', 'Guru\GuruAbsenSiswaController@update')->name('guru.absen.siswa.update');
    Route::delete('guru/absen/siswa/delete/{id}', 'Guru\GuruAbsenSiswaController@delete')->name('guru.absen.siswa.delete');
    Route::get('guru/monitoring/siswa', 'Guru\GuruMonitoringSiswaController@index')->name('guru.monitoring.index');
    Route::get('guru/monitoring/siswa/create', 'Guru\GuruMonitoringSiswaController@create')->name('guru.monitoring.create');
    Route::post('guru/monitoring/siswa/store', 'Guru\GuruMonitoringSiswaController@store')->name('guru.monitoring.store');
    Route::get('guru/monitoring/siswa/edit/{id}', 'Guru\GuruMonitoringSiswaController@edit')->name('guru.monitoring.edit');
    Route::put('guru/monitoring/siswa/update/{id}', 'Guru\GuruMonitoringSiswaController@update')->name('guru.monitoring.update');
    Route::delete('guru/monitoring/siswa/delete/{id}', 'Guru\GuruMonitoringSiswaController@delete')->name('guru.monitoring.delete');
    //
    Route::get('guru/change_password/index', 'Guru\GuruChangePasswordController@index')->name('guru.change.password.index');
    Route::post('guru/change_password/index', 'Guru\GuruChangePasswordController@store')->name('guru.change.password.store');
    // 
    Route::get('guru/absen_siswa/export/export_excel', 'Guru\GuruAbsenSiswaController@export_excel')->name('guru.absen_siswa.export_excel');
    Route::get('guru/absen_siswa/import/import_excel', 'Guru\GuruAbsenSiswaController@import_excel_view')->name('guru.absen_siswa.import_excel_view');
    Route::post('guru/absen_siswa/import/import_excel/store', 'Guru\GuruAbsenSiswaController@import_excel')->name('guru.absen_siswa.import_excel');

    Route::get('guru/spp/export/export_excel', 'Guru\GuruSppController@export_excel')->name('guru.spp.export_excel');
    Route::get('guru/spp/import/import_excel', 'Guru\GuruSppController@import_excel_view')->name('guru.spp.import_excel_view');
    Route::post('guru/spp/import/import_excel/store', 'Guru\GuruSppController@import_excel')->name('guru.spp.import_excel');

    Route::get('guru/monitoring/siswa/export/export_excel', 'Guru\GuruMonitoringSiswaController@export_excel')->name('guru.monitoring.export_excel');
    Route::get('guru/monitoring/siswa/import/import_excel', 'Guru\GuruMonitoringSiswaController@import_excel_view')->name('guru.monitoring.import_excel_view');
    Route::post('guru/monitoring/siswa/import/import_excel/store', 'Guru\GuruMonitoringSiswaController@import_excel')->name('guru.monitoring.import_excel');
});