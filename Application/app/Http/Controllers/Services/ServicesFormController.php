<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ServicesFormController extends Controller
{
    private int $id = 0;

    public function __invoke(Request $request) : View
    {
        $this->id = $request->query('id', 0);

        if($this->id == 0)
            return view('services.add-services');
        
        if(!$this->serviceExists($this->id))
            return redirect()->route('services.index')->with('error', 'Service not found.');

        $service = $this->getServiceDetails();

        return view('services.edit-services')->with([
            'service' => $service,
        ]);
    }

    public function post(Request $request) : RedirectResponse
    {
        $this->id = $request->query('id', 0);
        
        if($this->id > 0 && !$this->serviceExists($this->id))
            return redirect()->route('services.index')->with('error', 'Service not found.');

        $request->validate($this->getFormValidationRules(), $this->getFormValidationMessages());

        if($this->id == 0)
            $this->id = $this->addNewService($request);
        else
            $this->updateService($request);

        return redirect()->route('services.details', ['id' => $this->id])->with('success', 'Service saved successfully.');
    }

    private function getServiceDetails()
    {
        $service = Services::where('id', $this->id)->first();
    
        return $service;
    }

    private function getFormValidationRules() : Array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price'       => 'required|numeric',
            'vat'         => 'required|numeric|between:0,100',
            'currency'    => 'required|string|max:255',
        ];
    }

    private function getFormValidationMessages() : Array
    {
        return [
            'name.required'         => 'Name field is required.',
            'name'                  => 'Name field is invalid.',
            'description.required'  => 'Description field is required.',
            'description.max'       => 'Description field is too long. It must have a maximum of :max characters.',
            'description'           => 'Description field is invalid.',
            'price.required'        => 'Price field is required.',
            'price'                 => 'Price field is invalid.',
            'vat.required'          => 'VAT field is required.',
            'vat.between'           => 'VAT value must be between 0 and 100.',
            'vat'                   => 'VAT field is invalid.',
            'currency.required'     => 'Currency field is required.',
            'currency'              => 'Currency field is invalid.',
        ];
    }

    private function serviceExists() : bool
    {
        return Services::where('id', $this->id)->whereNull('deleted_at')->exists();
    }

    private function addNewService($request) : int
    {
        $id = Services::insertGetId([
            'name'       => $request->name,
            'description'=> $request->description,
            'price'      => $request->price,
            'vat'        => $request->vat,
            'currency'   => $request->currency,
        ]);

        return $id;
    }

    private function updateService($request) : void
    {
        Services::where('id', $this->id)->update([
            'name'       => $request->name,
            'description'=> $request->description,
            'price'      => $request->price,
            'vat'        => $request->vat,
            'currency'   => $request->currency,
        ]);
    }
}   
