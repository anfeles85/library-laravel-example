<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\EditorialController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('editorial')->group(function(){
    Route::get('/index', [EditorialController::class, 'index'])->name('editorial.index');   
    Route::get('/create', [EditorialController::class, 'create'])->name('editorial.create');
    Route::get('/edit/{id}', [EditorialController::class, 'edit'])->name('editorial.edit'); 
    Route::post('/create', [EditorialController::class, 'store'])->name('editorial.store'); 
    Route::put('/edit/{id}', [EditorialController::class, 'update'])->name('editorial.update'); 
    Route::get('/destroy/{id}', [EditorialController::class, 'destroy'])->name('editorial.destroy'); 
});

Route::prefix('book')->group(function(){
    Route::get('/index', [BookController::class, 'index'])->name('book.index');   
    Route::get('/create', [BookController::class, 'create'])->name('book.create');
    Route::get('/edit/{id}', [BookController::class, 'edit'])->name('book.edit'); 
    Route::post('/create', [BookController::class, 'store'])->name('book.store'); 
    Route::put('/edit/{id}', [BookController::class, 'update'])->name('book.update'); 
    Route::get('/destroy/{id}', [BookController::class, 'destroy'])->name('book.destroy'); 
});