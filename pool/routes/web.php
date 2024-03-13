<?php

use App\Http\Controllers\Logout;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\MesasAdmin;
use App\Livewire\Admin\RegistroVentasAdmin;
use App\Livewire\Admin\InventarioAdmin;
use App\Livewire\Admin\ClientesAdmin;
use App\Livewire\Admin\UsuariosAdmin;
use App\Livewire\Cajero\ClientesCajero;
use App\Livewire\Cajero\DashboardCajero;
use App\Livewire\Cajero\Factura;
use App\Livewire\Cajero\Resumen;
use App\Livewire\Cajero\MeserasCajero;
use App\Livewire\Cajero\MesasCajero;
use App\Livewire\Mesera\DashboardMesera;
use App\Livewire\Cajero\InventarioCajero;
use App\Livewire\Mesera\ClientesMesera;
use App\Livewire\Mesera\IndexMesera;
use App\Livewire\Mesera\MesasAsignadas;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


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
    Route::get('mesas_admin', MesasAdmin::class)->name('mesas_admin');


    Route::get('/dashboard_cajero', DashboardCajero::class)->name('dashboard_cajero');
    Route::get('/inventario_cajero', InventarioCajero::class)->name('inventario_cajero');
    Route::get('/clientes_cajero', ClientesCajero::class)->name('clientes_cajero');
    Route::get('/factura', Factura::class)->name('factura');
    Route::get('/resumen', Resumen::class)->name('resumen');
    Route::get('/meseras_cajero', MeserasCajero::class)->name('meseras_cajero');
    Route::get('/mesas_cajero', MesasCajero::class)->name('mesas_cajero');
    Route::get('/factura', Factura::class)->name('factura')->middleware('productos.seleccionados');


    Route::get('/dashboard_cajero', DashboardCajero::class)->name('dashboard_cajero');
    Route::get('/inventario_cajero', InventarioCajero::class)->name('inventario_cajero');
    Route::get('/clientes_cajero', ClientesCajero::class)->name('clientes_cajero');
    Route::get('/factura', Factura::class)->name('factura');


    Route::get('/dashboard_mesera', IndexMesera::class)->name('dashboard_mesera');
    Route::get('/mesas_mesera', MesasAsignadas::class)->name('mesas_mesera');
    Route::get('/clientes_mesera', ClientesMesera::class)->name('clientes_mesera');
});







require __DIR__.'/auth.php';
