<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\PanitiaController;
use App\Http\Controllers\Keuangan\DashboardKeuanganController;
use App\Http\Controllers\Panitia\DashboardPanitiaController;
use App\Http\Controllers\Panitia\EventController;
use App\Http\Controllers\Panitia\EventMemberController;
use App\Http\Controllers\Pembayaran\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\HistoryController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KeuanganMiddleware;
use App\Http\Middleware\PanitiaMiddleware;
use App\Http\Middleware\CheckFrontendMember;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin routes
Route::prefix('admin')->middleware(['auth', 'verified', AdminMiddleware::class])->name('admin.')->group(function () {
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
        Route::put('/{id}/toggle-status', [KeuanganController::class, 'toggleStatus'])->name('toggleStatus');

    });

    // CRUD Panitia Event
    Route::prefix('TPanitia')->name('panitias.')->group(function () {
        Route::get('/dashboard', [PanitiaController::class, 'dashboard'])->name('dashboard');
        Route::get('/create', [PanitiaController::class, 'create'])->name('create');
        Route::post('/', [PanitiaController::class, 'store'])->name('store');
        Route::get('/{panitias}/edit', [PanitiaController::class, 'edit'])->name('edit');
        Route::put('/{panitias}', [PanitiaController::class, 'update'])->name('update');
        Route::delete('/{panitias}', [PanitiaController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/toggle-status', [PanitiaController::class, 'toggleStatus'])->name('toggleStatus');
    });
});

// Login sebagai Tim Keuangan
Route::prefix('keuangan')->middleware(['auth', 'verified', KeuanganMiddleware::class])->name('keuangan.')->group(function () {
    Route::get('/dashboard', [DashboardKeuanganController::class, 'index'])->name('dashboard');
    Route::post('/update-status-pembayaran', [DashboardKeuanganController::class, 'updateStatusPembayaran'])->name('update.status.pembayaran');


});

// Login sebagai Panitia Event
Route::prefix('panitia')->middleware(['auth', 'verified', PanitiaMiddleware::class])->name('panitia.')->group(function () {
    Route::get('/dashboard', [DashboardPanitiaController::class, 'index'])->name('dashboard');
    // Route event
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    // Route event member
    Route::get('/event-member', [EventMemberController::class, 'index'])->name('events.event_member');
    Route::get('/event-member/scan', [EventMemberController::class, 'scan'])->name('events.scan_qr');
    Route::post('/event-member/absen', [EventMemberController::class, 'absenMember'])->name('events.absen_qr');
    Route::get('/event-member/{id}/list', [EventMemberController::class, 'listMember']);
    Route::post('/event-member/upload-sertifikat/{id}', [EventMemberController::class, 'uploadSertifikat']);

});

// Public Frontend Routes — khusus Member + Guest (user biasa)
Route::middleware([CheckFrontendMember::class])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::post('/get-snap-token', [PaymentController::class, 'processPayment'])->middleware('auth')->name('get-snap-token');

    Route::post('/update-status/{id}', [EventRegistrationController::class, 'updateStatus'])->name('update.status');
    Route::post('/register-event', [EventRegistrationController::class, 'daftarEvent'])->middleware('auth');
    Route::get('/history-notif-count', [HistoryController::class, 'getNotifCount']);
    Route::get('/history', [EventRegistrationController::class, 'history'])->name('history')->middleware('auth');


    Route::get('/schedule', function () {
        return view('schedule');
    })->name('schedule');

    

    Route::get('/', function () {
        return redirect('/home');
    });
});

// Force logout route
Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});


require __DIR__.'/auth.php';
