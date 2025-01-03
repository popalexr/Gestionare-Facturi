<?php

namespace App\Listeners;

use App\Models\Invoices;
use App\Services\SPV;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
        $spv = new SPV($event->invoice_id);

        $spv->generateXml();
        $status = $spv->sendXmlToSPV();

        if($status) {
            Invoices::where('id', $event->invoice_id)->update(['spv_status' => 'approved']);
        }
        else
        {
            Invoices::where('id', $event->invoice_id)->update(['spv_status' => 'rejected']);
        }
    }
}
