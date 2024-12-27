<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clients;

class GetClientsApiController extends Controller
{
    private int $maxResults = 10;

    public function __invoke(Request $request)
    {
        $q = $request->get('q', '');

        $clients = Clients::select(['id', 'name'])
            ->whereNull('deleted_at')
            ->where('name', 'like', "%$q%")
            ->limit($this->maxResults)
            ->get()
            ->toArray();

        return $clients;
    }
}
