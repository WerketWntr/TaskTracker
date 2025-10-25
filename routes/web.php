<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// CATEGORY
Route::middleware(['auth'])->group(function () {
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])
        ->name('categories.index');
    Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])
        ->name('categories.create');
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])
        ->name('categories.store');
    Route::get('/categories/{category}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])
        ->name('categories.edit');
    Route::put('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])
        ->name('categories.update');
    Route::delete('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])
        ->name('categories.destroy');


//TASKS

    Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index'])
        ->name('tasks.index');
    Route::get('/tasks/create', [\App\Http\Controllers\TaskController::class, 'create'])
        ->name('tasks.create');
    Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'store'])
        ->name('tasks.store');
    Route::get('/tasks/{task}/edit', [\App\Http\Controllers\TaskController::class, 'edit'])
        ->name('tasks.edit');
    Route::put('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'update'])
        ->name('tasks.update');
    Route::delete('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])
        ->name('tasks.destroy');
});
