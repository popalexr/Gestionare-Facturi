<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    /**
     * Whitelist keys for settings.
     */
    private array $whitelist_keys = [
        'company_name',
        'company_address',
        'company_city',
        'company_country',
        'company_county',
        'company_cui',
    ];

    /**
     * Display the form of settings.
     *
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        return view('settings.settings-index');
    }

    /**
     * Handle post method for settings.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function post(Request $request): RedirectResponse
    {
        $request->validate($this->getValidationRules(), $this->getValidationMessages());

        $this->saveSettings($request);

        return redirect()->route('settings.index')->with('success', 'Settings saved successfully.');
    }

    /**
     * Get the validation rules for the settings form.
     * 
     * @return array
     */
    private function getValidationRules(): array
    {
        return [
            'company_name'      => 'string|max:255|nullable',
            'company_address'   => 'string|max:255|nullable',
            'company_city'      => 'string|max:255|nullable',
            'company_country'   => 'string|max:255|nullable',
            'company_county'    => 'string|max:255|nullable',
            'company_cui'       => 'string|max:32|nullable',
        ];
    }

    /**
     * Get the validation messages for the settings form.
     * 
     * @return array
     */
    private function getValidationMessages(): array
    {
        return [
            'company_name.required'     => 'Company name is required.',
            'company_name.max'          => 'Company name must be less than :max characters.',
            'company_name'              => 'Company name is invalid.',
            'company_address.required'  => 'Company address is required.',
            'company_address.max'       => 'Company address must be less than :max characters.',
            'company_address'           => 'Company address is invalid.',
            'company_city.required'     => 'Company city is required.',
            'company_city.max'          => 'Company city must be less than :max characters.',
            'company_city'              => 'Company city is invalid.',
            'company_country.required'  => 'Company country is required.',
            'company_country.max'       => 'Company country must be less than :max characters.',
            'company_country'           => 'Company country is invalid.',
            'company_county.required'   => 'Company county is required.',
            'company_county.max'        => 'Company county must be less than :max characters.',
            'company_county'            => 'Company county is invalid',
            'company_cui.required'      => 'Company CUI is required.',
            'company_cui.max'           => 'Company CUI must be less than :max characters.',
            'company_cui'               => 'Company CUI is invalid.',
        ];
    }

    /**
     * Save settings to the database.
     * 
     * @param Request $request
     */
    private function saveSettings(Request $request): void
    {
        foreach($request->all() as $key => $value) {
            if(!in_array($key, $this->whitelist_keys)) {
                continue;
            }

            settings()->set($key, $value);
        }
    }
}
