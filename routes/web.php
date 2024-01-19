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
Route::get('clientes/pagination/fetch_data', [App\Http\Controllers\ClientesController::class, 'fetch_data']);
Route::get('regiones', [App\Http\Controllers\ClientesController::class,'getRegion'])->middleware('auth');
Route::get('clientes/edit/{id}', [App\Http\Controllers\ClientesController::class, 'edit']);
Route::put('clientes/{id}', [App\Http\Controllers\ClientesController::class, 'update']);
Route::delete('clientes/{id}', [App\Http\Controllers\ClientesController::class, 'destroy']);
Route::get('clientes/f29/{id}', [App\Http\Controllers\ClientesController::class, 'F29'])->name('f29');
Route::get('get/clientes', [App\Http\Controllers\ClientesController::class, 'getClientes'])->name('clientes.get')->middleware('auth');
Route::post('clientes/factura/{id}', [App\Http\Controllers\ClientesController::class, 'GenerarFactura'])->name('factura.sii');
Route::post('clientes/cobranza/{id}', [App\Http\Controllers\ClientesController::class, 'GenerarCobranza'])->name('factura.cobranza');
#Libro de Bancos
Route::resource('LibroBancos', App\Http\Controllers\LibroBancoController::class);
Route::get('listado-libro-bancos', [App\Http\Controllers\LibroBancoController::class, 'ListadoGet'])->name('list.data.lb');

#Forma de Pago
Route::resource('forma-pago', App\Http\Controllers\FormaPagoController::class);
#empresa
Route::resource('empresa', App\Http\Controllers\EmpresaController::class);
#factura
Route::resource('factura', App\Http\Controllers\FacturaController::class);
Route::get('factura/pagination/fetch_data', [App\Http\Controllers\FacturaController::class, 'fetch_data']);
#cobranza
Route::resource('cobranzas', App\Http\Controllers\CobranzaController::class);
Route::get('cobranza/pagination/fetch_data', [App\Http\Controllers\CobranzaController::class, 'fetch_data']);