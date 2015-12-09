<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHosptials extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hospitals', function(Blueprint $table)
		{
			// Drop the city column
			$table->dropColumn('city');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hospitals', function(Blueprint $table)
		{
			// Add the city column 
			$table->string('city', 100);
		});
	}

}
