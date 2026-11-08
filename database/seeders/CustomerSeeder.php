<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Insert sample customers (same people as the TFA5 static array).
     */
    public function run(): void
    {
        $customers = [
            ['full_name' => 'Rosa Fernandez', 'email' => 'rosa.f@example.com',     'phone' => '0905-123-4567'],
            ['full_name' => 'Miguel Aquino',  'email' => 'miguel.a@example.com',   'phone' => '0906-234-5678'],
            ['full_name' => 'Tessa Navarro',  'email' => 'tessa.n@example.com',    'phone' => '0915-345-6789'],
            ['full_name' => 'Daniel Ocampo',  'email' => 'daniel.o@example.com',   'phone' => '0927-456-7890'],
            ['full_name' => 'Patricia Gomez', 'email' => 'patricia.g@example.com', 'phone' => '0935-567-8901'],
        ];

        // updateOrCreate keeps the seeder safe to run more than once.
        foreach ($customers as $customer) {
            Customer::updateOrCreate(['email' => $customer['email']], $customer);
        }
    }
}
