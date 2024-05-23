<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            'question'      => 'Who is known as the first woman programmer?',
            'type'          => 'text',
            'answer'        => 'Ada Lovelace',
            'department_id' => '1',
            'author_id'     => '1',
        ]);
    }
}
