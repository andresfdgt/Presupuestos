<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PresupuestoController;

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

// Route::get('/', function () {
//   return redirect()->away(env('MODULE_MASTER'));
// });

Route::get('/login', function () {
  return redirect()->away(env('MODULE_MASTER'));
})->name("login");

Route::get('/logout', [LoginController::class, 'logout'])->middleware(['auth'])->name('logout');


Route::group(['middleware' => ['auth', 'verified']], function () {
  Route::group(['middleware' => 'BaseDatosPrivada'], function () {
    Route::get("/", [PresupuestoController::class, 'index'])->name('presupuestos.lista');
    Route::get("/articulos", [PresupuestoController::class, 'articulos'])->name('presupuestos.articulos');
    Route::get("/crear", [PresupuestoController::class, 'crear'])->name('presupuestos.crear');
    Route::post("/store", [PresupuestoController::class, 'store'])->name('presupuestos.store');
    Route::get("/clientes/{id}", [PresupuestoController::class, 'clienteById'])->name('presupuestos.cliente_by_id');
    Route::get("/clientes", [PresupuestoController::class, 'clientes'])->name('presupuestos.clientes');
    Route::get("/versiones/{tipo}/{id}", [PresupuestoController::class, 'versiones'])->name('presupuestos.versiones_get');
    Route::post("/store/versiones", [PresupuestoController::class, 'storeVersion'])->name('presupuestos.store_version');
    Route::get("/buscar", [PresupuestoController::class, 'buscar'])->name('presupuestos.buscar');
  });
});
