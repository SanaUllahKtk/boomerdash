<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migration for r_posts table
        Schema::create('r_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('r_category_id')->constrained('r_categories');
            $table->foreignId('user_id')->constrained('users');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('img')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('votes')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_posts');
    }
}
