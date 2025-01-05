<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;

class DeleteServicesController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->get('id', 0);

        if ($id == 0) {
            return redirect()->route('services.index')->with('error', 'Service not found.');
        }

        $service = Services::find($id);

        if (blank($service)) {
            return redirect()->route('services.index')->with('error', 'Service not found.');
        }

        $service->deleted_at = now(); // Soft delete the service
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
