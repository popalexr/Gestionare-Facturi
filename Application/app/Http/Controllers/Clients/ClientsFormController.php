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

    private function getFormValidationRules() : Array
    {
        return [
            'name' => 'required|string|max:255', 
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'client_type' => 'required|in:individual,company',
            
        ];
    }

    private function getFormValidationMessages() : Array
    {
        return [
            'name.required' => 'Name field is required.',
            'name' => 'Name field is invalid.',
            'adress.required' => 'Address field is required.',
            'adress' => 'Address field is invalid.',
            'city.required' => 'City field is required.',
            'city' => 'City field is invalid.',
            'county.required' => 'County field is required.',
            'county' => 'County field is invalid.',
            'country.required' => 'Country field is required.',
            'country' => 'Country field is invalid.',
            'client_type.required' => 'Client type field is required.',
            'client_type.in' => 'Client type field is invalid.',
        ];
    }

}
