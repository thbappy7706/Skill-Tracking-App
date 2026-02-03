<?php

use App\Livewire\Dashboard;
use App\Livewire\Landing;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('landing');
})->name('home');

// Landing page for guests
Route::livewire('/welcome', 'home.landing')
    ->name('landing');

// Dashboard for authenticated users
Route::livewire('/dashboard', 'home.dashboard')
    ->middleware('auth')
    ->name('dashboard');
