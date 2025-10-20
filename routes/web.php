<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

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



    Route::get('/', [UserController::class, 'show_auth_forms']);

    // Show forms to log in or sign up
    Route::get('/auth', [UserController::class, 'show_auth_forms'])->name('login');

    Route::get('/user/logout', [UserController::class, 'logout'])->middleware('auth');

    Route::post('/user/login', [UserController::class, 'login'])->name('user.login');

    Route::get('/user/{id}/change', [UserController::class, 'change_name'])->middleware('auth');

    Route::get('/user', [UserController::class, 'show_dashboard'])->middleware('auth');

    Route::post('/user', [UserController::class, 'store'])->name('user.create');

    Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('user.delete');



    // Show form to add task
    Route::get('/form/add', [TaskController::class, 'create'])->middleware('auth');

    // Show form to edit task
    Route::get('/form/edit/{id}', [TaskController::class, 'edit'])->middleware('auth');



    // Search tasks
    Route::get('/tasks/search', [TaskController::class, 'search'])->middleware('auth')->name('task.search');

    // Show all tasks
    Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth');

    // Push new task
    Route::post('/tasks', [TaskController::class, 'store'])->name('task.add')->middleware('auth');

    // Update task
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('task.edit')->middleware('auth');

    // Delete task
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('task.delete')->middleware('auth');



    // Edit category: show form
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->middleware('auth');

    // Show categories page
    Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth');

    // Create new category
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.add')->middleware('auth');

    // Edit category: submit edit
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.edit')->middleware('auth');

    // Delete category
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.delete')->middleware('auth');


    // Language change
    Route::get('/lang/{locale}', function ($locale) {
        session(['locale' => $locale]); 
        return redirect()->back(); 
    });


