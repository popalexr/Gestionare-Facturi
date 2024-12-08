<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientDetails extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->query('id'); // Get the id from the request

        $client = Clients::find($id); // Find the client by the id
        
        if (blank($client))
            return redirect()->route('clients.index'); // Redirect to the clients index
        
        return view('clients.clients-details', compact('client')); // Return the view with the client details
    }
}
