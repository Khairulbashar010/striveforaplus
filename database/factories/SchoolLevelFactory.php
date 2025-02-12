<?php

namespace Database\Factories;

use App\Models\SchoolLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolLevelFactory extends Factory
{
    protected $model = SchoolLevel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Primary', 'Lower Secondary', 'Upper Secondary']),
        ];
    }
}