<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TaskStatusSeeder::class,
        ]);

        User::factory(5)
            ->has(Task::factory(3), 'createdTasks')
            ->create();

        Task::all()->map(function ($task) {
            $task->assigned_to_id = User::all()->random()->id;
            $task->save();
        });
    }
}
