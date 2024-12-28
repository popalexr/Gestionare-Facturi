<?php

if (!function_exists('currency_symbol')) {
    /**
     * Get the symbol for a specific currency.
     *
     * @param string $currency
     * @return string
     */
    function currency_symbol(string $currency): string
    {
        $symbols = config('currencies.symbols');

        return $symbols[$currency];
    }
    
    if (!function_exists('settings')) {
        /**
         * Get the settings instance.
         *
         * @return \App\Services\Settings
         */
        function settings(): \App\Services\Settings
        {
            return \App\Services\Settings::getInstance();
        }
    }
}