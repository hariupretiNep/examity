<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin Admin',
            'email' => 'admin@examity.com',
        ]);

        $this->call([
            StudentSeeder::class,
            QuestionSectionSeeder::class,
            QuestionSeeder::class,
            AnswerOptionSeeder::class,
            AnswerSeeder::class
        ]);
    }
}
