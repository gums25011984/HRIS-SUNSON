<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//mhkaryawan
Route::get('hkaryawan','chkaryawan@index');

//jadwal kerja
Route::get('jadwalkerja','cjadwalkerja@index');


//rjabatan
Route::get('rjabatan','rjabatan@index');

//rspt
Route::get('permintaan','permintaan@index');

//rspt
Route::get('role_permission','crole_permission@index');

//rspt
Route::get('rspt','rspt@index');

//mspt
Route::get('spt','cspt@index');

// departement
Route::get('departement','CDepartementController@index');
/*Route::get('/departement/{id}','CDepartementController@show');*/
Route::post('/departement/store','CDepartementController@store');
Route::put('/departement/update/{id}','CDepartementController@update');
Route::delete('/departement/delete/{id}','CDepartementController@delete');

//alat kontrasepsi
/*Route::get('alat_kontrasepsi','CAlat_kontrasepsi@index');
Route::get('/alat_kontrasepsi/{id}','Calat_kontrasepsi@show');
Route::post('/alat_kontrasepsi/store','Calat_kontrasepsi@store');
Route::put('/alat_kontrasepsi/update/{id}','Calat_kontrasepsi@update');
Route::get('/alat_kontrasepsi/delete/{id}','Calat_kontrasepsi@delete');*/

//divisi
Route::get('divisi','Cdivisi@index');
Route::get('/divisi/show/{id}','Cdivisi@show');
Route::post('/divisi/store','Cdivisi@store');
Route::put('/divisi/update/{id}','Cdivisi@update');
Route::get('/divisi/delete/{id}','Cdivisi@delete');

//permission_role
Route::get('permission_role','cpermission_role@index');
Route::get('/permission_role/show/{id}','cpermission_role@show');
Route::post('/permission_role/store','cpermission_role@store');
Route::put('/permission_role/update/{id}','cpermission_role@update');
Route::get('/permission_role/delete/{id}','cpermission_role@delete');

//divisi
Route::get('jabatan','cjabatan@index');
Route::get('/jabatan/show/{id}','cjabatan@show');
Route::post('/jabatan/store','cjabatan@store');
Route::put('/jabatan/update/{id}','cjabatan@update');
Route::get('/jabatan/delete/{id}','cjabatan@delete');

//pendidikan
Route::get('pendidikan','cpendidikan@index');
Route::get('/pendidikan/show/{id}','cpendidikan@show');
Route::post('/pendidikan/store','cpendidikan@store');
Route::put('/pendidikan/update/{id}','cpendidikan@update');
Route::get('/pendidikan/delete/{id}','cpendidikan@delete');

//status_kerja
Route::get('status_kerja','cstatus_kerja@index');
Route::get('/status_kerja/show/{id}','cstatus_kerja@show');
Route::post('/status_kerja/store','cstatus_kerja@store');
Route::put('/status_kerja/update/{id}','cstatus_kerja@update');
Route::get('/status_kerja/delete/{id}','cstatus_kerja@delete');

//status_pernikahan
Route::get('status_pernikahan','cstatus_pernikahan@index');
Route::get('/status_pernikahan/show/{id}','cstatus_pernikahan@show');
Route::post('/status_pernikahan/store','cstatus_pernikahan@store');
Route::put('/status_pernikahan/update/{id}','cstatus_pernikahan@update');
Route::get('/status_pernikahan/delete/{id}','cstatus_pernikahan@delete');

//mgroup_kerja
Route::get('mgroup_kerja','cmgroup_kerja@index');
Route::get('/mgroup_kerja/show/{id}','cmgroup_kerja@show');
Route::post('/mgroup_kerja/store','cmgroup_kerja@store');
Route::put('/mgroup_kerja/update/{id}','cmgroup_kerja@update');
Route::get('/mgroup_kerja/delete/{id}','cmgroup_kerja@delete');

//master_pelanggaran
Route::get('master_pelanggaran','cmaster_pelanggaran@index');
Route::get('/master_pelanggaran/{id}','cmaster_pelanggaran@show');
Route::post('/master_pelanggaran/store','cmaster_pelanggaran@store');
Route::put('/master_pelanggaran/update/{id}','cmaster_pelanggaran@update');
Route::get('/master_pelanggaran/delete/{id}','cmaster_pelanggaran@delete');

