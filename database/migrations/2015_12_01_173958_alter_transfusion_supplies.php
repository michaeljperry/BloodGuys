<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransfusionSupplies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transfusion_supplies', function(Blueprint $table)
		{
			// Add a total for the supplies table
			$table->decimal('supplies_total', 10, 2);
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transfusion_supplies', function(Blueprint $table)
		{
			// Drop the supplies total column
			$table->dropColumn('supplies_total');
		});
	}

}
