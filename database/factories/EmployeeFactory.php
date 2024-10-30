<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = \App\Models\Employee::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'position' => $this->faker->jobTitle(),
        ];
    }
}
