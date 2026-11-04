<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\MaintenanceMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(MaintenanceMiddleware::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [HomeController::class, 'blogShow'])->name('blog.show');
    Route::get('/category/{slug}', [HomeController::class, 'categoryShow'])->name('category.show');
    Route::get('/project', [HomeController::class, 'projects'])->name('projects');
    Route::get('/project/{slug}', [HomeController::class, 'projectShow'])->name('project.show');
    
    // Public Static Pages
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'showContactForm'])->name('contact');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
    Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
    
    // Secure Contact Form Submission with Throttling
    Route::post('/contact', [HomeController::class, 'contact'])
        ->name('contact.store')
        ->middleware('throttle:5,1');

    // Dynamic Service Landing Pages (/services/{slug} and direct /{slug})
    Route::get('/services/{slug}', [HomeController::class, 'serviceShow'])->name('services.show');
    Route::get('/{slug}', [HomeController::class, 'serviceShow'])
        ->where('slug', '^(?!admin$|login$|logout$|sitemap$)[a-zA-Z0-9\-]+$')
        ->name('services.direct');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

use App\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-categories.xml', [SitemapController::class, 'categories'])->name('sitemap.categories');
Route::get('/sitemap-projects.xml', [SitemapController::class, 'projects'])->name('sitemap.projects');
Route::get('/sitemap-blogs.xml', [SitemapController::class, 'blogs'])->name('sitemap.blogs');
Route::get('/sitemap-images.xml', [SitemapController::class, 'images'])->name('sitemap.images');
Route::get('/sitemap-local.xml', [SitemapController::class, 'local'])->name('sitemap.local');
