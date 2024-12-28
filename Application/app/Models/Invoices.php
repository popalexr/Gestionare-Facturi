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

    /**
     * Get client name for the invoice.
     * 
     * @return string
     */
    public function getClientName(): string
    {
        $client = Clients::find($this->client_id);

        if (blank($client)) {
            return 'Unknown';
        }

        return $client->name;
    }

    /**
     * Get client details for the invoice.
     * 
     * @return object
     */
    public function getClientDetails(): object
    {
        $client = Clients::find($this->client_id);

        if (blank($client)) {
            return (object)[
                'name'    => 'Unknown',
                'email'   => 'Unknown',
                'cui'     => 'Unknown',
                'address' => 'Unknown',
            ];
        }

        return (object)[
            'name'      => $client->name,
            'email'     => $client->email,
            'cui'       => $client->cui,
            'address'   => $client->address,
            'city'      => $client->city,
            'county'    => $client->county,
            'country'   => $client->country,
        ];
    }
}
