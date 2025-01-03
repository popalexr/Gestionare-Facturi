<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExportInvoiceToSpvListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 5;

    /**
     * Handle the event.
     * 
     * @param object $event
     * @return void
     */
    public function handle(object $event): void
    {
        //
    }
}
