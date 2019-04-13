<?php

namespace Modules\Course\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
class CollegeCoursesSeedderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('college_courses')->insert([
            'college_id' => 1, 
            'course_id' => 1
        ]);
        DB::table('college_courses')->insert([
            'college_id' => 1, 
            'course_id' => 2
        ]);
        DB::table('college_courses')->insert([
            'college_id' => 1, 
            'course_id' => 3
        ]);
        DB::table('college_courses')->insert([
            'college_id' => 1, 
            'course_id' => 4
        ]);
        DB::table('college_courses')->insert([
            'college_id' => 2, 
            'course_id' => 1
        ]);
        DB::table('college_courses')->insert([
            'college_id' => 2, 
            'course_id' => 2
        ]);
        DB::table('college_courses')->insert([
            'college_id' => 2, 
            'course_id' => 3
        ]);
        DB::table('college_courses')->insert([
            'college_id' => 2, 
            'course_id' => 4
        ]);
        // $this->call("OthersTableSeeder");
    }
}
