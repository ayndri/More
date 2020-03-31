<?php

use App\Http\Controllers\PengumumanController;
use Illuminate\Http\Request;
use App\config\cors;

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
 
//perusahaan

Route::get('perusahaan', 'PerusahaanController@index');
Route::get('/perusahaan/{aktif}', 'PerusahaanController@show');
Route::get('/perusahaan/{id}', 'PerusahaanController@getId');
Route::post('perusahaan', 'PerusahaanController@create');
Route::put('/perusahaan/{id}', 'PerusahaanController@update');
Route::delete('/perusahaan/{id}', 'PerusahaanController@delete');


//transaksi

Route::post('transaksi', 'TransaksiController@create');
Route::get('/transaksi/{aktif}', 'TransaksiController@show');

Route::get('transaksi', 'JoinTableController@get_all');
Route::get('/index/{id}', 'JoinTableController@index');
Route::get('/get_perusahaan/{id}', 'JoinTableController@get_perusahaan');
Route::get('/get_pengumuman/{id}', 'JoinTableController@get_pengumuman');

Route::put('/put_status/{id_perusahaan}', 'JoinTableController@put_status');

Route::get('/index/export_excel/{id}', 'JoinTableController@export_excel');

Route::post('/upload/{id}', 'ImageController@upload');

//pengumuman

Route::post('pengumuman', 'PengumumanController@create');

//user

Route::put('/user/{id}', 'UserController@update');

Route::post('auth', 'UserController@signin');

