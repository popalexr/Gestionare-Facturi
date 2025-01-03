<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\ClientsController; 
use App\Http\Controllers\Clients\ClientDetailsController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Services\ServicesDetailsController;
use App\Http\Controllers\Clients\ClientsFormController;
use App\Http\Controllers\Clients\DeleteClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Invoices\ExportSpvController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Users\UserDetailsController;
use App\Http\Controllers\Users\UsersFormController;
use App\Http\Controllers\Services\ServicesFormController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Users\DeleteUserController;
use App\Http\Controllers\Invoices\InvoicesController;
use App\Http\Controllers\Invoices\InvoicesDetailsController;
use App\Http\Controllers\Invoices\InvoicesFormController;
use App\Http\Controllers\Invoices\DeleteInvoicesController;

Route::get('/', DashboardController::class)->middleware(['auth', 'verified']);

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('clients')->group(function () {
        Route::get('/', ClientsController::class)->name('clients.index')->can('clients-view'); 
        Route::get('/details', ClientDetailsController::class)->name('clients.details')->can('clients-view');
        Route::get('/form', ClientsFormController::class)->name('clients.form')->can('clients-form');
        Route::post('/form', [ClientsFormController::class, 'post'])->can('clients-form');
        Route::post('/delete', DeleteClientController::class)->name('clients.delete')->can('clients-delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UsersController::class)->name('users.index')->can('users-view');
        Route::get('/details', UserDetailsController::class)->name('users.details')->can('users-view');
        Route::get('/form', UsersFormController::class)->name('users.form')->can('users-form');
        Route::post('/form', [UsersFormController::class, 'post'])->can('users-form');
        Route::post('/delete', DeleteUserController::class)->name('users.delete')->can('users-delete');
    });

    Route::prefix('invoices')->group(function () {
        Route::get('/', InvoicesController::class)->name('invoices.index')->can('invoices-view');
        Route::get('/details', InvoicesDetailsController::class)->name('invoices.details')->can('invoices-view');
        Route::get('/print', \App\Http\Controllers\Invoices\InvoicePrintController::class)->name('invoices.print')->can('invoices-view');
        Route::get('/form', InvoicesFormController::class)->name('invoices.form')->can('invoices-form');
        Route::get('/export-spv', ExportSpvController::class)->name('invoices.export-spv')->can('invoices-view');
        Route::post('/form', [InvoicesFormController::class, 'post'])->can('invoices-form');
        Route::post('/delete' , DeleteInvoicesController::class)->name('invoices.delete')->can('invoices-delete');
        // TODO: Add delete invoice route
    });
    
    Route::prefix('services')->group(function () {
        Route::get('/', ServicesController::class)->name('services.index')->can('services-view'); 
        Route::get('/details', ServicesDetailsController::class)->name('services.details')->can('services-view');
        Route::get('/form', ServicesFormController::class)->name('services.form')->can('services-form');
        Route::post('/form', [ServicesFormController::class, 'post'])->can('services-form');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', SettingsController::class)->name('settings.index')->can('settings-update');
        Route::post('/', [SettingsController::class, 'post'])->can('settings-update');
    });

    Route::prefix('api')->group(function () {
        Route::get('/get-clients', \App\Http\Controllers\API\GetClientsApiController::class)->name('api.get-clients');
        Route::get('/get-services', \App\Http\Controllers\API\GetServicesApiController::class)->name('api.get-services');
    });
});

Route::prefix('anaf')->group(function () {
    Route::get('/authorize', [\App\Http\Controllers\Anaf\AnafOAuthController::class, 'authorize'])->name('anaf.authorize');
    Route::get('/callback', [\App\Http\Controllers\Anaf\AnafOAuthController::class, 'callback'])->name('anaf.callback');
});

require __DIR__.'/auth.php';