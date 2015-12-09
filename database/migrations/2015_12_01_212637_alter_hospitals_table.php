<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHospitalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hospitals', function(Blueprint $table)
		{
			// Drop columns that are not needed
			$table->dropColumn('street_address');
			$table->dropColumn('street_address_2');
			$table->dropColumn('zip_code');
			
			// Add Anti-Coagulent Volume field
			$table->integer('anticoagulent_volume')->after('state');
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
			// Drop newly added field
			$table->dropColumn('anticoagulent_volume');
			
			// Add back previous columns
			$table->string('street_address', 100);
            $table->string('street_address_2', 100);
            $table->string('zip_code', 10);			
		});
	}

}
