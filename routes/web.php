<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HijoController;

/*
|--------------------------------------------------------------------------
| 1. RUTAS PÚBLICAS Y AUTENTICACIÓN
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('index'); })->name('inicio');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/procesar-login', [LoginController::class, 'procesarLogin']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/guardar-usuario', [LoginController::class, 'procesarRegistro'])->name('guardar.admin');

/*
|--------------------------------------------------------------------------
| 2. RUTAS DE PERFIL Y EDICIÓN (GENERALES)
|--------------------------------------------------------------------------
*/
Route::get('/perfil', function () { return view('perfil'); })->name('perfil');
Route::get('/inicio', function () { return view('inicio'); })->name('inicioo');
// agregar hijo
Route::get('/agregar_hijo', function () {
    return view('agregar_hijo');
})->name('agregar_hijo');
//hijos registrados
Route::get('/hijos-registrados', [ViewController::class, 'verHijosRegistrados'])->name('hijos.registrados');

Route::post('/agregar_hijo', [HijoController::class, 'store'])->name('agregar_hijo');
// Esta es la ruta para abrir el formulario (Asegúrate que el nombre sea igual en el controlador)
Route::get('/editar-perfil/{id}', [ViewController::class, 'editarDocPerfil'])->name('perfil.editar');

// Esta es la ruta que recibe los datos para GUARDAR
Route::put('/actualizar-firebase/{coleccion}/{id}', [ViewController::class, 'actualizarDoc'])->name('actualizar.doc');

Route::get('/panel-usuario', function () { return view('panel_usuario'); })->name('panel.usuario');
Route::get('/panel-nutriologo', function () { return view('panel_nutriologo'); })->name('panel.nutriologo');

// Pestañas Nutriólogo
Route::get('/nutri/pacientes', function () { return view('nutri.pacientes'); })->name('nutri.pacientes');
Route::get('/nutri/plan-alimenticio', function () { return view('nutri.plan_alimenticio'); })->name('nutri.plan');
Route::get('/nutri/progreso', function () { return view('nutri.progreso'); })->name('nutri.progreso');
Route::get('/nutri/mensajes', function () { return view('nutri.mensajes'); })->name('nutri.mensajes');

/*
|--------------------------------------------------------------------------
| 3. RUTAS PROTEGIDAS (SOLO ADMINISTRADORES)
|--------------------------------------------------------------------------
*/
Route::middleware(['checkAdmin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/registro-nutriologo', function () { return view('auth.register_nutriologo'); })->name('admin.register_nutri');
    Route::post('/guardar-nutriologo', [LoginController::class, 'guardarNutriologo'])->name('guardar.nutriologo');
    Route::get('/registro-admin', function () { return view('auth.register_admin'); })->name('admin.register');
    Route::get('/crear-usuario', function () { return view('auth.register'); })->name('usuario.crear');
    
    Route::get('/ver-usuarios', [ViewController::class, 'verUsuarios'])->name('ver.usuarios');
    Route::get('/ver-contactos', [ViewController::class, 'verContactos'])->name('ver.contactos');
    Route::get('/ver-servicios', [ViewController::class, 'verServicios'])->name('ver.servicios');
    Route::get('/estado-contacto/{id}/{estado}', [ViewController::class, 'estadoContacto'])->name('estado.contacto');

    Route::delete('/eliminar-firebase/{coleccion}/{id}', [ViewController::class, 'eliminarDoc']);
    Route::get('/editar-firebase/{coleccion}/{id}', [ViewController::class, 'editarDoc']);
    Route::get('/ver-ninos', [ViewController::class, 'verTodosLosNinos'])->name('ver.ninos');
    Route::get('/asignar-plan-nino/{id}', [ViewController::class, 'pantallaAsignarPlan'])->name('nino.asignar_plan');
Route::post('/guardar-plan-nino/{id}', [ViewController::class, 'guardarPlanNino'])->name('nino.guardar_plan');

});

/*
|--------------------------------------------------------------------------
| 4. OTRAS RUTAS
|--------------------------------------------------------------------------
*/
Route::get('/crear_contacto', function () { return view('crear_contacto'); })->name('crear_contacto');
Route::post('/guardar-contacto', [FirebaseController::class, 'storeContacto'])->name('guardar.contacto');
Route::get('/plan/{edad}', function ($edad) { return view('plan', compact('edad')); });
Route::get('/actividades', function () { return view('actividades'); })->name('actividades');