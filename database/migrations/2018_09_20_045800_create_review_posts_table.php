<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->date('date');
            $table->string('status');
            $table->string('voting_helpful');
            $table->string('rating');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('post_id');
            // $table->foreign('user_id')
            // ->references('id')->on('users')
            // ->onDelete('cascade');
            // $table->foreign('teacher_id')
            // ->references('id')->on('teachers')
            // ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('review_posts');
    }
}
