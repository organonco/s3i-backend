<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['username' => 'admin'], [
            'name' => 'Super Admin',
            'super_admin' => true,
            'password' => 'password',
        ]);

        User::firstOrCreate(['username' => 'teacher'], [
            'name' => 'Example Teacher',
            'super_admin' => false,
            'password' => 'password',
        ]);
    }
}
