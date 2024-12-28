<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function __invoke(Request $request)
    {
        $invoices = Invoices::whereNull('deleted_at')->paginate(10);

        $parsed_invoices = $this->parseInvoices($invoices);

        return view('invoices.invoices-index')->with([
            'invoices' => $invoices,
            'parsed_invoices' => $parsed_invoices,
        ]);
    }

    /**
     * Function that parse the invoices.
     * 
     * @param $invoices
     * @return object
     */
    private function parseInvoices($invoices): object
    {
        $result = [];

        foreach ($invoices as $invoice) {
            $invoice_data = [
                'id' => $invoice->id,
                'client_name' => $this->getClientName($invoice->client_id),
                'currency' => currency_symbol($invoice->currency),
                'created_at' => $invoice->created_at->format('d M Y H:i'),
                'value' => $invoice->value,
                'spv_status' => $invoice->spv_status,
            ];

            $result[] = (object)$invoice_data;
        }

        return (object)$result;
    }

    /**
     * Get client name
     * 
     * @param int $client_id
     * @return string
     */
    public function getClientName($client_id): string
    {
        $client = Clients::find($client_id);
        
        if (blank($client)) {
            return 'Unknown';
        }

        return $client->name;
    }
}
