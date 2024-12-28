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
        $setting = ModelSettings::where('key', $key)->first();

        if(blank($setting)) {
            return null;
        }

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

            return;
        }

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