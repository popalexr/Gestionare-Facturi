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

    public function __invoke(Request $request): View|RedirectResponse
    {
        $this->id = $request->get('id', 0);

        if ($this->id == 0) {
            return view('clients.add-clients');
        }

        $client = $this->getClientDetails();

        if (blank($client) || !blank($client['client']->deleted_at)) { // If the client doesn't exist or is deleted
            return redirect()->route('clients.index')->with('error', 'Client not found.');
        }

        return view('clients.edit-clients')->with([
            'client' => $client['client'],
            'contacts' => $client['contacts'],
        ]);
    }

    public function post(Request $request) : RedirectResponse
    {
        $this->id = $request->get('id', 0);

        if ($this->id > 0 && !$this->clientExists($this->id)) {
            return redirect()->route('clients.index')->with('error', 'Client not found.');
        }

        $request->validate($this->getFormValidationRules(), $this->getFormValidationMessages());

        DB::beginTransaction();

        if ($this->id == 0) {
            $this->id = $this->addNewClient($request);
        } else {
            $this->updateClient($request);
        }

        $this->deleteOldContacts();
        $this->addNewContacts($request);

        DB::commit();

        return redirect()->route('clients.details', ['id' => $this->id])->with('success', 'Client saved successfully.');
    }

    private function getClientDetails() : array|null
    {
        $client = Clients::where('id', $this->id)->first();

        if (blank($client)) {
            return null;
        }

        $contacts = ClientsContacts::where('client_id', $this->id)->get();

        return [
            'client' => $client,
            'contacts' => $contacts,
        ];
    }

    private function getFormValidationRules() : array
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

    private function getFormValidationMessages() : array
    {
        return [
            'name.required' => 'Name field is required.',
            'address.required' => 'Address field is required.',
            'city.required' => 'City field is required.',
            'county.required' => 'County field is required.',
            'country.required' => 'Country field is required.',
            'client_type.required' => 'Client type field is required.',
        ];
    }

    private function clientExists($id): bool
    {
        $client = Clients::find($id);

        return !(blank($client) || !blank($client->deleted_at)); // If the client doesn't exist or is deleted return false
    }

    private function addNewClient($request)
    {
        return Clients::insertGetId([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'county' => $request->county,
            'country' => $request->country,
            'client_type' => $request->client_type,
            'cui' => $request->cui,
        ]);
    }

    private function updateClient($request)
    {
        Clients::where('id', $this->id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'county' => $request->county,
            'country' => $request->country,
            'client_type' => $request->client_type,
            'cui' => $request->cui,
        ]);
    }

    private function deleteOldContacts()
    {
        ClientsContacts::where('client_id', $this->id)->delete();
    }

    private function addNewContacts($request)
    {
        if (!isset($request->contacts)) {
            return;
        }

        $contacts = [];
        foreach ($request->contacts as $contact) {
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
