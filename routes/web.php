<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'show_auth_forms']);

// Show forms to log in or sign up
Route::get('/auth', [PageController::class, 'show_auth_forms']);



// Show form to add task
Route::get('/form/add', [TaskController::class, 'create']);

// Show form to edit task
Route::get('/form/edit/{id}', [TaskController::class, 'edit']);



// Show all tasks
Route::get('/tasks', [TaskController::class, 'index']);

// Push new task
Route::post('/tasks', [TaskController::class, 'store'])->name('task.add');

// Update task
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('task.edit');

// Delete task
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('task.delete');



// Edit category
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit']);

// Show categories page
Route::get('/categories', [CategoryController::class, 'index']);

// Create new category
Route::post('/categories', [CategoryController::class, 'store'])->name('category.add');
