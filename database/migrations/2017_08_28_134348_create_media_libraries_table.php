<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_libraries', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('filename');
	        $table->string('original_filename');
	        $table->string('mime_type');
            $table->string('url',200)->nullable();
            $table->string('title',255)->nullable();
            $table->string('caption',255)->nullable();
            $table->string('alt_text',200)->nullable();
            $table->string('size',100)->nullable();
            $table->string('width',100)->nullable();
            $table->string('height',100)->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('user_id', false)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('media_libraries');
    }
}
