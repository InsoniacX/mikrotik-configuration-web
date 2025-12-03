<?php

use App\Http\Controllers\DashboardController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MikrotikController;

Route::view('/', 'welcome')->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::get('/dashboard', [MikrotikController::class])-> name('router-info');

Route::resource('devices', DevicesController::class)
    ->middleware(['auth', 'verified'])
    ->name('index', 'devices');

Route::resource('users', UserController::class)
    ->middleware(['auth', 'verified'])
    ->name('index', 'users');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// API Routes
Route::get('/api/router-data', [MikrotikController::class, 'getRealtimeData']);
