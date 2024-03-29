<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRPostVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migration for r_post_votes table
        Schema::create('r_post_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('r_post_id')->constrained('r_posts');
            $table->foreignId('r_user_id')->constrained('users');
            $table->smallInteger('vote');
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
        Schema::dropIfExists('r_post_votes');
    }
}
