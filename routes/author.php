<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::prefix('author')->name('author.')->group(function (){
    Route::middleware(['guest:web'])->group(function (){
        Route::view('/login', 'back.pages.auth.login')->name('login');
        Route::view('/register', 'back.pages.auth.register')->name('register');
        Route::view('/forgot-password', 'back.pages.auth.forgot')->name('forgot-password');
        Route::get('/password/reset/{token}', [AuthorController::class, 'resetPasswordForm'])->name('reset-password-form');
    });
    
    Route::middleware(['auth:web'])->group(function (){
        Route::get('/home', [AuthorController::class, 'index'])->name('home');
        Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
        Route::view('/profile', 'back.pages.profile')->name('profile');
    });
});