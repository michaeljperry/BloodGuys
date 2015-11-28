<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProcedureInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('procedure_information', function(Blueprint $table)
		{
			// Change fields to be nullable
			$table->time('collection_start_time')->nullable()->change();
			$table->time('wash_time')->nullable()->change();
			
			// Add total time field
			$table->time('total_time')->after('operation_end_time');
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
			// Drop total time
			$table->dropColumn('total_time');
			
			// Change fields to be required
			$table->time('collection_start_time')->change();
			$table->time('wash_time')->change();
		});
	}

}
