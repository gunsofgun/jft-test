<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // package_tests
        DB::table('package_tests')->insert([
            'package_name' => 'Paket A',
            'time_test' => 60,
        ]);
        DB::table('package_tests')->insert([
            'package_name' => 'Paket B',
            'time_test' => 60,
        ]);

        // Sections 1
        DB::table('sections')->insert([
            'section_name' => 'Script and Vocab',
            'section_code' => 'SV',
            'package_test_id' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Conversation and Expression',
            'section_code' => 'CE',
            'package_test_id' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Listening Comprehension',
            'section_code' => 'LC',
            'package_test_id' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Reading Comprehension',
            'section_code' => 'RC',
            'package_test_id' => 1,
        ]);

        // Sections 2
        DB::table('sections')->insert([
            'section_name' => 'Script and Vocab',
            'section_code' => 'SV',
            'package_test_id' => 2,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Conversation and Expression',
            'section_code' => 'CE',
            'package_test_id' => 2,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Listening Comprehension',
            'section_code' => 'LC',
            'package_test_id' => 2,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Reading Comprehension',
            'section_code' => 'RC',
            'package_test_id' => 2,
        ]);
    }
}
