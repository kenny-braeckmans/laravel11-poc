<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'keyword' => $this->faker->unique()->word,
            'startDate' => $this->faker->date(),
            'duration' => $this->faker->numberBetween(1, 52),
            'administrator_id' => \App\Models\Administrator::factory(),
            'beneficiary_id' => \App\Models\Beneficiary::factory(),
        ];
    }
}
