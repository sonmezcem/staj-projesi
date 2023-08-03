<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
    protected $model = Student::class;

    public function definition(): array
    {

        return [
            'student_number' => fake()->randomNumber(),
            'internship_start_date' => fake()->dateTimeBetween('now', '+3 months'),
            'internship_end_date' => fake()->dateTimeBetween('+3 months','+6 months'),
            'user_id' => fake()->unique()->numberBetween(1, User::count()),
        ];
    }
}
