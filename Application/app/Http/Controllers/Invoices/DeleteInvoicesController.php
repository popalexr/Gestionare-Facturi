<?php

namespace App\Http\Controllers\Invoices;
use App\Models\Invoices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DeleteInvoicesController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->get('id', 0);

        if ($id == 0) {
            return redirect()->route('invoices.index')->with('error', 'Invoice not found.');
        }

        $invoice = Invoices::find($id);

        if (blank($invoice)) {
            return redirect()->route('invoices.index')->with('error', 'Invoice not found.');
        }

        $invoice->deleted_at = now(); // Soft delete the invoice
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}