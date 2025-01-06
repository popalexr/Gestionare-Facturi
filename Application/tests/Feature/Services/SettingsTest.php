<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use Mockery;
use App\Services\Settings;
use Illuminate\Support\Facades\Cache;
use App\Models\Settings as ModelSettings;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class SettingsTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_get_method_fetches_from_database_if_not_in_cache()
    {
        $mock = Mockery::mock('alias:App\Models\Settings');

        Cache::shouldReceive('has')
            ->once()
            ->with('settings_test_key')
            ->andReturn(false);

        Cache::shouldReceive('put')
            ->once()
            ->with('settings_test_key', 'db_value', 60 * 60 * 24);

        $mock->shouldReceive('where')
             ->once()
             ->with('key', 'test_key')
             ->andReturnSelf();

        $mock->shouldReceive('first')
             ->once()
             ->andReturn((object)['value' => 'db_value']);

        $result = Settings::getInstance()->get('test_key');

        $this->assertEquals('db_value', $result);
    }
}
