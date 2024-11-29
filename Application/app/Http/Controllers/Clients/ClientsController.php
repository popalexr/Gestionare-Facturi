<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientsController extends Controller
{
    public function __invoke(Request $request) : View
    {
        return view('clients.index');
    }
}
