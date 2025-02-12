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
        // Ensure you have some tutor users already in your users table.
        // You might create them manually or via a UserSeeder.
        // For demonstration, we'll assume at least one tutor exists.
        $tutor = User::first();

        if ($tutor) {
            TuitionPosting::factory()->count(10)->create([
                'user_id' => $tutor->id,
            ]);
        }
    }
}