<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseItem>
 */
class CourseItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $morphClasses = [CourseSection::class];
        $morphClass = $this->faker->randomElement($morphClasses);
        return [
            'course_id' => Course::factory(),
            'item_id' => $morphClass::factory(),
            'item_type' => $morphClass,
        ];
    }
}
