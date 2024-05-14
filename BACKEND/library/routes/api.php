<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::apiResource('editorial', EditorialController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('member', MemberController::class);
Route::apiResource('book', BookController::class);
Route::apiResource('loan', LoanController::class);
