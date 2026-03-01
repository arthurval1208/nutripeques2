<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\LoginController;

// RUTAS PÚBLICAS
Route::get('/', function () { return view('index'); })->name('inicio');
Route::get('/contacto', function () { return view('crear_contacto'); })->name('contacto');
Route::post('/guardar-contacto', [FirebaseController::class, 'storeContacto']);
Route::get('/plan/15-18', function () { 
    return view('plan', ['edad' => '15-18']); 
})->name('ver-planes');

// LOGIN Y REGISTRO
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/procesar-login', [LoginController::class, 'procesarLogin']);
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/guardar-usuario', [FirebaseController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// PANEL Y PERFIL (Controlados por FirebaseController)
Route::get('/panel-usuario', function() { return view('panel_usuario'); })->name('panel.usuario');
Route::get('/perfil', [FirebaseController::class, 'showProfile'])->name('perfil');
Route::post('/perfil/actualizar', [FirebaseController::class, 'updateProfile'])->name('update.profile');

Route::get('/actividades', function () { return view('actividades'); })->name('actividades');

// ADMIN
Route::middleware(['checkAdmin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/ver-usuarios', [ViewController::class, 'verUsuarios'])->name('ver.usuarios');
    Route::get('/ver-servicios', [ViewController::class, 'verServicios'])->name('ver.servicios');
    Route::get('/ver-contactos', [ViewController::class, 'verContactos'])->name('ver.contactos');
    Route::get('/crear-servicio', [FirebaseController::class, 'crearServicio'])->name('crear.servicio');
    Route::post('/guardar-servicio', [FirebaseController::class, 'storeServicio'])->name('guardar.servicio');
});