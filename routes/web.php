<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

/**
 * Costumer Routes
 * ***************
 */

Route::view('/costumer/w', 'welcome-costumer');

Volt::route('/costumer/l', 'costumer.login-costumer')->name('login-costumer');
Volt::route('/costumer/r', 'costumer.register-costumer')->name('register-costumer');

/*----------------------------------------------------------------------------------- */

/**
 * Employee Routes
 * ***************
 */

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
 
 /*----------------------------------------------------------------------------------- */


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
