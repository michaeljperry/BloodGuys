<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_information', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('anesthesiologist_id')->unsigned();
			$table->integer('primary_autotransfusionist_id')->unsigned();
			$table->integer('secondary_autotransfusionist_id')->unsigned();
			$table->integer('surgeon_id')->unsigned();
			$table->integer('invoice_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('anesthesiologist_id')->references('id')->on('professionals');
			$table->foreign('primary_autotransfusionist_id')->references('id')->on('professionals');
			$table->foreign('secondary_autotransfusionist_id')->references('id')->on('professionals');
			$table->foreign('surgeon_id')->references('id')->on('professionals');
			$table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('staff_information');
	}

}
