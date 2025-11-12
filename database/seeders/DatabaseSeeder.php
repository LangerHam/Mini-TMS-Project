<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 employees
        $employees = Employee::factory(10)->create();

        // Create 30-50 tasks and assign them to random employees
        foreach ($employees as $employee) {
            // Each employee gets 3-5 tasks
            Task::factory(rand(3, 5))->create([
                'employee_id' => $employee->id,
            ]);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Created ' . Employee::count() . ' employees');
        $this->command->info('Created ' . Task::count() . ' tasks');
    }
}
