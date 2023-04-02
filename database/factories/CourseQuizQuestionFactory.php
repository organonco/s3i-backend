<?php

namespace Database\Factories;

use App\Enums\CourseQuizQuestionTypes;
use App\Models\CourseQuiz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseQuizQuestion>
 */
class CourseQuizQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->sentence(4),
            'type' => $this->faker->randomElement(CourseQuizQuestionTypes::cases()),
            'course_quiz_id' => CourseQuiz::factory(),
        ];
    }
}
