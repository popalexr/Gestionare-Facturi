<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\ClientsController; 
use App\Http\Controllers\Clients\ClientDetails;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Services\ServicesDetails;
use App\Http\Controllers\Clients\ClientsFormController;
use App\Http\Controllers\Clients\DeleteClientController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Services\ServicesFormController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Settings\SettingsDetails;
use App\Http\Controllers\Settings\SettingsFormController;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('clients')->group(function () {
        Route::get('/', ClientsController::class)->name('clients.index'); 
        Route::get('/details', ClientDetails::class)->name('clients.details'); 
        Route::get('/form', ClientsFormController::class)->name('clients.form');
        Route::post('/form', [ClientsFormController::class, 'post']);
        Route::post('/delete', DeleteClientController::class)->name('clients.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UsersController::class)->name('users.index');
    });
    
    Route::prefix('services')->group(function () {
        Route::get('/', ServicesController::class)->name('services.index'); 
        Route::get('/details', ServicesDetails::class)->name('services.details'); // Added route for service details
        Route::get('/form', ServicesFormController::class)->name('services.form');
        Route::post('/form', [ServicesFormController::class, 'post']);
    });

    Route::middleware('auth')->group(function () {
        Route::prefix('settings')->group(function () {
            Route::get('/', SettingsController::class)->name('settings.index'); // Single-action
            Route::get('/details', SettingsDetails::class)->name('settings.details'); // Single-action
            Route::get('/form', SettingsFormController::class)->name('settings.form'); // Single-action
            Route::post('/form', [SettingsFormController::class, 'post'])->name('settings.form.post'); // For form submission
        });
    });
});

require __DIR__.'/auth.php';