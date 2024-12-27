<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventRegistrationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen('App\Events\AddedInvoice', 'App\Listeners\CalculateInvoiceValue');
        Event::listen('App\Events\UpdatedInvoice', 'App\Listeners\CalculateInvoiceValue');
    }
}
