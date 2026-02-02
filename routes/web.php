<?php

use App\Livewire\Dashboard;
use App\Livewire\Landing;
use Illuminate\Support\Facades\Route;

// Homepage - shows landing page for guests, dashboard for authenticated users
Route::get('/', function () {
    return auth()->check() 
        ? redirect()->route('dashboard')
        : redirect()->route('landing');
})->name('home');

// Landing page for guests
Route::get('/welcome', Landing::class)
    ->name('landing');

// Dashboard for authenticated users
Route::get('/dashboard', Dashboard::class)
    ->middleware('auth')
    ->name('dashboard');
