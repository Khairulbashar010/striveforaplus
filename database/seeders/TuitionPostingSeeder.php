<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TuitionPosting;
use App\Models\User;
// Ensure the factory is imported
use Database\Factories\TuitionPostingFactory;

class TuitionPostingSeeder extends Seeder
{
    public function run()
    {
        $tutor = User::first();

        if ($tutor) {
            TuitionPosting::factory()->count(10)->create([
                'user_id' => $tutor->id,
            ]);
        }
    }
}