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


Route::get('admin', function(){

	return view('admin.dashboard');
});