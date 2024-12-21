<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Clients;
use App\Models\ClientsContacts;
use Illuminate\Support\Facades\DB;

class ClientsFormController extends Controller
{
    private int $id = 0;

    public function __invoke(Request $request) : View
    {
        $this->id = $request->get('id', 0);

        if($this->id == 0)
            return view('clients.add-clients');

        $client = $this->getClientDetails();

        if(blank($client))
            return redirect()->route('clients.index')->with('error', 'Client not found.');

        return view('clients.edit-clients')->with([
            'client' => $client['client'],
            'contacts' => $client['contacts'],
        ]);
    }

    public function post(Request $request) : RedirectResponse
    {
        $this->id = $request->get('id', 0);

        if($this->id > 0 && !$this->clientExists($this->id))
            return redirect()->route('clients.index')->with('error', 'Client not found.');

        $request->validate($this->getFormValidationRules(), $this->getFormValidationMessages());
        
        DB::beginTransaction();

        if ($this->id == 0)
            $this->id = $this->addNewClient($request);
        else
            $this->updateClient($request);

        $this->deleteOldContacts();
        $this->addNewContacts($request);

        DB::commit();

        return redirect()->route('clients.index');
    }

    private function getClientDetails() : array|null
    {
        $client = Clients::where('id', $this->id)->first();
        
        if(blank($client))
            return null;

        $contacts = ClientsContacts::where('client_id', $this->id)->get();

        return [
            'client' => $client,
            'contacts' => $contacts,
        ];
    }

    private function getFormValidationRules() : Array
    {
        return [
            'name'                  => 'required|string|max:255', 
            'address'               => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'county'                => 'required|string|max:255',
            'country'               => 'required|string|max:255',
            'client_type'           => 'required|in:individual,company',
            'contacts.*.first_name' => 'string|max:255',
            'contacts.*.last_name'  => 'string|max:255',
            'contacts.*.title'      => 'string|max:255',
            'contacts.*.email'      => 'email',
            'contacts.*.phone'      => 'string|max:255',
        ];
    }

    private function getFormValidationMessages() : Array
    {
        return [
            'name.required'                     => 'Name field is required.',
            'name'                              => 'Name field is invalid.',
            'adress.required'                   => 'Address field is required.',
            'adress'                            => 'Address field is invalid.',
            'city.required'                     => 'City field is required.',
            'city'                              => 'City field is invalid.',
            'county.required'                   => 'County field is required.',
            'county'                            => 'County field is invalid.',
            'country.required'                  => 'Country field is required.',
            'country'                           => 'Country field is invalid.',
            'client_type.required'              => 'Client type field is required.',
            'client_type.in'                    => 'Client type field is invalid.',
            'cui.required'                      => 'CUI field is required.',
            'cui'                               => 'CUI field is invalid.',
            'contacts.*.first_name.required'    => 'First name field is required.',
            'contacts.*.first_name'             => 'First name field is invalid.',
            'contacts.*.last_name.required'     => 'Last name field is required.',
            'contacts.*.last_name'              => 'Last name field is invalid.',
            'contacts.*.title.required'         => 'Title field is required.',
            'contacts.*.title'                  => 'Title field is invalid.',
            'contacts.*.email.required'         => 'Email field is required.',
            'contacts.*.email'                  => 'Email field is invalid.',
            'contacts.*.phone.required'         => 'Phone field is required.',
            'contacts.*.phone'                  => 'Phone field is invalid.',
        ];
    }

    private function clientExists($id)
    {
        return Clients::where('id', $id)->exists();
    }

    private function addNewClient($request)
    {
        return  Clients::insertGetId([
            'name'          => $request->name,
            'address'       => $request->address,
            'city'          => $request->city,
            'county'        => $request->county,
            'country'       => $request->country,
            'client_type'   => $request->client_type,
            'cui'           => $request->cui,
        ]);
    }

    private function updateClient($request)
    {
        Clients::where('id', $this->id)->update([
            'name'          => $request->name,
            'address'       => $request->address,
            'city'          => $request->city,
            'county'        => $request->county,
            'country'       => $request->country,
            'client_type'   => $request->client_type,
            'cui'           => $request->cui,
        ]);
    }

    private function deleteOldContacts()
    {
        ClientsContacts::where('client_id', $this->id)->delete();
    }

    private function addNewContacts($request)
    {
        if(!isset($request->contacts))
            return;

        $contacts = [];
        foreach($request->contacts as $contact)
        {
            $contacts[] = [
                'client_id' => $this->id,
                'first_name' => $contact['first_name'],
                'last_name' => $contact['last_name'],
                'title' => $contact['title'],
                'email' => $contact['email'],
                'phone' => $contact['phone'],
            ];
        }

        ClientsContacts::insert($contacts);
    }
}
