<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEqipmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('equipment', function(Blueprint $table)
		{
			$table->string('device_name', 50)->nullable()->change();
			$table->string('manufacturer', 50)->nullable()->change();
			$table->string('serial_number', 50)->nullable()->change();
			$table->boolean('self_test_passed')->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('equipment', function(Blueprint $table)
		{
			$table->string('device_name', 50)->change();
			$table->string('manufacturer', 50)->change();
			$table->string('serial_number', 50)->change();
			$table->boolean('self_test_passed')->change();
		});
	}

}
