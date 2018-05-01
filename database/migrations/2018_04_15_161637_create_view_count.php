<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_count', function (Blueprint $table) {
            $table->unsignedInteger('story_id')->unique();
            $table->foreign('story_id')->references('id')->on('story')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('day_view')->default(0);
            $table->integer('week_view')->default(0);
            $table->integer('month_view')->default(0);
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
