<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProcedureInformationSetTimesNull extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('procedure_information', function(Blueprint $table)
		{
			// Mark times as not required
            $table->time('operation_start_time')->nullable()->change();			
			$table->time('operation_end_time')->nullable()->change();
            $table->time('total_time')->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('procedure_information', function(Blueprint $table)
		{
			// Make times required.
            $table->time('operation_start_time')->change();			
			$table->time('operation_end_time')->change();
            $table->time('total_time')->change();
		});
	}

}
