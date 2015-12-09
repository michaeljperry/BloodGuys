<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLabInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lab_information', function(Blueprint $table)
		{
			//
			$table->decimal('pre_op_hematocrit')->nullable()->change();
			$table->date('date_taken')->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('lab_information', function(Blueprint $table)
		{
			//
			$table->decimal('pre_op_hematocrit')->change();
			$table->date('date_taken')->change();
		});
	}

}
