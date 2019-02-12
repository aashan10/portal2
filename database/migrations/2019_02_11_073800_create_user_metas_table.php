<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->timestamps();
            $table->string('key');
            $table->string('value');
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('icon')->nullable();
            $table->enum('type', ['text', 'number', 'email','tel', 'url','date', 'time'])->default('text');
            $table->string('description')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_meta');
    }
}
