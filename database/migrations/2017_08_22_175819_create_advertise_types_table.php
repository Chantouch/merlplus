<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertiseTypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertise_types', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name',255)->nullable();
			$table->string('slug')->nullable();
			$table->tinyInteger('active')->default(0);
			$table->string('width')->nullable();
			$table->string('height')->nullable();
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
		Schema::dropIfExists('advertise_types');
	}
}
