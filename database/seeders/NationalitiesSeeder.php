<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'دمشق',
            'حلب',
            'حمص',
        ];

        foreach($names as $name)
            Nationality::firstOrCreate(['name' => $name], []);
    }
}
