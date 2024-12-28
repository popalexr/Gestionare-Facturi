<?php

namespace App\Services;

use App\Models\Settings as ModelSettings;

class Settings
{
    private static ?Settings $instance = null;

    /**
     * Get the settings instance
     * 
     * @return Settings
     */
    public static function getInstance(): Settings
    {
        if (is_null(self::$instance)) {
            self::$instance = new Settings();
        }

        return self::$instance;
    }

    /**
     * Get the value of a setting
     * 
     * @param string $key
     * @return string|null
     */
    public function get(string $key): string|null
    {
        if(cache()->has('settings_' . $key)) {
            return cache()->get('settings_' . $key);
        }

        $setting = ModelSettings::where('key', $key)->first();

        if(blank($setting)) {
            return null;
        }

        cache()->put('settings_' . $key, $setting->value, 60 * 60 * 24); // Store the setting in cache for 24 hours

        return $setting->value;
    }

    /**
     * Set the value of a setting
     * 
     * @param string $key
     * @param string $value
     * @param string $type = 'string' - Accepted values = string, int, json.
     * 
     * @return void
     */
    public function set(string $key, ?string $value, string $type = 'string'): void
    {
        $setting = ModelSettings::where('key', $key)->first();
        
        if(blank($value))
        {
            ModelSettings::where('key', $key)->delete();
            cache()->forget('settings_' . $key);

            return;
        }

        cache()->put('settings_' . $key, $value, 60 * 60 * 24); // Store the setting in cache for 24 hours

        if(!blank($setting))
        {
            $setting->value = $value;
            $setting->type = $type;
            $setting->save();

            return;
        }

        ModelSettings::insert([
            'key' => $key,
            'value' => $value,
            'type' => $type,
        ]);
    }
}