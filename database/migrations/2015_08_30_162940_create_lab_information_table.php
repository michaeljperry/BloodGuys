<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lab_information', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('pre_op_hematocrit');
			$table->date('date_taken');
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
		Schema::drop('lab_information');
	}

}
