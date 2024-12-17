<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings; // Import the Settings model
use Illuminate\View\View;

class SettingsController extends Controller
{
    
    
    /**
     * Display the list of settings.
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request) : View
    {
        $settings = Settings::select(['key', 'value', 'type'])->get(); // Get all services from the database
        
        return view('settings.settings-index', compact('settings')); // Return the view with the services
    }
    /**
     * Show the form for editing a specific setting.
     *
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function edit(Request $request, $id): View
    {
        // Find the setting by its ID
        $setting = Settings::find($id);

        if (!$setting) {
            return redirect()->route('settings.index')->with('error', 'Setting not found');
        }

        // Return the view with the setting details for editing
        return view('settings.settings-edit', compact('setting'));
    }

    /**
     * Update a specific setting.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        // Find the setting by its ID
        $setting = Settings::find($id);

        if (!$setting) {
            return redirect()->route('settings.index')->with('error', 'Setting not found');
        }

        // Update the setting
        $setting->update($validatedData);

        // Redirect back to the settings index page with a success message
        return redirect()->route('settings.index')->with('success', 'Setting updated successfully');
    }
}
