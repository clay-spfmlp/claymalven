<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('websites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('template_id')->nullable();
			$table->string('website_type');
			$table->integer('step')->default(1);
			$table->string('domain_option')->nullable();
			$table->string('domain')->nullable();
			$table->string('tld')->nullable();
			$table->string('epp_code')->nullable();
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
		Schema::drop('websites');
	}

}
