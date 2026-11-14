<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\ProcessStepController;
use App\Http\Controllers\Admin\HeroSettingController;
use App\Http\Controllers\Admin\LeadAdminController;
use App\Http\Controllers\Admin\ServicesSettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/frontend-manage', [DashboardController::class, 'frontendManage'])->name('frontend-manage');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::resource('skills', SkillController::class)->except('show');
Route::resource('projects', ProjectController::class)->except('show');
Route::resource('albums', AlbumController::class)->except('show');
Route::resource('posts', PostController::class)->except('show');
Route::resource('categories', CategoryController::class)->except('show');
Route::resource('social-links', SocialLinkController::class)->except('show');
Route::resource('stats', StatController::class)->except('show');
Route::resource('services', ServiceController::class)->except('show');
Route::resource('plans', PlanController::class)->except('show');
Route::resource('testimonials', TestimonialController::class)->except('show');
Route::resource('why-choose-uses', WhyChooseUsController::class)->except('show');
Route::resource('process-steps', ProcessStepController::class)->except('show');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Lead Management & Opportunity Acquisition Routes (Rule 2, 12, 14)
Route::get('/leads', [LeadAdminController::class, 'index'])->name('leads.index');
Route::get('/leads/{id}', [LeadAdminController::class, 'show'])->name('leads.show');
Route::post('/leads/{id}/analyze', [LeadAdminController::class, 'analyze'])->name('leads.analyze');
Route::post('/leads/{id}/proposals', [LeadAdminController::class, 'storeProposal'])->name('leads.proposals.store');
Route::post('/leads/{id}/proposals/{proposal}/approve', [LeadAdminController::class, 'approveProposal'])->name('leads.proposals.approve');
Route::delete('/leads/{id}', [LeadAdminController::class, 'destroy'])->name('leads.destroy');

Route::middleware('role:super-admin,admin')->group(function () {
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/flush-cache', [SettingController::class, 'flushCache'])->name('settings.flush-cache');
    Route::post('/settings/test-email', [SettingController::class, 'testEmail'])->name('settings.test-email');

    Route::get('/hero-settings', [HeroSettingController::class, 'edit'])->name('hero-settings.edit');
    Route::put('/hero-settings', [HeroSettingController::class, 'update'])->name('hero-settings.update');

    Route::get('/services-settings', [ServicesSettingController::class, 'edit'])->name('services-settings.edit');
    Route::put('/services-settings', [ServicesSettingController::class, 'update'])->name('services-settings.update');
});
