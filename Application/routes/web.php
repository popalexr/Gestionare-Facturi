<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\ClientsController; 
use App\Http\Controllers\Clients\ClientDetails;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Services\ServicesDetails;
use App\Http\Controllers\Clients\ClientsFormController;


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
    });
    
    Route::get('/services', ServicesController::class)->name('services.index'); 
    Route::get('/service-details', ServicesDetails::class)->name('services.details'); // Added route for service details

});

require __DIR__.'/auth.php';