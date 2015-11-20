<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('procedure_information', function(Blueprint $table)
		{
			$table->increments('id');			
			$table->boolean('physician_order');
			$table->integer('method_group');
			$table->string('procedure');
			$table->time('operation_start_time');
			$table->time('collection_start_time');
			$table->time('operation_end_time');
			$table->time('wash_time');
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
		Schema::drop('procedure_information');
	}

}
