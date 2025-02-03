<?php

use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/certificate', [CertificateController::class, 'index'])->name('certificates.index');
});

Route::get('/certificates/verify/{code}', [CertificateController::class, 'verify'])->name('certificates.verify');


Route::middleware(['auth:sanctum', \App\Http\Middleware\RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/certificates/create', [CertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates/store', [CertificateController::class, 'generate'])->name('certificates.store');
});



