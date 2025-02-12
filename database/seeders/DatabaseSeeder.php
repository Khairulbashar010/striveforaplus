<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Khairul Bashar',
            'email' => 'test@bashar.com',
        ]);

        \App\Models\SchoolLevel::create(['name' => 'Primary']);
        \App\Models\SchoolLevel::create(['name' => 'Lower Secondary']);
        \App\Models\SchoolLevel::create(['name' => 'Upper Secondary']);

        $this->call(TuitionPostingSeeder::class);
    }
}
