<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->longText('post_content');
            $table->text('post_title');
            $table->text('post_except');
            $table->longText('post_content_filtered');
            $table->string('post_type');
            $table->string('post_mime_type');
            $table->text('post_slug');
            $table->string('comment_status');
            $table->bigInteger('comment_count');
            $table->enum('post_status',['published','draft','trashed']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
