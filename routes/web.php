<?php

use App\Http\Controllers\BeforeTestController;
use App\Http\Controllers\JftTestConstroller;
use App\Http\Controllers\PackageTestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

Route::get('/', function () {
    return view('welcome');
});


// Tamu
Route::get('/login', [SessionController::class, 'index'])->middleware('isTamu');
Route::post('/login', [SessionController::class, 'login'])->middleware('isTamu');
Route::get('/logout', [SessionController::class, 'logout']);
Route::get('/register', [SessionController::class, 'register'])->middleware('isTamu');
Route::post('/create', [SessionController::class, 'create'])->middleware('isTamu');


// User
Route::get('/before-test', [BeforeTestController::class, 'index'])->middleware('isLogin');
Route::get('/instruction', [BeforeTestController::class, 'instruction'])->middleware('isLogin');

Route::get('/do-test/sec/{ids}/que/{num}', [JftTestConstroller::class, 'index'])->middleware('isLogin');
Route::post('/do-test', [JftTestConstroller::class, 'store'])->middleware('isLogin');
Route::get('/result-test', [JftTestConstroller::class, 'result'])->middleware('isLogin');
Route::get('/result-test/download/pdf', [JftTestConstroller::class, 'download_pdf'])->middleware('isLogin');


// Admin
Route::get('/list-package', [PackageTestController::class, 'index'])->middleware('isAdmin');

Route::get('/package/{id}', [SectionController::class, 'index'])->middleware('isAdmin');

Route::get('/section/{id}', [QuestionController::class, 'index'])->middleware('isAdmin');
Route::post('/question/{id}', [QuestionController::class, 'store'])->middleware('isAdmin');
Route::delete('/question', [QuestionController::class, 'delete'])->middleware('isAdmin');
Route::get('/question/{id}', [QuestionController::class, 'edit'])->middleware('isAdmin');
Route::put('/question/{id}', [QuestionController::class, 'update'])->middleware('isAdmin');


// Errors
Route::get('/403', [SessionController::class, 'error_forbidden']);