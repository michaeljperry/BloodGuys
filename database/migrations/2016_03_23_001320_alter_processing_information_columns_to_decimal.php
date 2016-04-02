<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProcessingInformationColumnsToDecimal extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('processing_information', function(Blueprint $table)
		{
			//
            $table->decimal('amount_processed', 10,2)->change();
			$table->decimal('anticoagulent_volume', 10,2)->change();
			$table->decimal('irrigation_volume', 10,2)->change();
			$table->decimal('ebl', 10,2)->change();
			$table->decimal('rbcs_salvaged', 10,2)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('processing_information', function(Blueprint $table)
		{
			//
            $table->integer('amount_processed')->change();
			$table->integer('anticoagulent_volume')->change();
			$table->integer('irrigation_volume')->change();
			$table->integer('ebl')->change();
			$table->integer('rbcs_salvaged')->change();
		});
	}

}
