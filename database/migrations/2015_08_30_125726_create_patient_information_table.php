<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient_information', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 1);
			$table->string('last_name', 60);
			$table->string('patient_number');
			$table->string('medical_record_number');			
			$table->integer('invoice_id')->unsigned();
			$table->timestamps();
						
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
		Schema::drop('patient_information');
	}

}
