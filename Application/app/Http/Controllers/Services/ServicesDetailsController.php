<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesDetailsController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->query('id'); // Get the id from the request

        $service = Services::find($id); // Find the service by the id

        if(blank($service))
            return redirect()->route('services.index')->with('error', 'Service not found.');

        // Redirect to the services index
        return view('services.service-details', compact('service'));
    }
}