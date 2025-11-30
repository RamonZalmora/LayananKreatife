<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ExpenseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke halaman login
Route::redirect('/', '/login');

// Routes autentikasi Breeze
require __DIR__.'/auth.php';

// Semua route yang hanya bisa diakses jika user login & verified
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Tasks CRUD
    Route::resource('tasks', TaskController::class);

    // Categories CRUD
    Route::resource('categories', CategoryController::class);

    // Inventory CRUD
    Route::resource('inventories', InventoryController::class);

    // Expense CRUD (INI YANG BELUM ADA → PENYEBAB ERROR)
    Route::resource('expenses', ExpenseController::class);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
