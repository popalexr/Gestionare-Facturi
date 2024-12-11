<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientsFormController extends Controller
{
    private int $id = 0;

    public function __invoke(Request $request) : View
    {
        $this->id = $request->get('id', 0);

        if($this->id == 0)
            return view('clients.add-clients');

        return view('clients.clients-form')->with([
            'id', $this->id
        ]);
    }

    public function post(Request $request) : RedirectResponse
    {
        return redirect()->route('clients.index');
    }
}
