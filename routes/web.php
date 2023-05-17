<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Todo List Routes 
    Route::get('/todo', [TodosController::class, 'index'])->name('todo');
    Route::post('/todo',[TodosController::class, 'store'])->name('todo.store');
    Route::get('/todo/{id}', [TodosController::class, 'edit'])->name('todo.edit');
    Route::put('/todo/{id}', [TodosController::class, 'update'])->name('todo.update');
    Route::get('/delete', [TodosController::class, 'getModal'])->name('todo.delete.modal');
    Route::delete('/todo/{id}',[TodosController::class, 'destroy'])->name('todo.destroy');

    // Task Routes 
    Route::get('/task/{id}', [TasksController::class, 'index'])->name('task');
    Route::post('/task',[TasksController::class, 'store'])->name('task.store');
    Route::get('/edit/{id}', [TasksController::class, 'edit'])->name('task.edit');
    Route::put('/task/{id}', [TasksController::class, 'update'])->name('task.update');
    Route::put('/status/{id}',[TasksController::class, 'status'])->name('task.status');
    Route::get('/modal', [TasksController::class, 'getModal'])->name('task.delete.modal');
    Route::delete('/task/{id}',[TasksController::class, 'destroy'])->name('task.destroy');
});

require __DIR__.'/auth.php';
