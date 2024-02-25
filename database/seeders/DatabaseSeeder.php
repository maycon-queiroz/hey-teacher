<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Question, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name'  => 'Maycon Queiroz',
            'email' => 'maycon@example.com',
        ]);

        Question::factory()->count(10)->for($user, 'createdBy')->create();
        Question::factory()->count(15)->create(['draft' => false]);
    }
}
