<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Insert sample users (same people as the TFA5 static array).
     */
    public function run(): void
    {
        $users = [
            ['username' => 'owner',   'full_name' => 'Elena Cruz'],
            ['username' => 'front1',  'full_name' => 'Marco Diaz'],
            ['username' => 'front2',  'full_name' => 'Hannah Tan'],
            ['username' => 'supv',    'full_name' => 'Felix Salazar'],
            ['username' => 'storage', 'full_name' => 'Joy Pascual'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['username' => $user['username']], $user);
        }
    }
}
