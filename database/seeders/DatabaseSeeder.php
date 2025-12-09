<?php

namespace Database\Seeders;

use App\Models\Chirp;
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
        // User::factory(10)->create();
        Chirp::factory(20)->create([
            'user_id' => User::factory(),
            'message' => fake()->sentence(),
            'image' => null,
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ]);


        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Chirp::factory(10)
            ->recycle($admin)
            ->create();
    }
}
