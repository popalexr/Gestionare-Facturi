<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientsController extends Controller
{
    public function __invoke(Request $request) : View
    {
        $clients = Clients::all(); // Get all clients from the database
        return view('clients.clients-index', compact('clients')); // Return the view with the clients
    }
}
