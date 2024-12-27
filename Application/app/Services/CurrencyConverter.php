<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * CurrencyConverter class.
 * This class is responsible for converting the value to a specific currency.
 */
class CurrencyConverter
{
    /**
     * The API URL. {currency} will be replaced with the currency code.
     */
    private static $api_url = 'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/{currency}.json';
    
    /**
     * Convert the value to a specific currency.
     *
     * @param float $value
     * @param string $currency
     * @param string $to_currency
     * 
     * @return float
     */
    public static function convert(float $value, string $currency, string $to_currency): float
    {
        $cache_name = $currency . '-' . $to_currency;

        // Check if the currency is saved in cache
        if (cache()->has($cache_name)) {
            $currency_value = cache()->get($cache_name);
        } else {
            // If not, get the currency value from the API and save it in cache
            $currency_value = self::getCurrencyValue($currency, $to_currency);
            cache()->put($cache_name, $currency_value, now()->addMinutes(360)); // Cache the currency value for 6 hours
        }

        return $value * $currency_value;
    }

    /**
     * Get the currency value from the API.
     *
     * @param string $currency
     * 
     * @return float - The currency value with a precision of 2 decimal places.
     */
    public static function getCurrencyValue(string $currency, string $to_currency): float
    {
        $url = str_replace('{currency}', $currency, self::$api_url);
        $response = Http::get($url);

        if ($response->failed()) {
            return 0;
        }

        $response = $response->json();

        if(!isset($response[$currency][$to_currency])) { // Check if the currency is supported. If not, return 0.
            return 0;
        }

        return round($response[$currency][$to_currency], 2);
    }
}