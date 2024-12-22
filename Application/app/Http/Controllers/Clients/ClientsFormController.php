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

        if ($this->id == 0) {
            return view('clients.add-clients');
        }

        $client = $this->getClientDetails();

        if (blank($client)) {
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

    public function delete(int $id) : RedirectResponse
    {
        // Begin a transaction to ensure consistency
        DB::beginTransaction();

        try {
            // Delete the client's contacts
            ClientsContacts::where('client_id', $id)->delete();

            // Delete the client
            $client = Clients::findOrFail($id);
            $client->delete();

            // Commit the transaction
            DB::commit();

            return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            return redirect()->route('clients.index')->with('error', 'Failed to delete client: ' . $e->getMessage());
        }
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

    private function clientExists($id)
    {
        return Clients::where('id', $id)->exists();
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
