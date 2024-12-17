<?php

namespace App\Http\Controllers\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;


class SettingsDetails extends Controller
{
    public function __invoke(Request $request)
    {
        $id = $request->query('id'); // Get the id from the request

        $setting = Settings::find($id); // Find the setting by the id
        
        if (blank($setting))
            return redirect()->route('settings.index'); // Redirect to the settings index
        
        return view('settings.settings-details', compact('setting')); // Return the view with the setting details
    }
}