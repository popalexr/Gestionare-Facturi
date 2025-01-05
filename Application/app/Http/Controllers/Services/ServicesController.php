<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ServicesController
 */
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request) : View
    {
        $services = Services::select(['id', 'name', 'price', 'currency'])->whereNull('deleted_at')->paginate(10); // Get all services from the database
        
        return view('services.services-index', compact('services')); // Return the view with the services
    }
}