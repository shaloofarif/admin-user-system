<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

// as AdminUserController


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

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
});

// Admin Routes with Middleware
Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

    Route::resource('users', AdminUserController::class);
    
    // Logout Route
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});


// Default User Sign-Up Route
Route::get('/signup', [UserController::class, 'showSignUpForm'])->name('user.signup');
Route::post('/signup', [UserController::class, 'register'])->name('user.signup.process');


Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserController::class, 'processLogin'])->name('user.login.process');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () 
{
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::post('/user/edit', [UserController::class, 'updateProfile'])->name('user.profile.update');
});

// Route::get('/send-test-email', function () {
//     Mail::to('shaloofarif@gmail.com')->send(new TestEmail());
//     return 'Test email sent successfully!';
// });

Route::get('/', function () {
    return view('auth.login');
});
