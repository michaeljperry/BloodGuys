<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfusionServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transfusion_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('basic_service_quantity');
			$table->decimal('basic_service_charge', 10, 2);
			$table->decimal('basic_service_total', 10, 2);
			$table->integer('modified_service_quantity');
			$table->decimal('modified_service_charge', 10, 2);
			$table->decimal('modified_service_total', 10, 2);
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
		Schema::drop('transfusion_services');
	}

}
