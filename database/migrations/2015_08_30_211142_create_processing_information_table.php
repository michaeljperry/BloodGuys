<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessingInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('processing_information', function(Blueprint $table)
		{			
			$table->integer('column_id')->unsigned();
			$table->integer('amount_processed');
			$table->integer('anticoagulent_volume');
			$table->integer('irrigation_volume');
			$table->integer('ebl');
			$table->integer('rbcs_salvaged');
			$table->time('time');
			$table->integer('invoice_id')->unsigned();
			$table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
			$table->timestamps();
			
			$table->primary(array('column_id', 'invoice_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('processing_information');
	}

}
