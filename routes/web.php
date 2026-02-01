<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Homepage - shows landing page for guests, dashboard for authenticated users
Route::get('/', [HomeController::class, 'index'])->name('home');

// Fallback to Filament admin routes
