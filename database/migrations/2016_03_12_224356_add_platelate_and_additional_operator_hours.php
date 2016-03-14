<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlatelateAndAdditionalOperatorHours extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transfusion_services', function(Blueprint $table)
		{
			//$table->decimal('modified_service_total', 10, 2);
            $table->integer('additional_operator_hours')->default(0)->after('modified_service_total');
			$table->decimal('additional_operator_hours_charge', 10, 2)->default(0.00)->after('additional_operator_hours');
			$table->decimal('additional_operator_hours_total', 10, 2)->default(0.00)->after('additional_operator_hours_charge');
            
            $table->integer('platelate_gel_service_quantity')->default(0)->after('additional_operator_hours_total');
			$table->decimal('platelate_gel_service_charge', 10, 2)->default(0.00)->after('platelate_gel_service_quantity');
			$table->decimal('platelate_gel_service_total', 10, 2)->default(0.00)->after('platelate_gel_service_charge');
            
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transfusion_services', function(Blueprint $table)
		{
			$table->dropColumn('additional_operator_hours');
            $table->dropColumn('additional_operator_hours_charge');
            $table->dropColumn('additional_operator_hours_total');
            $table->dropColumn('platelate_gel_service_quantity');
            $table->dropColumn('platelate_gel_service_charge');
            $table->dropColumn('platelate_gel_service_total');
		});
	}

}
