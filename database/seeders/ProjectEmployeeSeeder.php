<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Project;

class ProjectEmployeeSeeder extends Seeder
{
    public function run()
    {
        Employee::factory()->count(10)->create();
        Project::factory()->count(5)->create();

        $roles = ['Developer', 'Designer', 'Manager'];

        Project::all()->each(function ($project) use ($roles) {
            $project->employees()->attach(
                Employee::inRandomOrder()->take(3)->pluck('id')->toArray(),
                ['role' => $roles[array_rand($roles)]]
            );
        });
    }
}
