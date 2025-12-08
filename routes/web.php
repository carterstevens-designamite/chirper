<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisteredUserController;
use App\Models\Chirp;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (): void {
    Route::get('dashboard', [ChirpController::class, 'dashboard'])->name('dashboard');

    Route::get('edit', [RegisteredUserController::class, 'edit'])->name('edit');
    Route::patch('edit', [RegisteredUserController::class, 'update'])->name('update');
    Route::delete('destroy', [RegisteredUserController::class, 'destroy'])->name('destroy');

    Route::get('chirp-create', [ChirpController::class, 'create'])->name('chirp-create')->can('create', Chirp::class)->middleware('throttle:2,1');
    Route::post('chirp-create', [ChirpController::class, 'store'])->name('chirp-create')->can('store', Chirp::class)->middleware('throttle:2,1');

    Route::get('chirp/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirp.edit')->can('update', 'chirp');
    Route::patch('chirp/{chirp}/edit', [ChirpController::class, 'update'])->name('chirp.update')->can('update', 'chirp')->middleware('throttle:10,1');
    ;
    Route::delete('chirp/{chirp}/destroy', [ChirpController::class, 'destroy'])->name('chirp.destroy')->can('delete', 'chirp');
    ;

    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function (): void {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login')->middleware('throttle:5,1');
});
