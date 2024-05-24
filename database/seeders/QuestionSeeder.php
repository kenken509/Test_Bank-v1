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
            'question'          => 'Who is known as the first woman programmer?',
            'type'              => 'text',
            'term'              => 'prelim',
            
            'subject_code_id'   => '1',
            'author_id'         => '1',
            'created_at'        => now(),
        ]);

        DB::table('questions')->insert([
            'question'          => 'Who is the father of accounting?',
            'type'              => 'text',
            'term'              => 'prelim',
            
            'subject_code_id'   => '5',
            'author_id'         => '1',
            'created_at'        => now(),
        ]);

        
        DB::table('questions')->insert([
            'question'          => 'What does CSS stand for?',
            'type'              => 'text',
            'term'              => 'mid-term',
            
            'subject_code_id'   => '1',
            'author_id'         => '1',
            'created_at'        => now(),
        ]);
    }
}
