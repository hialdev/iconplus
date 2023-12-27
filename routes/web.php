<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\OldAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

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


Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/home', [PageController::class, 'landing']);
Route::get('/login', [OldAuthController::class, 'showLoginForm']);
Fortify::loginView(function () {
    return view('auth.login');
});

Fortify::registerView(function () {
    return view('auth.register');
});

Route::get('/cek-ketersediaan', [PageController::class, 'checkAvailable'])->name('check');
Route::get('/cek-ketersediaan/q', [PageController::class, 'getAvailable'])->name('check.available');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/setting-admin', [DashboardController::class, 'settingAdmin'])->name('dashboard.setting-admin');
    Route::post('/dashboard/setting-admin', [DashboardController::class, 'updateAdminRole'])->name('dashboard.update-admin-role');
    Route::get('/order', [OrderController::class, 'order'])->name('order');
    Route::post('/order', [OrderController::class, 'orderSend'])->name('order.send');
    
    Route::get('/json/rooms', [JsonController::class, 'rooms']);
    Route::get('/json/rooms/unit/{id_unit}', [JsonController::class, 'roomByUnit']);
    Route::get('/json/rooms/{id_room}', [JsonController::class, 'roomFind']);
    Route::get('/json/rooms/{id_room}/check', [JsonController::class, 'checkBooked']);
    Route::get('/json/units', [JsonController::class, 'units']);
    
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store');
    Route::get('/units/{unit}', [UnitController::class, 'show'])->name('units.show');
    Route::get('/units/{unit}/edit', [UnitController::class, 'edit'])->name('units.edit');
    Route::put('/units/{unit}', [UnitController::class, 'update'])->name('units.update');
    Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');

    Route::resource('rooms', RoomController::class);
});

