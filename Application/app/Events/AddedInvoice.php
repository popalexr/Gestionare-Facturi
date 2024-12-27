<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddedInvoice
{
    use Dispatchable, SerializesModels;

    /**
     * The invoice ID.
     */
    public int $invoice_id;

    /**
     * Create a new event instance.
     * 
     * @param int $invoice_id
     */
    public function __construct(int $invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }
}
