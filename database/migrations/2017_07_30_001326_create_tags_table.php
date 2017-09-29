<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug',255)->nullable();
            $table->tinyInteger('status')->default(1);
	        $table->unsignedInteger('menu_thumbnail_id')->nullable();
	        $table->foreign('menu_thumbnail_id')->references('id')->on('media');
	        $table->unsignedInteger('thumbnail_id')->nullable();
	        $table->foreign('thumbnail_id')->references('id')->on('media');
	        $table->tinyInteger('is_menu')->default(0);
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
        Schema::dropIfExists('tags');
    }
}
