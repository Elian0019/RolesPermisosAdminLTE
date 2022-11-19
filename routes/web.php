<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/perfil', [App\Http\Controllers\HomeController::class, 'perfil'])->name('perfil');

Route::controller(UsuarioController::class)->group(function (){
    Route::get('usuario','index')->name('usuario.index');
    Route::post('usuario/update_perfil','update_perfil')->name('usuario.update_perfil');
    Route::post('usuario/update_password','update_password')->name('usuario.update_password');
    Route::get('usuario/DatosServerSideActivo','DatosServerSideActivo')->name('usuario.DatosServerSideActivo'); //activos
    Route::get('usuario/DatosServerSideInactivo','DatosServerSideInactivo')->name('usuario.DatosServerSideInactivo'); //eliminados
    Route::get('usuario/perfil','perfil')->name('usuario.perfil');
   // Route::get('usuario/create','create')->name('usuario.create');
    Route::post('usuario/store','store')->name('usuario.store');
   // Route::get('usuario/edit/{id}','edit')->name('usuario.edit');
    Route::post('usuario/update/{id}','update')->name('usuario.update');
    Route::get('usuario/destroy/{id}','destroy')->name('usuario.destroy');
   // Route::get('usuario/eliminados','deletes')->name('usuario.deletes');
    Route::get('usuario/restore/{id}','restore')->name('usuario.restore');
    Route::get('usuario/buscar/{id}','buscarPoUsuario')->name('usuario.buscar');
});

Route::controller(RoleController::class)->group(function (){
    Route::get('rol','index')->name('rol.index');
    Route::get('rol/DatosServerSideActivo','DatosServerSideActivo')->name('rol.DatosServerSideActivo'); //activos
    Route::get('rol/DatosServerSideInactivo','DatosServerSideInactivo')->name('rol.DatosServerSideInactivo'); //eliminados
   // Route::get('rol/create','create')->name('rol.create');
    Route::post('rol/store','store')->name('rol.store');
   // Route::get('rol/edit/{id}','edit')->name('rol.edit');
    Route::post('rol/update/{id}','update')->name('rol.update');
    Route::get('rol/destroy/{id}','destroy')->name('rol.destroy');
  //  Route::get('rol/eliminados','deletes')->name('rol.deletes');
    Route::get('rol/restore/{id}','restore')->name('rol.restore');
    Route::get('rol/buscar/{id}','buscarPorRol')->name('rol.buscar');
    Route::get('rol/permisos/{id}','permiso_rol')->name('rol.permisos');
    Route::post('rol/update_permiso/{id}','update_permisos')->name('rol.update_permiso');
});



// ejemplos admin lte

Route::get(
    'notifications/get',
    [App\Http\Controllers\NotificationsController::class, 'getNotificationsData']
)->name('notifications.get');

Route::match(
    ['get', 'post'],
    '/navbar/search',
    'SearchController@showNavbarSearchResults'
);

