<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Http\Controllers\Controller;


class SettingsFormController extends Controller
{
    private int $id = 0;

    public function __invoke(Request $request) : View
    {
        $this->id = $request->query('id');

        if ($this->id == 0)
            return view('settings.add-settings');
        
        $setting = Settings::find($this->id);

        if (blank($setting))
            return redirect()->route('settings.index');

        return view('settings.settings-form')->with([
            'id' => $this->id,
            'setting' => $setting
        ]);
    }

    public function post(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate($this->getFormValidationRules(), $this->getFormValidationMessages());

        if ($this->id == 0) {
            Settings::create($validatedData);
        } else {
            $setting = Settings::find($this->id);
            if (blank($setting))
                return redirect()->route('settings.index');
            
            $setting->update($validatedData);
        }

        return redirect()->route('settings.index');
    }

    private function getFormValidationRules() : array
    {
        return [
            'key'   => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ];
    }

    private function getFormValidationMessages() : array
    {
        return [
            'key.required'   => 'Key field is required.',
            'key'            => 'Key field is invalid.',
            'value.required' => 'Value field is required.',
            'value'          => 'Value field is invalid.',
        ];
    }
}