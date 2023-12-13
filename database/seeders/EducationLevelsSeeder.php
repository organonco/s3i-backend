<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;

class EducationLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'دكتوراه',
            'ماجستير',
            'دبلوم',
            'بكلوريوس',
            'معهد',
            'بكلوريا علمي',
            'بكلوريا ادبي',
            'بكلوريا تجاري',
            'بكلوريا معلوماتية',
            'بكلوريا صناعي',
            'تاسع',
            'غير ذلك',
        ];

        foreach ($names as $name)
            EducationLevel::firstOrCreate(['name' => $name], []);
    }
}
