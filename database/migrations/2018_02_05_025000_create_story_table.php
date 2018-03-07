<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->text('description')->nullable();
            $table->string('image',200);
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('author')->onUpdate('cascade')->onDelete('set null');
            $table->tinyInteger('status');
            $table->integer('view')->default(0);
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story');
    }
}
