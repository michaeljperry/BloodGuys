<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfusionSuppliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transfusion_supplies', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('wash_kit_manufacturer', 50);
			$table->string('wash_kit_product_id_number', 50);
			$table->integer('wash_kit_quantity');
			$table->decimal('wash_kit_charge', 10, 2);
			$table->decimal('wash_kit_total', 19, 2);
			
			$table->string('reservoir_manufacturer', 50);
			$table->string('reservoir_product_id_number', 50);
			$table->integer('reservoir_quantity');
			$table->decimal('reservoir_charge', 10, 2);
			$table->decimal('reservoir_total', 19, 2);
			
			$table->string('aspiration_assembly_manufacturer', 50);
			$table->string('aspiration_assembly_product_id_number', 50);
			$table->integer('aspiration_assembly_quantity');
			$table->decimal('aspiration_assembly_charge', 10, 2);
			$table->decimal('aspiration_assembly_total', 19, 2);
			
			$table->string('blood_bag_manufacturer', 50);
			$table->string('blood_bag_product_id_number', 50);
			$table->integer('blood_bag_quantity');
			$table->decimal('blood_bag_charge', 10, 2);
			$table->decimal('blood_bag_total', 19, 2);
			
			$table->string('vacuum_tubing_manufacturer', 50);
			$table->string('vacuum_tubing_product_id_number', 50);
			$table->integer('vacuum_tubing_quantity');
			$table->decimal('vacuum_tubing_charge', 10, 2);
			$table->decimal('vacuum_tubing_total', 19, 2);
			
			$table->string('wound_drain_manufacturer', 50);
			$table->string('wound_drain_product_id_number', 50);
			$table->integer('wound_drain_quantity');
			$table->decimal('wound_drain_charge', 10, 2);
			$table->decimal('wound_drain_total', 19, 2);
			
			$table->string('y_connector_manufacturer', 50);
			$table->string('y_connector_product_id_number', 50);
			$table->integer('y_connector_quantity');
			$table->decimal('y_connector_charge', 10, 2);
			$table->decimal('y_connector_total', 19, 2);
			
			$table->string('blood_filter_manufacturer', 50);
			$table->string('blood_filter_product_id_number', 50);
			$table->integer('blood_filter_quantity');
			$table->decimal('blood_filter_charge', 10, 2);
			$table->decimal('blood_filter_total', 19, 2);
			
			$table->string('acda_bag_manufacturer', 50);
			$table->string('acda_bag_product_id_number', 50);
			$table->integer('acda_bag_quantity');
			$table->decimal('acda_bag_charge', 10, 2);
			$table->decimal('acda_bag_total', 19, 2);
			
			$table->string('misc_manufacturer', 50);
			$table->string('misc_product_id_number', 50);
			$table->integer('misc_quantity');
			$table->decimal('misc_charge', 10, 2);
			$table->decimal('misc_total', 19, 2);
			
			$table->integer('invoice_id')->unsigned();
			$table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
					
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transfusion_supplies');
	}

}
