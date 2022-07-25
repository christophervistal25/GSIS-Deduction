<?php
require_once './bootstrap.php';

use App\Route;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\ProfileController;
use App\Controllers\PostDeductionController;

Route::get('login', [LoginController::class, 'index']);
Route::post('login-post', [LoginController::class, 'login']);
Route::get('home', [HomeController::class, 'index']);
Route::get('post-deductions', [PostDeductionController::class, 'index']);
Route::get('post-deductions-fetched', [PostDeductionController::class, 'fetched']);
Route::get('post-deductions-value', [PostDeductionController::class, 'value']);
Route::post('post-deductions-post', [PostDeductionController::class, 'store']);

Route::get('profile', [ProfileController::class, 'profile']);
Route::post('profile-update', [ProfileController::class, 'update']);

Route::get('logout', [HomeController::class, 'logout']);