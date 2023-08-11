<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Business::class;

    public function definition(): array
    {
        return [
            'business_name' => fake()->company,
            'business_address' => fake()->address,
            'business_phone' => "5955318548",
            'quota' => fake()->numberBetween(1,9),
            'applicants' => fake()->numberBetween(1,3),
            'status' => fake()->boolean
        ];
    }
}
