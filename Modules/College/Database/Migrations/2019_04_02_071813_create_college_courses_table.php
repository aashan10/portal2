<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('college_id');
            $table->unsignedInteger('course_id');
            $table->foreign('college_id')->references('id')->on('colleges');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('college_courses');
    }
}
