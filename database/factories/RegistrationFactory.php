<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pillar_id' => \App\Models\Pillar::factory(),
            'project_id' => \App\Models\Project::factory(),
            'authToken' => bcrypt($this->faker->word),
        ];
    }
}
