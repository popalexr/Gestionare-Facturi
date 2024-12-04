<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesDetails extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->query('id'); // Get the id from the request
        $service = Services::findOrFail($id); // Find the service by the id
        return view('services.services-details', compact('service')); // Return the view with the service details
    }
}