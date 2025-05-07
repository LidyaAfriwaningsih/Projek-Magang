<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\IncomingLetterController;
use App\Http\Controllers\OutgoingLetterController;
use App\Http\Controllers\DispositionController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\LetterStatusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Registrasi — Hanya untuk Guest
Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'storeRegister'])->name('register.store');
});

// ✅ Semua route berikut hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth'])->group(function () {

    // ✅ Dashboard
    Route::get('/', [PageController::class, 'index'])->name('home');

    // ✅ Manajemen User — Hanya Admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class)->except(['show', 'edit', 'create']);

        // ✅ Pengaturan Aplikasiaa
        Route::get('settings', [PageController::class, 'settings'])->name('settings.show');
        Route::put('settings', [PageController::class, 'settingsUpdate'])->name('settings.update');

        // ✅ Referensi Surat
        Route::prefix('reference')->as('reference.')->group(function () {
            Route::resource('classification', ClassificationController::class)->except(['show', 'create', 'edit']);
            Route::resource('status', LetterStatusController::class)->except(['show', 'create', 'edit']);
        });

        // ✅ Pengajuan Surat — ADMIN Melihat & Memproses
        Route::prefix('admin')->as('admin.')->group(function () {
            // Magang
            Route::get('/magang', [PengajuanController::class, 'indexMagang'])->name('magang.index');
            Route::get('/magang/{id}', [PengajuanController::class, 'showMagang'])->name('magang.show');
            Route::post('/magang/{id}/proses', [PengajuanController::class, 'prosesMagang'])->name('magang.proses');
            Route::get('/magang/cetak/{id}', [PengajuanController::class, 'cetakMagang'])->name('pengajuan.magang.cetak');
            

            // Penelitian
            Route::get('/penelitian', [PengajuanController::class, 'indexPenelitian'])->name('penelitian.index');
            Route::get('/penelitian/{id}', [PengajuanController::class, 'showPenelitian'])->name('penelitian.show');
            Route::post('/penelitian/{id}/proses', [PengajuanController::class, 'prosesPenelitian'])->name('penelitian.proses');
            Route::get('/penelitian/cetak/{id}', [PengajuanController::class, 'cetakPenelitian'])->name('pengajuan.penelitian.cetak');
        });
    });

    // ✅ Pengajuan Surat — USER Mengajukan
    Route::middleware(['auth'])->prefix('pengajuan')->as('pengajuan.')->group(function () {
        // Rute untuk pengajuan magang
        Route::get('/magang', [PengajuanController::class, 'magang'])->name('magang');
        Route::post('/magang', [PengajuanController::class, 'storeMagang'])->name('storeMagang');
        
        // Rute untuk cetak pengajuan magang
        Route::get('/admin/pengajuan/magang/cetak/{id}', [PengajuanController::class, 'cetakMagang'])->name('admin.pengajuan.magang.cetak');
        
        // Rute untuk pengajuan penelitian
        Route::get('/penelitian', [PengajuanController::class, 'penelitian'])->name('penelitian');
        Route::post('/penelitian', [PengajuanController::class, 'storePenelitian'])->name('storePenelitian');
        
        // Rute untuk cetak pengajuan penelitian
        Route::get('/penelitian/{id}/cetak', [PengajuanController::class, 'cetakPenelitian'])->name('cetakPenelitian');
    });
    

    // ✅ Profil Pengguna
    Route::get('profile', [PageController::class, 'profile'])->name('profile.show');
    Route::put('profile', [PageController::class, 'profileUpdate'])->name('profile.update');
    Route::put('profile/deactivate', [PageController::class, 'deactivate'])
        ->name('profile.deactivate')
        ->middleware('role:user');

    // ✅ Hapus Lampiran
    Route::delete('attachment', [PageController::class, 'removeAttachment'])->name('attachment.destroy');

    // ✅ Manajemen Surat Masuk & Keluar
    Route::prefix('transaction')->as('transaction.')->group(function () {
        Route::resource('incoming', IncomingLetterController::class);
        Route::resource('outgoing', OutgoingLetterController::class);
        Route::resource('{letter}/disposition', DispositionController::class)->except(['show']);
    });

    // ✅ Agenda Surat
    Route::prefix('agenda')->as('agenda.')->group(function () {
        Route::get('incoming', [IncomingLetterController::class, 'agenda'])->name('incoming');
        Route::get('incoming/print', [IncomingLetterController::class, 'print'])->name('incoming.print');
        Route::get('outgoing', [OutgoingLetterController::class, 'agenda'])->name('outgoing');
        Route::get('outgoing/print', [OutgoingLetterController::class, 'print'])->name('outgoing.print');
    });

});
