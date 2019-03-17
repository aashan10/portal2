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
            $table->unsignedBigInteger('post_author_id');
            $table->longText('post_content');
            $table->text('post_title');
            $table->text('post_except');
            $table->string('post_status');
            $table->longText('post_content_filtered');
            $table->string('post_type');
            $table->string('post_mime_type');
            $table->text('post_slug');
            $table->string('comment_status');
            $table->bigInteger('comment_count');
            $table->enum('post_status',['published','draft','trashed']);
            $table->foreign('post_author_id')->references('id')->on('users')->onDelete('cascade');
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
