<?php

namespace Database\Factories;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id'=> $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'body' => $this->faker->paragraph(),
            'completed' => $this->faker->boolean(),
            'importance' => $this->faker->randomElement(['high', 'low', 'average']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
    }
}
