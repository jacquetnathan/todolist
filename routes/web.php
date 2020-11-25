<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/', [TasksController::class, 'index'])->name('dashboard');

    Route::get('/create', [TasksController::class, 'create']);
    Route::post('/', [TasksController::class, 'store'])->name('store');

    Route::get('/task/{task}', [TasksController::class, 'edit'])->name('edit');
    Route::post('/task/{task}', [TasksController::class, 'update'])->name('update');


});