//sangsi
Route::get('sangsi','csangsi@index');
Route::get('/sangsi/show/{id}','csangsi@show');
Route::post('/sangsi/store','csangsi@store');
Route::put('/sangsi/update/{id}','csangsi@update');
Route::get('/sangsi/delete/{id}','csangsi@delete');

//perijinan
Route::get('perijinan','cperijinan@index');
Route::get('/perijinan/show/{id}','cperijinan@show');
Route::post('/perijinan/store','cperijinan@store');
Route::put('/perijinan/update/{id}','cperijinan@update');
Route::get('/perijinan/delete/{id}','cperijinan@delete');

//transportlembur
Route::get('transportlembur','ctransportlembur@index');
Route::get('/transportlembur/show/{id}','ctransportlembur@show');
Route::post('/transportlembur/store','ctransportlembur@store');
Route::put('/transportlembur/update/{id}','ctransportlembur@update');
Route::get('/transportlembur/delete/{id}','ctransportlembur@delete');

//karyawan
Route::get('karyawan','ckaryawan@index');
Route::get('/karyawan/show/{id}','ckaryawan@show');
Route::post('/karyawan/store','ckaryawan@store');
Route::put('/karyawan/update/{id}','ckaryawan@update');
Route::get('/karyawan/delete/{id}','ckaryawan@delete');

//combo form karyawan
Route::get('/karyawan/propinsi','ckaryawan@propinsi');
Route::get('/karyawan/kabupaten','ckaryawan@kabupaten');
Route::get('/karyawan/kecamatan','ckaryawan@kecamatan');
Route::get('/karyawan/desa','ckaryawan@desa');
Route::get('/karyawan/status_pernikahan','ckaryawan@status_pernikahan');
Route::get('/karyawan/alat_kontrasepsi','ckaryawan@alat_kontrasepsi');
Route::get('/karyawan/jabatan','ckaryawan@jabatan');
Route::get('/karyawan/pendidikan','ckaryawan@pendidikan');
Route::get('/karyawan/divisi','ckaryawan@divisi');
Route::get('/karyawan/departemen','ckaryawan@departemen');
Route::get('/karyawan/status_kerja','ckaryawan@status_kerja');
Route::get('/karyawan/mgroup_kerja','ckaryawan@mgroup_kerja');
Route::get('/karyawan/transportlembur','ckaryawan@transportlembur');

//ijin
Route::get('ijin','cijin@index');
Route::get('/ijin/show/{id}','cijin@show');
Route::post('/ijin/store','cijin@store');
Route::put('/ijin/update/{id}','cijin@update');
Route::get('/ijin/delete/{id}','cijin@delete');
//combo form ijin
Route::get('/ijin/cmbijin','cijin@cmbijin');
//combo form popup
Route::get('/ijin/popup_karyawan','cijin@popup_karyawan');

//absen
Route::get('absen','cabsen@index');

//pelanggaran
Route::get('pelanggaran','cpelanggaran@index');
Route::get('/pelanggaran/show/{id}','cpelanggaran@show');
Route::post('/pelanggaran/store','cpelanggaran@store');
Route::put('/pelanggaran/update/{id}','cpelanggaran@update');
Route::get('/pelanggaran/delete/{id}','cpelanggaran@delete');
//combo form pelanggaran
Route::get('/pelanggaran/cmbpelanggaran','cpelanggaran@cmbpelanggaran');
//combo form popup
Route::get('/pelanggaran/popup_karyawan','cpelanggaran@popup_karyawan');

//parameter
Route::get('parameter','cparameter@index');
Route::get('/parameter/show/{id}','cparameter@show');
Route::post('/parameter/store','cparameter@store');
Route::put('/parameter/update/{id}','cparameter@update');
Route::get('/parameter/delete/{id}','cparameter@delete');

//jadwal_kerja
Route::get('jadwal_kerja','cjadwal_kerja@index');
Route::get('/jadwal_kerja/show/{id}','cjadwal_kerja@show');
Route::post('/jadwal_kerja/store','cjadwal_kerja@store');
Route::put('/jadwal_kerja/update/{id}','cjadwal_kerja@update');
Route::get('/jadwal_kerja/delete/{id}','cjadwal_kerja@delete');

//libur_nasional
Route::get('libur_nasional','clibur_nasional@index');
Route::get('/libur_nasional/show/{id}','clibur_nasional@show');
Route::post('/libur_nasional/store','clibur_nasional@store');
Route::put('/libur_nasional/update/{id}','clibur_nasional@update');
Route::get('/libur_nasional/delete/{id}','clibur_nasional@delete');

