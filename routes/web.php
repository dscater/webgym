<?php

use App\Http\Controllers\AccesoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CobroController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EvaluacionFisicaController;
use App\Http\Controllers\IngresoProductoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MantenimientoMaquinaController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
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

// LOGIN
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


// CONFIGURACIÓN
Route::get('/configuracion/getConfiguracion', [ConfiguracionController::class, 'getConfiguracion']);
Route::post('/configuracion/update', [ConfiguracionController::class, 'update']);

Route::prefix('admin')->group(function () {
    // USUARIOS
    Route::get('usuarios/getUsuario/{usuario}', [UserController::class, 'getUsuario']);
    Route::get('usuarios/userActual', [UserController::class, 'userActual']);
    Route::get('usuarios/getInfoBox', [UserController::class, 'getInfoBox']);
    Route::get('usuarios/getPermisos/{usuario}', [UserController::class, 'getPermisos']);
    Route::get('usuarios/getEncargadosRepresentantes', [UserController::class, 'getEncargadosRepresentantes']);
    Route::post('usuarios/actualizaContrasenia/{usuario}', [UserController::class, 'actualizaContrasenia']);
    Route::post('usuarios/actualizaFoto/{usuario}', [UserController::class, 'actualizaFoto']);
    Route::resource('usuarios', UserController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // SUCURSALES
    Route::resource('sucursals', SucursalController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // PLANES
    Route::resource('plans', PlanController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // CLIENTES
    Route::resource('clientes', ClienteController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // EMPLEADOS
    Route::resource('empleados', EmpleadoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // CATEGORIAS
    Route::resource('categorias', CategoriaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // MAQUINAS
    Route::resource('maquinas', MaquinaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // MANTENIMIENTO MAQUINAS
    Route::resource('mantenimiento_maquinas', MantenimientoMaquinaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // INSCRIPCIONES
    Route::resource('inscripcions', InscripcionController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // ACCESOS
    Route::resource('accesos', AccesoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // COBROS
    Route::resource('cobros', CobroController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // EVALUACION FISICA
    Route::resource('evaluacion_fisicas', EvaluacionFisicaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // PRODUCTOS
    Route::resource('productos', ProductoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // INGRESO PRODUCTOS
    Route::resource('ingreso_productos', IngresoProductoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // VENTAS
    Route::resource('ventas', VentaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // REPORTES
    Route::post('reportes/usuarios', [ReporteController::class, 'usuarios']);
});

// ---------------------------------------
Route::get('/{optional?}', function () {
    return view('app');
})->name('base_path')->where('optional', '.*');
