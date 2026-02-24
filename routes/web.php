<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmisController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirebaseController;

// Rutas Públicas
Route::get('/', function() { return view('index'); })->name('inicio');
Route::get('/Contacto', function() { return view('contacto'); })->name('contacto');
Route::post('guardar-contacto', [AdmisController::class, 'guardarContacto']);

// Auth
Route::get('/login', function() { return view('auth.login'); })->name('login');
Route::post('/login', [AdmisController::class, 'procesarLogin']);
Route::get('/register', function() { return view('auth.register'); })->name('register');
Route::post('/register', [AdmisController::class, 'procesarRegistro']);
Route::post('/logout', [AdmisController::class, 'logout'])->name('logout');

// Protegidas
Route::middleware(['checkAdmin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/ver-usuarios', [ViewController::class, 'verUsuarios'])->name('ver.usuarios');
    Route::get('/ver-servicios', [ViewController::class, 'verServicios'])->name('ver.servicios');
    Route::get('/ver-contactos', [ViewController::class, 'verContactos'])->name('ver.contactos');
    
    Route::get('/crear-usuario', [FirebaseController::class, 'crear'])->name('crear.usuario');
    Route::get('/crear-servicio', [FirebaseController::class, 'crearServicio'])->name('crear.servicio');
    Route::get('/crear-contacto', [FirebaseController::class, 'crearContacto'])->name('crear.contacto');
    Route::post('/guardar-usuario', [FirebaseController::class, 'store'])->name('guardar.usuario');
    Route::post('/guardar-servicio', [FirebaseController::class, 'storeServicio'])->name('guardar.Servicio');
    Route::post('/guardar-contacto', [FirebaseController::class, 'storeContacto'])->name('guardar.contacto');
    Route::get('/estado-contacto/{id}/{estado}', [ViewController::class, 'estadoContacto'])->name('estado.contacto');


    // Rutas de eliminar/editar (ViewController)
    Route::delete('/eliminar-firebase/{coleccion}/{id}', [ViewController::class, 'eliminarDoc']);
    Route::get('/editar-firebase/{coleccion}/{id}', [ViewController::class, 'editarDoc']);
    Route::put('/actualizar-firebase/{coleccion}/{id}', [ViewController::class, 'actualizarDoc']);
});
