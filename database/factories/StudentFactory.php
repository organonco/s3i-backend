<?php

namespace Database\Factories;

use App\Models\EducationLevel;
use App\Models\Nationality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => $this->faker->randomNumber(8),
            'password' => '12345678',
            'name_en' => $this->faker->name,
            'name_ar' => 'حسن حسين',
            'email' => $this->faker->email,
            'date_of_birth' => $this->faker->date,
            'nationality_id' => Nationality::factory(),
            'education_level_id' => EducationLevel::factory(),
            'address' => $this->faker->text,
            'reference' => $this->faker->text
        ];
    }
}