//spl
Route::get('spl','cspl@index');
Route::get('/spl/show/{id}','cspl@show');
Route::post('/spl/store','cspl@store');
Route::put('/spl/update/{id}','cspl@update');
Route::get('/spl/delete/{id}','cspl@delete');
Route::get('/spl/cmbspl','cspl@cmbspl');
Route::get('/spl/popup_karyawan','cspl@popup_karyawan');

//listcuti
Route::get('listcuti','clistcuti@index');

//mutasi
Route::get('mutasi','cmutasi@index');
Route::get('/mutasi/show/{id}','cmutasi@show');
Route::post('/mutasi/store','cmutasi@store');
Route::put('/mutasi/update/{id}','cmutasi@update');
Route::get('/mutasi/delete/{id}','cmutasi@delete');
//combo form mutasi
Route::get('/mutasi/departement_baru','cmutasi@departement_baru');
Route::get('/mutasi/divisi_baru','cmutasi@divisi_baru');
Route::get('/mutasi/jabatan_baru','cmutasi@jabatan_baru');

//gapok
Route::get('gapok','cgapok@index');
Route::get('/gapok/show/{id}','cgapok@show');
Route::post('/gapok/store','cgapok@store');
Route::put('/gapok/update/{id}','cgapok@update');
Route::get('/gapok/delete/{id}','cgapok@delete');

//slipgaji
Route::get('slipgaji','cslipgaji@index');

//pribadiprofile
Route::get('pribadiprofile','cpribadiprofile@index');
Route::get('pribadiprofile/pribadi_cuti_diambil','cpribadiprofile@pribadi_cuti_diambil');
Route::get('pribadiprofile/pribadi_cuti','cpribadiprofile@pribadi_cuti');
Route::get('pribadiprofile/pribadi_ppkl','cpribadiprofile@pribadi_ppkl');

//pribadislipgaji
Route::get('pribadislipgaji','cpribadislipgaji@index');
Route::get('pribadislipgaji/pribadi_slipgaji','cpribadislipgaji@pribadi_slipgaji');

//pribadiijin
Route::get('pribadiijin','cpribadiijin@index');
Route::get('pribadiijin/pribadi_persetujuan','cpribadiijin@pribadi_persetujuan');

//pribadispkl
Route::get('pribadispkl','cpribadispkl@index');
Route::get('pribadispkl/pribadi_spkl','cpribadispkl@pribadi_spkl');

//pribadimutasi
Route::get('pribadimutasi','cpribadimutasi@index');
Route::get('pribadimutasi/pribadi_mutasi','cpribadimutasi@pribadi_mutasi');

//main_menu
Route::get('main_menu','cmain_menu@index');
Route::get('/main_menu/show/{id}','cmain_menu@show');
Route::post('/main_menu/store','cmain_menu@store');
Route::put('/main_menu/update/{id}','cmain_menu@update');
Route::get('/main_menu/delete/{id}','cmain_menu@delete');

//submenu
Route::get('submenu','csubmenu@index');
Route::get('/submenu/show/{id}','csubmenu@show');
Route::post('/submenu/store','csubmenu@store');
Route::put('/submenu/update/{id}','csubmenu@update');
Route::get('/submenu/delete/{id}','csubmenu@delete');

//user
Route::get('user','cuser@index');
Route::get('/user/show/{id}','cuser@show');
Route::post('/user/store','cuser@store');
Route::put('/user/update/{id}','cuser@update');
Route::get('/user/delete/{id}','cuser@delete');

//hak_akses
Route::get('hak_akses','chak_akses@index');
Route::get('/hak_akses/show/{id}','chak_akses@show');
Route::post('/hak_akses/store','chak_akses@store');
Route::put('/hak_akses/update/{id}','chak_akses@update');
Route::get('/hak_akses/delete/{id}','chak_akses@delete');

//dashboard
Route::get('dashboard','cdashboard@index');
Route::get('dashboard/approved','cdashboard@approved');
Route::get('dashboard/reject','cdashboard@reject');
Route::get('dashboard/kesiangan','cdashboard@kesiangan');
Route::get('dashboard/mangkir','cdashboard@mangkir');

Route::get('dashboard/pelanggaran_baru','cdashboard@pelanggaran_baru');
Route::get('dashboard/pelanggaran_aktif','cdashboard@pelanggaran_aktif');
Route::get('dashboard/habis_kontrak','cdashboard@habis_kontrak');

