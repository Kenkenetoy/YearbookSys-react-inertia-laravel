<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import the User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed some users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),  // Hash the password
            'status' => 'pending', // Add a status for your users
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password123'),
            'status' => 'approved',
        ]);

        User::create([
            'name' => 'Samuel Jackson',
            'email' => 'samuel@example.com',
            'password' => bcrypt('password123'),
            'status' => 'pending',
        ]);
    }
}
