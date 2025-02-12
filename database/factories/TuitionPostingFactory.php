<?php

namespace Database\Factories;

use App\Models\TuitionPosting;
use Illuminate\Database\Eloquent\Factories\Factory;

class TuitionPostingFactory extends Factory
{
    protected $model = TuitionPosting::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'school_level_id' => \App\Models\SchoolLevel::factory(),
            'subject' => $this->faker->word,
            'fee' => $this->faker->numberBetween(100, 1000),
            'max_students' => $this->faker->numberBetween(1, 30),
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
        ];
    }
}