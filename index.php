<?php
require_once './bootstrap.php';

use App\Route;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\PostDeductionController;

Route::get('login', [LoginController::class, 'index']);
Route::post('login-post', [LoginController::class, 'login']);
Route::get('home', [HomeController::class, 'index']);
Route::get('post-deductions', [PostDeductionController::class, 'index']);
Route::get('post-deductions/remaining', [PostDeductionController::class, 'remaining']);