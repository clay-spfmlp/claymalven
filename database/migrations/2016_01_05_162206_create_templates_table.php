<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('templates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('website_type');
			$table->text('description')->nullable();
			$table->string('preview_thumbnail');
			$table->string('path');
			$table->integer('color_scheme_id')->default('1');
			$table->integer('use_count')->default('0');
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
		Schema::drop('templates');
	}

}
