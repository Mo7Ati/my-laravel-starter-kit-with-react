<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

$settingsRoutes = require base_path('routes/settings.php');

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');


Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin', function () {
        return Inertia::render('admin/dashboard');
    })->name('admin.dashboard');
});

// Admin routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:admin'])
    ->group($settingsRoutes);


// Store routes
Route::prefix('store')
    ->name('store.')
    ->middleware(['auth:store'])
    ->group($settingsRoutes);


Route::middleware(['auth:store'])->group(function () {
    Route::get('store', function () {
        return Inertia::render('store/dashboard');
    })->name('store.dashboard');
});

require __DIR__ . '/settings.php';
