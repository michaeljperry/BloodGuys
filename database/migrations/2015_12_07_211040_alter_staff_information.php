<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStaffInformation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('staff_information', function(Blueprint $table)
		{
			// Make anesthesiologist nullable
			$table->integer('anesthesiologist_id')->nullable()->unsigned()->change();
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
			$table->integer('anesthesiologist_id')->unsigned()->change();
		});
	}

}
