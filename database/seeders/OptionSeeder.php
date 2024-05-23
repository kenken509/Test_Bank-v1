<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // question 1
        DB::table('options')->insert([
            'option' => 'Grace Hopper',
            'question_id' => '1'
        ]);

        DB::table('options')->insert([
            'option' => 'Ada Lovelace',
            'question_id' => '1'
        ]);

        DB::table('options')->insert([
            'option' => 'Anita Borg',
            'question_id' => '1'
        ]);

        DB::table('options')->insert([
            'option' => 'Katherine Johnson',
            'question_id' => '1'
        ]);
    }
}
