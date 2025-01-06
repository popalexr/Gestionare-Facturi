<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Services\CurrencyConverter;

class CurrencyConverterTest extends TestCase
{
    public function test_it_fetches_conversion_from_cache()
    {
        $cacheMock = Cache::partialMock();

        // The converter checks if "usd-eur" is cached.
        $cacheMock->shouldReceive('has')
            ->once()
            ->with('usd-eur')
            ->andReturn(true);

        // If cached, it calls cache()->get('usd-eur').
        $cacheMock->shouldReceive('get')
            ->once()
            ->with('usd-eur')
            ->andReturn(0.84);

        $converted = CurrencyConverter::convert(10, 'usd', 'eur');

        // 10 * 0.84 = 8.4
        $this->assertEquals(8.4, $converted);
    }

    public function test_it_fetches_conversion_from_api_if_not_cached()
    {
        $cacheMock = Cache::partialMock();

        // The converter checks if "usd-eur" is cached.
        $cacheMock->shouldReceive('has')
            ->once()
            ->with('usd-eur')
            ->andReturn(false);

        // Not in cache => after fetching from API, it calls cache()->put(...)
        $cacheMock->shouldReceive('put')
            ->once()
            ->with('usd-eur', 0.84, \Mockery::type(\Illuminate\Support\Carbon::class));

        // Fake a successful API response
        Http::fake([
            'cdn.jsdelivr.net/*' => Http::response([
                'usd' => [
                    'eur' => 0.84
                ]
            ], 200),
        ]);

        $converted = CurrencyConverter::convert(10, 'usd', 'eur');
        $this->assertEquals(8.4, $converted);
    }

    public function test_it_returns_zero_if_api_fails()
    {
        $cacheMock = Cache::partialMock();

        // The converter checks if "usd-eur" is cached.
        $cacheMock->shouldReceive('has')
            ->once()
            ->with('usd-eur')
            ->andReturn(false);

        // API fails => returned rate is 0, and then it calls cache()->put("usd-eur", 0, ...)
        $cacheMock->shouldReceive('put')
            ->once()
            ->with('usd-eur', 0, \Mockery::type(\Illuminate\Support\Carbon::class));

        // Fake a failed API response
        Http::fake([
            'cdn.jsdelivr.net/*' => Http::response([], 500),
        ]);

        $converted = CurrencyConverter::convert(10, 'usd', 'eur');
        $this->assertEquals(0, $converted, 'Expected zero if API call fails.');
    }

    public function test_it_returns_zero_if_currency_not_supported()
    {
        $cacheMock = Cache::partialMock();

        // The converter checks if "usd-jpy" is cached.
        $cacheMock->shouldReceive('has')
            ->once()
            ->with('usd-jpy')
            ->andReturn(false);

        // Not supported => result is 0, and then it calls cache()->put("usd-jpy", 0, ...)
        $cacheMock->shouldReceive('put')
            ->once()
            ->with('usd-jpy', 0, \Mockery::type(\Illuminate\Support\Carbon::class));

        // Fake a successful response but missing the "jpy" key
        Http::fake([
            'cdn.jsdelivr.net/*' => Http::response([
                'usd' => [
                    // no 'jpy' here
                ]
            ], 200),
        ]);

        $converted = CurrencyConverter::convert(100, 'usd', 'jpy');
        $this->assertEquals(0, $converted, 'Expected zero when currency is not supported in response.');
    }
}