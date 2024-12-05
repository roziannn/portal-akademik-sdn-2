<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/data-user', [UserController::class, 'index'])->name('data.user');
    Route::post('/data-user/store', [UserController::class, 'store'])->name('data.user.store');
    Route::post('/data-user/update/{id}', [UserController::class, 'update'])->name('data.user.update');
    Route::post('/data-user/edit', [UserController::class, 'edit'])->name('data.user.edit');
    Route::delete('/data-user/delete/{id}', [UserController::class, 'destroy'])->name('data.user.delete');

    Route::get('/data-guru', [GuruController::class, 'index'])->name('data.guru');
    Route::get('/data-guru/create', [GuruController::class, 'create'])->name('data.guru.create');
    Route::post('/data-guru/store', [GuruController::class, 'store'])->name('data.guru.store');
    Route::get('/data-guru/edit/{id}', [GuruController::class, 'edit'])->name('data.guru.edit');
    Route::post('/data-guru/update/{id}', [GuruController::class, 'update'])->name('data.guru.update');

    // ini seharusnya role kurikulum.
    Route::get('/data-kurikulum', [KurikulumController::class, 'index'])->name('data.kurikulum');

    Route::get('/data-mata-pelajaran', [MataPelajaranController::class, 'index'])->name('data.mataPelajaran');
    Route::post('/data-mata-pelajaran/store', [MataPelajaranController::class, 'store'])->name('data.mataPelajaran.store');
    Route::post('/data-mata-pelajaran/update/{id}', [MataPelajaranController::class, 'update'])->name('data.mataPelajaran.update');
    Route::delete('/data-mata-pelajaran/delete/{id}', [MataPelajaranController::class, 'destroy'])->name('data.mataPelajaran.delete');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
