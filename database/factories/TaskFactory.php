<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Lang;

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
            'name' => fake()->sentence(),
            'description' => fake()->text(),
            'status_id' => $this->chooseTaskStatus(),
        ];
    }

    protected function chooseTaskStatus()
    {
        $statusesList = [
            Lang::get('main.statuses_seed.new'),
            Lang::get('main.statuses_seed.in_work'),
            Lang::get('main.statuses_seed.testing'),
            Lang::get('main.statuses_seed.completed'),
        ];
        $status = rand(0, 3);
        return TaskStatus::firstWhere('name', $statusesList[$status]);
    }
}
