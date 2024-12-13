<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ServicesFormController extends Controller
{
    private int $id = 0;

    public function __invoke(Request $request) : View
    {
        $this->id = $request->query('id');

        if($this->id == 0)
            return view('services.add-services');
        
        return view('services.services-form')->with([
            'id', $this->id
        ]);
    }

    public function post(Request $request) : RedirectResponse
    {
        return redirect()->route('services.index');
    }

    private function getFormValidationRules() : Array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price'       => 'required|numeric',
            'currency'    => 'required|string|max:255',
        ];
    }

    private function getFormValidationMessages() : Array
    {
        return [
            'name.required'         => 'Name field is required.',
            'name'                  => 'Name field is invalid.',
            'description.required'  => 'Description field is required.',
            'description'           => 'Description field is invalid.',
            'price.required'        => 'Price field is required.',
            'price'                 => 'Price field is invalid.',
            'currency.required'     => 'Currency field is required.',
            'currency'              => 'Currency field is invalid.',
        ];
    }
}   
