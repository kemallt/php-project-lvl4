<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::create(['name' => 'новый']);
        TaskStatus::create(['name' => 'в работе']);
        TaskStatus::create(['name' => 'на тестировании']);
        TaskStatus::create(['name' => 'завершен']);
    }
}
