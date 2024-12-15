<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ClientsController
 */
class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request) : View
    {
        $clients = Clients::select(['id', 'name', 'client_type', 'cui'])->paginate(10); // Get all clients from the database
        
        return view('clients.clients-index', compact('clients')); // Return the view with the clients
    }
}
