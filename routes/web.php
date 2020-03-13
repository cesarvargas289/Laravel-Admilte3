<?php
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
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

//Rutas de login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Rutas de Errors
Route::get('401',['as'=>'401','uses'=>'ErrorHandlerController@errorCode401']);
Route::get('404',['as'=>'404','uses'=>'ErrorHandlerController@errorCode404']);
Route::get('405',['as'=>'405','uses'=>'ErrorHandlerController@errorCode405']);


Route::get('/', 'HomeController@index');
Auth::routes();


Route::resource('tipousuario', 'TipoUsuarioController');
Route::resource('user', 'UserController');
Route::resource('acceso', 'AccesoController');
Route::resource('rol', 'RoleController');

//Route::resource('cece', 'CeceController');


Route::get('cece',  ['as' => 'cece.index', 'uses' =>'CeceController@index']);
Route::post('cece/', ['as' => 'cece.post', 'uses' => 'CeceController@indexPost']);

Route::get('seg',  ['as' => 'seg.index', 'uses' =>'ImportExcelSEGController@index']);
Route::post('seg/', ['as' => 'seg.post', 'uses' => 'ImportExcelSEGController@import']);

Route::get('reporte_seg',  ['as' => 'reporte_seg.index', 'uses' =>'ReporteSegController@index']);
Route::post('reporte_seg/', ['as' => 'reporte_seg.post', 'uses' => 'ReporteSegController@indexPost']);

Route::get('acumulado',  ['as' => 'acumulado.index', 'uses' =>'ImportExcelAcumuladoController@index']);
Route::post('acumulado/', ['as' => 'acumulado.post', 'uses' => 'ImportExcelAcumuladoController@import']);

Route::get('reporte_acumulado',  ['as' => 'reporte_acumulado.index', 'uses' =>'ReporteAcumuladoController@index']);
Route::post('reporte_acumulado/', ['as' => 'reporte_acumulado.post', 'uses' => 'ReporteAcumuladoController@indexPost']);

Route::get('objetado',  ['as' => 'objetado.index', 'uses' =>'ImportExcelObjetadoController@index']);
Route::post('objetado/', ['as' => 'objetado.post', 'uses' => 'ImportExcelObjetadoController@import']);



Route::get('admin', function(){

	return view('admin.dashboard');
});