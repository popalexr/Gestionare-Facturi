<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\ClientsController; 
use App\Http\Controllers\Clients\ClientDetails;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Services\ServicesDetails;
use App\Http\Controllers\Clients\ClientsFormController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Services\ServicesFormController;


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
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UsersController::class)->name('users.index');
    });
    
    Route::prefix('services')->group(function () {
        Route::get('/', ServicesController::class)->name('services.index'); 
        Route::get('/details', ServicesDetails::class)->name('services.details'); // Added route for service details
        Route::get('/form', ServicesFormController::class)->name('services.form');
    });
});

require __DIR__.'/auth.php';