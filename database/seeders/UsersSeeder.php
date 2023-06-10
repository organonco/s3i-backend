<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'super_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Example Teacher',
            'username' => 'teacher',
            'super_admin' => false,
        ]);
    }
}
