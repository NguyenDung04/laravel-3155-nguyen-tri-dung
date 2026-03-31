<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Lập trình Web',
                'Cấu trúc dữ liệu',
                'Cơ sở dữ liệu',
                'Trí tuệ nhân tạo',
                'Hệ điều hành'
            ]),
            'credits' => fake()->numberBetween(2, 4),
        ];
    }
}
