<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Middleware\AdminMiddleware;
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
    
});


Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});


Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('index');
});







require __DIR__.'/auth.php';
