<?php

namespace Database\Factories;

use App\Models\CourseQuizQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseQuizQuestionOption>
 */
class CourseQuizQuestionOptionFactory extends Factory
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
            'is_correct' => $this->faker->boolean,
            'course_quiz_question_id' => CourseQuizQuestion::factory(),
        ];
    }
}
