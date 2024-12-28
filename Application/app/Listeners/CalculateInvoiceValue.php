<?php

namespace App\Listeners;

use App\Models\Invoices;
use App\Services\CurrencyConverter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculateInvoiceValue implements ShouldQueue
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
        $invoice_id = $event->invoice_id;

        $invoice = Invoices::find($invoice_id);

        if(blank($invoice)) {
            return;
        }
        
        $invoice->value = $this->calculateInvoiceValue($invoice);

        $invoice->save();
    }

    /**
     * Calculate the invoice value.
     * 
     * @param Invoices $invoice
     * @return float
     */
    public function calculateInvoiceValue(Invoices $invoice): float
    {
        $value = 0;

        foreach ($invoice->getProducts() as $product) {
            if($product->currency !== $invoice->currency)
            {
                $product->price = CurrencyConverter::convert($product->price, $product->currency, $invoice->currency);
            }

            $value += ($product->price + $product->price * ($product->vat / 100) ) * $product->quantity;
        }

        return $value;
    }
}
