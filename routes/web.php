<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\PanitiaController;
use App\Http\Controllers\Keuangan\DashboardKeuanganController;
use App\Http\Controllers\Panitia\DashboardPanitiaController;
use App\Http\Controllers\Panitia\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KeuanganMiddleware;
use App\Http\Middleware\PanitiaMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'verified', AdminMiddleware::class])->name('admin.')->group(function () {
    // Dashboard Role
    Route::get('/dashboard', [RoleController::class, 'dashboard'])->name('roles.dashboard');

    // CRUD Role
    Route::get('/roles', [RoleController::class, 'dashboard'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // CRUD Tim Keuangan
    Route::prefix('TKeuangan')->name('keuangans.')->group(function () {
        Route::get('/dashboard', [KeuanganController::class, 'dashboard'])->name('dashboard');
        Route::get('/create', [KeuanganController::class, 'create'])->name('create');
        Route::post('/', [KeuanganController::class, 'store'])->name('store');
        Route::get('/{keuangans}/edit', [KeuanganController::class, 'edit'])->name('edit');
        Route::put('/{keuangans}', [KeuanganController::class, 'update'])->name('update');
        Route::delete('/{keuangans}', [KeuanganController::class, 'destroy'])->name('destroy');
    });
     //CRUD Panitia Event
    Route::prefix('TPanitia')->name('panitias.')->group(function () {
        Route::get('/dashboard', [PanitiaController::class, 'dashboard'])->name('dashboard');
        Route::get('/create', [PanitiaController::class, 'create'])->name('create');
        Route::post('/', [PanitiaController::class, 'store'])->name('store');
        Route::get('/{panitias}/edit', [PanitiaController::class, 'edit'])->name('edit');
        Route::put('/{panitias}', [PanitiaController::class, 'update'])->name('update');
        Route::delete('/{panitias}', [PanitiaController::class, 'destroy'])->name('destroy');
    });
    
});

//Login sebagai Tim Keuangan
Route::prefix('keuangan')->middleware(['auth', 'verified', KeuanganMiddleware::class])->name('keuangan.')->group(function () {
    Route::get('/dashboard', [DashboardKeuanganController::class, 'index'])->name('dashboard');
});

//Login sebagai Panitia Event
Route::prefix('panitia')->middleware(['auth', 'verified', PanitiaMiddleware::class])->name('panitia.')->group(function () {
    Route::get('/dashboard', [DashboardPanitiaController::class, 'index'])->name('dashboard');
    
    // Route event
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
});






// Login sebagai Member
Route::get('/home', [HomeController::class, 'index'])->name('index');





Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});



Route::get('/', function () {
    return redirect('/home');
});



require __DIR__.'/auth.php';
