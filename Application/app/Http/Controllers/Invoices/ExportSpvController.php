<?php

namespace App\Http\Controllers\Invoices;

use App\Events\ExportInvoiceToSpv;
use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExportSpvController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->get('id', 0);

        if ($id == 0) {
            return redirect()->route('invoices.index')->with('error', 'Invalid invoice to be exported.');
        }

        if(!$this->isValidInvoice($id)) {
            return redirect()->route('invoices.index')->with('error', 'Invalid invoice to be exported.');
        }

        $this->setInvoiceStatusAsPending($id);

        ExportInvoiceToSpv::dispatch($id);

        return redirect()->route('invoices.index')->with('success', 'Invoice has been exported to SPV.');
    }

    /**
     * Check if the invoice is valid
     * 
     * @param int $id
     * @return bool
     */
    private function isValidInvoice(int $id): bool
    {
        $invoice = Invoices::find($id);
        
        return !blank($invoice) && blank($invoice->deleted_at);
    }

    /**
     * Set the invoice status for spv as pending
     * 
     * @param int $id
     * @return void
     */
    private function setInvoiceStatusAsPending(int $id): void
    {
        $invoice = Invoices::find($id);
        $invoice->spv_status = 'pending';
        $invoice->save();
    }
}
