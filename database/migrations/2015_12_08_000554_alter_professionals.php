<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProfessionals extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('professionals', function(Blueprint $table)
		{
			// Make first name optional
			 $table->string('first_name', 50)->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('professionals', function(Blueprint $table)
		{
			// Require first name
			$table->string('first_name', 50)->change();
		});
	}

}
