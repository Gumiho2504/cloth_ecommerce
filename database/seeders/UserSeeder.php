<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->sequence([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('123'),
            'role' => \App\Enums\Role::ADMIN
        ])->create();
    }
}
