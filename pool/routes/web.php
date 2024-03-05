<?php

use App\Http\Controllers\Logout;
use App\Http\Controllers\HomeController;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\RegistroVentasAdmin;
use App\Livewire\Admin\InventarioAdmin;
use App\Livewire\Admin\ClientesAdmin;
use App\Livewire\Admin\UsuariosAdmin;
use App\Livewire\Cajero\ClientesCajero;
use App\Livewire\Cajero\DashboardCajero;
use App\Livewire\Cajero\InventarioCajero;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function (){
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('dashboard_admin', DashboardAdmin::class)->name('dashboard_admin');
    Route::get('registro_ventas_admin', RegistroVentasAdmin::class)->name('registro_ventas_admin');
    Route::get('inventario_admin', InventarioAdmin::class)->name('inventario_admin');
    Route::get('usuarios_admin', UsuariosAdmin::class)->name('usuarios_admin');
    Route::get('clientes_admin', ClientesAdmin::class)->name('clientes_admin');
});

Route::middleware('auth')->group(function (){
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('dashboard_cajero', DashboardCajero::class)->name('dashboard_cajero');
    Route::get('inventario_cajero', InventarioCajero::class)->name('inventario_cajero');
    Route::get('clientes_cajero', ClientesCajero::class)->name('clientes_cajero');
});


require __DIR__.'/auth.php';