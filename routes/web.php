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
|
| Semua route web aplikasi diatur di sini.
| Route yang butuh login diletakkan dalam middleware ['auth','verified'].
|
*/

// Redirect dari root ke login
Route::redirect('/', '/login');

// Routes Auth (Laravel Breeze)
require __DIR__.'/auth.php';

// Semua route yang membutuhkan login & email verified
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | TASKS CRUD
    |--------------------------------------------------------------------------
    */
    Route::resource('tasks', TaskController::class);


    /*
    |--------------------------------------------------------------------------
    | CATEGORIES CRUD
    |--------------------------------------------------------------------------
    */
    Route::resource('categories', CategoryController::class);


    /*
    |--------------------------------------------------------------------------
    | INVENTORY CRUD
    |--------------------------------------------------------------------------
    */
    Route::resource('inventories', InventoryController::class);


    /*
    |--------------------------------------------------------------------------
    | EXPENSE TRACKER CRUD (Hanya index, store, destroy)
    |--------------------------------------------------------------------------
    */
    Route::resource('expenses', ExpenseController::class)
        ->only(['index', 'store', 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | PROFILE SETTINGS
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
