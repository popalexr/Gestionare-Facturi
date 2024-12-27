<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class GetServicesApiController extends Controller
{
    private int $maxResults = 10;

    public function __invoke(Request $request)
    {
        $q = $request->get('q', '');

        $services = Services::select(['name', 'price', 'vat', 'currency'])
            ->whereNull('deleted_at')
            ->where('name', 'like', "%$q%")
            ->limit($this->maxResults)
            ->get()
            ->toArray();

        return $services;
    }
}
