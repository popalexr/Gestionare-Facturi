<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{
    private int $id = 0;

    public function __invoke(Request $request)
    {
        $this->id = $request->get('id', 0);

        if($this->id === 0) {
            return redirect()->route('invoices.index')->with('error', 'Invoice not found.');
        }

        $invoice = $this->getInvoiceDetails($this->id);

        if(!blank($invoice->deleted_at))
            return redirect()->route('invoices.index')->with('error', 'Invoice not found.');

        if(blank($invoice)) {
            return redirect()->route('invoices.index')->with('error', 'Invoice not found.');
        }

        $client = $invoice->getClientDetails();
        $products = $this->parseInvoiceProducts($invoice);
        $provider = $this->getProviderDetails();

        return view('invoices.invoices-details')->with([
            'invoice'  => $invoice,
            'products' => $products,
            'client'   => $client,
            'provider' => $provider,
        ]);
    }

    /**
     * Get invoice details
     * 
     * @param int $id
     * @return object
     */
    private function getInvoiceDetails(int $id): object
    {
        return Invoices::find($id);
    }

    /**
     * Function that gets details about the provider from Settings
     * 
     * @return object
     */
    private function getProviderDetails(): object
    {
        return (object)[
            'name'      => settings()->get('company_name') ?? '-',
            'address'   => settings()->get('company_address') ?? '-',
            'city'      => settings()->get('company_city') ?? '-',
            'county'    => settings()->get('company_county') ?? '-',
            'country'   => settings()->get('company_country') ?? '-',
            'cui'       => settings()->get('company_cui') ?? '-',
        ];
    }

    /**
     * Function that gets the products for the invoice.
     * 
     * @param Invoices $invioce
     * @return object
     */
    private function parseInvoiceProducts(Invoices $invoice): object
    {
        $result = [];

        foreach ($invoice->getProducts() as $product) {
            $price = CurrencyConverter::convert($product->price, $product->currency, $invoice->currency);

            $product_data = [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'quantity' => $product->quantity,
                'price' => $price,
                'vat' => $product->vat,
                'total' => round(($price + ($price * $product->vat / 100)) * $product->quantity, 2),
            ];

            $result[] = (object)$product_data;
        }

        return (object)$result;
    }
}
