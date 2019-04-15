<?php

use Illuminate\Database\Seeder;

class College_courseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('college_courses')->insert([
            'college_id' => 1,
            'course_id' => 1,
        ]);

        DB::table('college_courses')->insert([
            'college_id' => 1,
            'course_id' => 2,
        ]);

        DB::table('college_courses')->insert([
            'college_id' => 1,
            'course_id' => 3,
        ]);

        DB::table('college_courses')->insert([
            'college_id' => 2,
            'course_id' => 2,
        ]);

        DB::table('college_courses')->insert([
            'college_id' => 3,
            'course_id' => 1,
        ]);
    }
}
