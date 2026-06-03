<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\MaintenanceMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(MaintenanceMiddleware::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [HomeController::class, 'blogShow'])->name('blog.show');
    Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
