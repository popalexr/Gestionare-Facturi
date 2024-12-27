<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table = 'invoices';

    public $timestamps = true;

    /**
     * Get the products for the invoice.
     */

    public function getProducts()
    {
        return $this->hasMany(InvoiceProducts::class, 'invoice_id', 'id')->get();
    }
}
