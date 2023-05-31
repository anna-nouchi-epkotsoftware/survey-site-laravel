<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HousingLoanChart>
 */
class HousingLoanChartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'usage_situation' => Arr::random([1,2,3]),
            'financial_institution1' => Arr::random([0,1]),
            'financial_institution2' => Arr::random([0,1]),
            'financial_institution3' => Arr::random([0,1]),
            'financial_institution4' => Arr::random([0,1]),
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
