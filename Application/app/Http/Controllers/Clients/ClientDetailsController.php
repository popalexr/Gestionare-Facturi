<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\ClientsContacts;
use Illuminate\Http\Request;

class ClientDetailsController extends Controller
{
    private int $id;

    public function __invoke(Request $request)
    {
        $this->id = $request->query('id'); // Get the id from the request

        $client = $this->getClientDetails();
        
        if (blank($client) || !blank($client->deleted_at)) // If the client doesn't exist or is deleted
            return redirect()->route('clients.index')->with('error', 'This client doesn\'t exist.'); // Redirect to the clients index
        
        $contacts = $this->getClientContacts();
        
        $invoices = $client->getInvoices(10); // Get the invoices of the client
        $invoices->appends($request->query()); // Append the query parameters to the pagination links

        return view('clients.clients-details', compact('client', 'contacts', 'invoices')); // Return the view with the client details
    }

    private function getClientDetails()
    {
        return Clients::find($this->id);
    }

    private function getClientContacts()
    {
        return ClientsContacts::where('client_id', $this->id)->get();
    }
}
