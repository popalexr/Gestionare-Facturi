<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Services::insert([
            [
                'name' => 'Web Hosting',
                'vat_id' => 1,
                'price' => 49.99,
                'currency' => 'eur',
                'description' => 'Premium web hosting package with unlimited bandwidth.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'SEO Optimization',
                'vat_id' => 2,
                'price' => 150.00,
                'currency' => 'usd',
                'description' => 'Professional SEO services to rank higher on search engines.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cloud Storage',
                'vat_id' => null,
                'price' => 20.00,
                'currency' => 'ron',
                'description' => 'Secure cloud storage for your files and documents.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
