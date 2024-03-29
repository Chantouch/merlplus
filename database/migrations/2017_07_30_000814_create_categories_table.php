<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug',255)->nullable();
            $table->unsignedInteger('parent_id', false)->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('color_id')->default(1)->nullable();
            $table->integer('position_order')->default(0)->nullable();
            $table->unsignedInteger('thumbnail_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('thumbnail_id')->references('id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
