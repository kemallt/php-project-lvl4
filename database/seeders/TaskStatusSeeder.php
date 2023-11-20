<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Lang;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::create(['name' => Lang::get('main.statuses_seed.new')]);
        TaskStatus::create(['name' => Lang::get('main.statuses_seed.in_work')]);
        TaskStatus::create(['name' => Lang::get('main.statuses_seed.testing')]);
        TaskStatus::create(['name' => Lang::get('main.statuses_seed.completed')]);
    }
}
