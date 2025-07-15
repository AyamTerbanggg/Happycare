<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\TourismController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Auth\RegisteredUserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================
// Public Routes
// =========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/rumah-sakit', [HospitalController::class, 'index'])->name('hospitals.index');
Route::get('/rumah-sakit/{id}', [HospitalController::class, 'show'])->name('hospitals.show');

Route::get('/wisata', [TourismController::class, 'index'])->name('tourism');
Route::get('/wisata/{id}', [TourismController::class, 'show'])->name('tourism.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// =========================
// Authentication Routes
// =========================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');
});


// Email Verification Routes
Route::get('/email/verify/{id}/{hash}', [RegisteredUserController::class, 'verify'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [RegisteredUserController::class, 'resend'])
    ->name('verification.resend');
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->name('verification.notice');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // =========================
    // User Routes
    // =========================
    // Rute profil dihapus
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    // Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Restricted Access for Authenticated Users
    Route::get('/rumah-sakit/{id}', [HospitalController::class, 'show'])->name('hospitals.show');
    Route::get('/wisata/{id}', [TourismController::class, 'show'])->name('tourism.show');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // =========================
    // Admin Routes
    // =========================
    Route::redirect('/admin', '/admin/dashboard');
    Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('hospitals', App\Http\Controllers\Admin\HospitalController::class);
        Route::resource('tourism', App\Http\Controllers\Admin\TourismController::class);
        Route::delete('tourism/{id}/delete-image', [App\Http\Controllers\Admin\TourismController::class, 'deleteImage'])->name('tourism.deleteImage');
        Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->except(['create', 'store']);

        Route::get('/chat', function () {
            return 'Admin Chatbot Page';
        })->name('chat');

        // Email Server Routes
        Route::prefix('email')->name('email.')->group(function () {
            Route::get('/', [EmailController::class, 'index'])->name('index');
            Route::get('/create', [EmailController::class, 'create'])->name('create');
            Route::post('/send', [EmailController::class, 'send'])->name('send');
            Route::get('/logs', [EmailController::class, 'logs'])->name('logs');
            Route::get('/logs/{id}', [EmailController::class, 'show'])->name('show');
            Route::get('/templates', [EmailController::class, 'templates'])->name('templates');
            Route::get('/templates/create', [EmailController::class, 'createTemplate'])->name('create-template');
            Route::post('/templates', [EmailController::class, 'storeTemplate'])->name('store-template');
            Route::get('/templates/{id}/edit', [EmailController::class, 'editTemplate'])->name('edit-template');
            Route::put('/templates/{id}', [EmailController::class, 'updateTemplate'])->name('update-template');
            Route::delete('/templates/{id}', [EmailController::class, 'deleteTemplate'])->name('delete-template');
            Route::get('/templates/{id}/preview', [EmailController::class, 'previewTemplate'])->name('preview-template');
            Route::post('/test-connection', [EmailController::class, 'testConnection'])->name('test-connection');
        });
        // Rute admin lainnya akan ditambahkan di sini nanti
    });
});

// General Settings Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/admin/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('admin.settings.update');
});