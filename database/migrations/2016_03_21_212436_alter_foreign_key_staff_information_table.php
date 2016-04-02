<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterForeignKeyStaffInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('staff_information', function(Blueprint $table)
		{
            // drop original foreign keys
            $table->dropForeign('staff_information_primary_autotransfusionist_id_foreign');
            $table->dropForeign('staff_information_secondary_autotransfusionist_id_foreign');
            
            // add new foreign keys
			$table->foreign('primary_autotransfusionist_id')->references('id')->on('users');
			$table->foreign('secondary_autotransfusionist_id')->references('id')->on('users');
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
			// drop original foreign keys
            $table->dropForeign('staff_information_primary_autotransfusionist_id_foreign');
            $table->dropForeign('staff_information_secondary_autotransfusionist_id_foreign');
            
            // add new foreign keys
			$table->foreign('primary_autotransfusionist_id')->references('id')->on('users');
			$table->foreign('secondary_autotransfusionist_id')->references('id')->on('users');
		});
	}

}
