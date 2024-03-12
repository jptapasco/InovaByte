<?php

use App\Http\Controllers\Logout;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\RegistroVentasAdmin;
use App\Livewire\Admin\InventarioAdmin;
use App\Livewire\Admin\ClientesAdmin;
use App\Livewire\Admin\UsuariosAdmin;
use App\Livewire\Cajero\ClientesCajero;
use App\Livewire\Cajero\DashboardCajero;
use App\Livewire\Mesera\DashboardMesera;
use App\Livewire\Cajero\Factura;
use App\Livewire\Cajero\InventarioCajero;

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function (){
    Route::get('home', [HomeController::class, 'index'])->name('home');

    //RUTAS MESERA:
    Route::get('/mesera', [UserController::class, 'mesera_index'])->name('mesera.index');
    Route::get('/mesera/mesas', [UserController::class, 'mesera_mesas'])->name('mesera.mesas');
    Route::get('/mesera/clientes', [UserController::class, 'mesera_clientes'])->name('mesera.clientes');
});

Route::get('dashboard_admin', DashboardAdmin::class)->name('dashboard_admin');
Route::get('registro_ventas_admin', RegistroVentasAdmin::class)->name('registro_ventas_admin');
Route::get('inventario_admin', InventarioAdmin::class)->name('inventario_admin');
Route::get('usuarios_admin', UsuariosAdmin::class)->name('usuarios_admin');
Route::get('clientes_admin', ClientesAdmin::class)->name('clientes_admin');


Route::get('/dashboard_cajero', DashboardCajero::class)->name('dashboard_cajero');
Route::get('/inventario_cajero', InventarioCajero::class)->name('inventario_cajero');
Route::get('/clientes_cajero', ClientesCajero::class)->name('clientes_cajero');
Route::get('/factura', Factura::class)->name('factura');





require __DIR__.'/auth.php';
