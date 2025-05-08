<?php

namespace Database\Seeders;

use App\Models\User;
use CategorySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ever Jay Salanggo',
            'email' => 'everjay@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'Admin',
        ]);

    }
}
