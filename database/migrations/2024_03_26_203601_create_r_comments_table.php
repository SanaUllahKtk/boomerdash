<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migration for r_comments table
        Schema::create('r_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('r_posts');
            $table->foreignId('user_id')->constrained('users');
            $table->text('description');
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
        Schema::dropIfExists('r_comments');
    }
}
