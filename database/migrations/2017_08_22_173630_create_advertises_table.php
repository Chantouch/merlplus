<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->unsignedInteger('advertise_type_id', false)->nullable();
            $table->unsignedInteger('media_id', false)->nullable();
            $table->string('provider_name', 255)->nullable();
            $table->string('url')->nullable();
            $table->string('is_video')->default(false);
            $table->longText('tracking_code_large')->nullable();
            $table->longText('tracking_code_tablet')->nullable();
            $table->longText('tracking_code_mobile')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->foreign('advertise_type_id')->references('id')
                ->on('advertise_types')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertises');
    }
}
