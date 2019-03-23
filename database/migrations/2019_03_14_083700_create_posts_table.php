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
            $table->longText('post_content')->nullable();
            $table->text('post_title')->nullable();
            $table->text('post_except')->nullable();
            $table->longText('post_content_filtered')->nullable();
            $table->string('post_type')->nullable();
            $table->string('post_mime_type')->nullable();
            $table->text('post_slug')->nullable();
            $table->string('comment_status')->nullable();
            $table->bigInteger('comment_count')->nullable();
            $table->enum('post_status',['published','draft','trashed'])->default('draft');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('posts')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
            $table->softDeletes();
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
