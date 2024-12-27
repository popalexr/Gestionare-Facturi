<?php

namespace App\Http\Controllers\Invoices;

use App\Events\AddedInvoice;
use App\Events\UpdatedInvoice;
use App\Http\Controllers\Controller;
use App\Models\InvoiceProducts;
use App\Models\Invoices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesFormController extends Controller
{
    private int $id = 0;

    /**
     * Display the form to add or edit invoices.
     * 
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $this->id = $request->get('id', 0);

        if($this->id > 0 && blank($this->getInvoiceDetails($this->id))) {
            return redirect()->route('invoices.index')->with('error', 'Invoice not found.');
        }
        
        if($this->id === 0) {
            return view('invoices.add-invoices');
        }

        $invoice = $this->getInvoiceDetails($this->id);
        $products = $this->parseInvoiceProducts($invoice->getProducts());

        return view('invoices.edit-invoices')->with([
            'invoice'  => $invoice,
            'products' => $products,
        ]);
    }

    /**
     * Post method to add or edit invoices.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function post(Request $request): RedirectResponse
    {
        $this->id = $request->get('id', 0);

        $request->validate($this->getValidationRules(), $this->getValidationMessages());

        $invoice = $this->getInvoiceDetails($this->id);

        // Begin transaction
        DB::beginTransaction();

        if(blank($invoice)) { // If the invoice does not exist, then the form is used to add an invoice
            $this->id = $this->addInvoice($request);
        }
        else { // If the invoice exists, then the form is used to edit an existing invoice
            $this->editInvoice($request);
        }

        $this->deleteProducts(); // Delete all products from the invoice
        $this->addProducts($request); // Add products to the invoice from request

        // Commit transaction
        DB::commit();

        if(blank($invoice)) {
            AddedInvoice::dispatch($this->id); // Trigger the AddedInvoice event
        }
        else {
            UpdatedInvoice::dispatch($this->id); // Trigger the UpdatedInvoice event
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice saved successfully.');
    }

    /**
     * Function that returns form validation rules.
     * 
     * @return array
     */
    private function getValidationRules(): array
    {
        return [
            'client_name'               => 'required|string|exists:clients,name',
            'client_id'                 => 'required|integer|exists:clients,id',
            'currency'                  => 'required|string|in:ron,eur,usd',
            'products.*.product_name'   => 'required|string|max:255',
            'products.*.quantity'       => 'required|integer|min:1',
            'products.*.price'          => 'required|numeric|min:0',
            'products.*.vat'            => 'required|numeric|min:0|max:100',
            'products.*.currency'       => 'required|string|in:ron,eur,usd',
        ];
    }

    /**
     * Function that returns form validation messages.
     * 
     * @return array
     */
    private function getValidationMessages(): array
    {
        return [
            'client_name.required'              => 'The client name field is required.',
            'client_name'                       => 'The selected client name is invalid.',
            'currency.required'                 => 'The currency field is required.',
            'currency'                          => 'The selected currency is invalid.',
            'products.*.product_name.required'  => 'The product name field is required.',
            'products.*.product_name.max'       => 'The product name may not be greater than :max characters.',
            'products.*.quantity.required'      => 'The quantity field is required.',
            'products.*.quantity.min'           => 'The quantity must be at least :min.',
            'products.*.quantity'               => 'The quantity field is invalid.',
            'products.*.price.required'         => 'The price field is required.',
            'products.*.price.min'              => 'The price must be at least :min.',
            'products.*.price'                  => 'The quantity field is invalid.',
            'products.*.vat.required'           => 'The VAT field is required.',
            'products.*.vat.min'                => 'The VAT must be at least :min.',
            'products.*.vat.max'                => 'The VAT may not be greater than :max.',
            'products.*.vat'                    => 'The VAT field is invalid.',
            'products.*.currency.required'      => 'The currency field is required.',
            'products.*.currency.in'            => 'The selected currency is invalid',
            'products.*.currency'               => 'The currency field is invalid.',
        ];
    }

    /**
     * Get the invoice details.
     * 
     * @param int $id
     * @return Invoices|null - It returns null if the invoice does not exist.
     */

    private function getInvoiceDetails(int $id): Invoices|null
    {
        $invoice = Invoices::find($id);

        return $invoice;
    }

    /**
     * Function that handles Add Invoice
     * 
     * @param Request $request
     * @return int id of the invoice
     */
    private function addInvoice(Request $request): int
    {
        $id = Invoices::insertGetId([
            'client_id' => $request->get('client_id'),
            'currency' => $request->get('currency'),
            'created_at' => now(),
        ]);

        return $id;
    }

    /**
     * Function that handles Edit Invoice
     * 
     * @param Request $request
     */
    private function editInvoice(Request $request): void
    {
        Invoices::where('id', $this->id)->update([
            'client_id' => $request->get('client_id'),
            'currency' => $request->get('currency'),
        ]);
    }

    /**
     * Function that deletes all products from an invoice.
     */
    private function deleteProducts(): void
    {
        InvoiceProducts::where('invoice_id', $this->id)->delete();
    }

    /**
     * Function that adds products to an invoice.
     * 
     * @param Request $request
     */
    private function addProducts(Request $request): void
    {
        $products = $request->get('services', []);

        foreach ($products as $product) {
            InvoiceProducts::insert([
                'invoice_id'    => $this->id,
                'product_name'  => $product['service_name'],
                'quantity'      => $product['quantity'],
                'price'         => $product['price'],
                'vat'           => $product['vat'],
                'currency'      => $product['currency'],
            ]);
        }
    }

    /**
     * Function that transforms the invoice products data.
     * 
     * @param object $products
     * @return array
     */
    public function parseInvoiceProducts(object $products): array
    {
        $result = [];

        foreach ($products as $product) {
            $product_data = [
                'id'           => $product->id,
                'service_name' => $product->product_name,
                'quantity'     => $product->quantity,
                'price'        => $product->price,
                'vat'          => $product->vat,
                'currency'     => $product->currency,
            ];

            $result[] = $product_data;
        }

        return $result;
    }
}
