<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'title' => 'Bsc.Csit',
            'total_years' => 4,
            'is_semester_based' => 'yes',
            'total_semesters' => 8,
            'university' => 'Tribhuvan University',
            'description' => 'Gives detail knowledge about computer science'
        ]);


        DB::table('courses')->insert([
            'title' => 'BIT',
            'total_years' => 4,
            'is_semester_based' => 'yes',
            'total_semesters' => 8,
            'university' => 'British University',
            'description' => 'Gives detail knowledge about information technology'
        ]);

        DB::table('courses')->insert([
            'title' => 'BSW',
            'total_years' => 3,
            'is_semester_based' => 'no',
            'total_semesters' => 8,
            'university' => 'Tribhuvan University',
            'description' => 'Gives detail knowledge about Social WOrks'
        ]);
    }
}
