<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\LoginController;

/*
|---------------------------------------------------------------------------
| RUTAS PÚBLICAS
|---------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::post('/guardar-contacto', [FirebaseController::class, 'storeContacto']);

Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil');

Route::get('/plan', function () {
    return view('plan');
})->name('ver-planes');

/*
|---------------------------------------------------------------------------
| LOGIN Y REGISTRO
|---------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/procesar-login', [LoginController::class, 'procesarLogin']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/guardar-usuario', [FirebaseController::class, 'store']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|---------------------------------------------------------------------------
| PANEL USUARIO
|---------------------------------------------------------------------------
*/

Route::view('/panel-usuario', 'panel_usuario')->name('panel.usuario');
Route::get('/plan/{edad}', function ($edad) {
    return view('plan', compact('edad'));
});
Route::get('/crear_contacto', function () {
    return view('crear_contacto'); // Asegúrate de que el archivo se llame crear-contacto.blade.php
});

/*
|---------------------------------------------------------------------------
| RUTAS PROTEGIDAS SOLO ADMIN
|---------------------------------------------------------------------------
*/

Route::middleware(['checkAdmin'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/ver-usuarios', [ViewController::class, 'verUsuarios'])->name('ver.usuarios');
    Route::get('/ver-servicios', [ViewController::class, 'verServicios'])->name('ver.servicios');
    Route::get('/ver-contactos', [ViewController::class, 'verContactos'])->name('ver.contactos');

    Route::get('/crear-servicio', [FirebaseController::class, 'crearServicio'])->name('crear.servicio');
    Route::get('/crear-contacto', [FirebaseController::class, 'crearContacto'])->name('crear.contacto');

    Route::post('/guardar-servicio', [FirebaseController::class, 'storeServicio'])->name('guardar.servicio');

    Route::get('/estado-contacto/{id}/{estado}', [ViewController::class, 'estadoContacto'])->name('estado.contacto');

    Route::delete('/eliminar-firebase/{coleccion}/{id}', [ViewController::class, 'eliminarDoc']);
    Route::get('/editar-firebase/{coleccion}/{id}', [ViewController::class, 'editarDoc']);
    Route::put('/actualizar-firebase/{coleccion}/{id}', [ViewController::class, 'actualizarDoc']);
});