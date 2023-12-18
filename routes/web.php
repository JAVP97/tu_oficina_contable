<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio')->middleware('auth');
//USUARIOS
Route::resource('users', App\Http\Controllers\UsersController::class)->middleware('auth');
Route::resource('roles', App\Http\Controllers\RolesController::class)->middleware('auth');
Route::get('validar-rut-user',  [App\Http\Controllers\UsersController::class, 'ValidarRutUser'])->name('get.validar.rut.user')->middleware('auth');
Route::middleware('role:Admin')->put('users/{user}/roles', [App\Http\Controllers\UsersRolesController::class, 'update'])->name('users.roles.update')->middleware('auth');
Route::middleware('role:Admin')->put('users/{user}/permissions', [App\Http\Controllers\UsersPermissionsController::class, 'update'])->name('users.permissions.update')->middleware('auth');

#Clientes
Route::resource('clientes', App\Http\Controllers\ClientesController::class);
Route::get('/crear_cliente', [App\Http\Controllers\ClientesController::class, 'create']);
Route::get('/listado_clientes', [App\Http\Controllers\ClientesController::class, 'listadoClientes']);