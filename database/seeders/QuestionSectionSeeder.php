<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\QuestionSection::factory()->create([
            'name' => 'physics',
        ]);
        \App\Models\QuestionSection::factory()->create([
            'name' => 'chemistry',
        ]);
    }
}
