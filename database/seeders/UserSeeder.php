<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
            'phone' => '0123456789',
            'address' => 'Admin Street',
        ]);

        User::create([
            'name' => 'Customer User',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'customer',
            'phone' => '0987654321',
            'address' => 'Customer Lane',
        ]);
    }
}
