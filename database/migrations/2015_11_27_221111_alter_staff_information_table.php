<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStaffInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('staff_information', function(Blueprint $table)
		{
			//
			$table->integer('secondary_autotransfusionist_id')->nullable()->unsigned()->change();
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
			//
			$table->integer('secondary_autotransfusionist_id')->unsigned()->change();
		});
	}

}
