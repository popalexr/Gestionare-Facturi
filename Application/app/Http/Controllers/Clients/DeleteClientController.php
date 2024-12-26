<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clients;

class DeleteClientController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->get('id', 0);

        if ($id == 0) {
            return redirect()->route('clients.index')->with('error', 'Client not found.');
        }

        $client = Clients::find($id);

        if (blank($client)) {
            return redirect()->route('clients.index')->with('error', 'Client not found.');
        }

        $client->deleted_at = now(); // Soft delete the client
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
