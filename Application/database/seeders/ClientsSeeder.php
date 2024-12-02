<?php

namespace Database\Seeders;

use App\Models\Clients;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clients::insert([
            [
                'name' => 'John Doe',
                'client_type' => 'company',
                'cui' => '123-456-7890',
                'country' => 'Romania',
                'county' => 'Ilfov',
                'city' => 'Bucharest',
                'address' => 'Str. Example, Nr. 1',
            ],
            [
                'name' => 'Jane Smith',
                'client_type' => 'individual',
                'cui' => '987-654-3210',
                'country' => 'Romania',
                'county' => 'Ilfov',
                'city' => 'Bucharest',
                'address' => 'Str. Example, Nr. 1',
            ],
            [
                'name' => 'Alice Johnson',
                'client_type' => 'company',
                'cui' => '555-123-4567',
                'country' => 'Romania',
                'county' => 'Ilfov',
                'city' => 'Bucharest',
                'address' => 'Str. Example, Nr. 1',
            ],
        ]);
    }
}
