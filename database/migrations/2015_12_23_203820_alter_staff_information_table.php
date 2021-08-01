<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSurgeonIdNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('staff_information', function(Blueprint $table)
		{
			// Make surgeon id nullable
			$table->integer('surgeon_id')->nullable()->unsigned()->change();
		}); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('staff_information', function(Blueprint $table)
		{
			// Remove nullable property
			$table->integer('surgeon_id')->unsigned()->change();
		});
	}

}
