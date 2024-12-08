<?php

namespace Tests\Feature\Clients;

use App\Models\User;
use App\Models\Clients;
use Mockery;
use Tests\TestCase;

class ClientDetailsControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        // Close mockery
        Mockery::close();

        parent::tearDown();
    }

    public function testGuestIsRedirectedToLogin(): void
    {
        // Since the route is protected by auth, guest should be redirected to login
        $response = $this->get(route('clients.details', ['id' => 1]));
        $response->assertRedirect(route('login'));
    }

    public function testLoggedInUserIsRedirectedWhenClientNotFound(): void
    {
        // Create a user (not using factory)
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        // Mock the Clients model to return null for find(9999)
        $mock = Mockery::mock('alias:App\Models\Clients');
        $mock->shouldReceive('find')->with(9999)->once()->andReturn(null);

        $response = $this->get(route('clients.details', ['id' => 9999]));

        // Since client not found, we expect redirect to clients.index
        $response->assertRedirect(route('clients.index'));
    }

    public function testLoggedInUserSeesClientDetailsWhenClientExists(): void
    {
        // Create a user without factories
        $user = User::create([
            'name' => 'Another Test User',
            'email' => 'another@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        // Create a mock client object. This can be a simple stdClass or a partial mock.
        $clientMock = new \stdClass;
        $clientMock->id = 123;
        $clientMock->name = 'Example Client';
        $clientMock->email = 'client@example.com';

        // Mock Clients::find() to return our $clientMock for the given id.
        $mock = Mockery::mock('alias:App\Models\Clients');
        $mock->shouldReceive('find')->with(123)->once()->andReturn($clientMock);

        $response = $this->get(route('clients.details', ['id' => 123]));

        $response->assertStatus(200);
        $response->assertViewIs('clients.clients-details');
        $response->assertViewHas('client', function ($viewClient) use ($clientMock) {
            return $viewClient->id === $clientMock->id
                && $viewClient->name === $clientMock->name
                && $viewClient->email === $clientMock->email;
        });
    }
}