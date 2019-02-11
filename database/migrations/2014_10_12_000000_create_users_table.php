<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->timestamps();
            $table->rememberToken();
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->string('provider_token')->nullable();
            $table->string('provider_user_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('provider_refresh_token')->nullable();
            $table->string('provider')->default('default');
            $table->enum('status',['pending','active','suspended'])->default('pending');
        });
    }

/**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
