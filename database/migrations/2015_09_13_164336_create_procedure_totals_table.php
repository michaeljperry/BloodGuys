<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureTotalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('procedure_totals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ebl_or');
			$table->integer('rbc_returned_or');
			$table->integer('wash_amount_or');
			$table->boolean('vc_or');
			$table->boolean('cc_or');
			
			$table->integer('ebl_po');
			$table->integer('rbc_returned_po');
			$table->integer('wash_amount_po');
			$table->boolean('vc_po');
			$table->boolean('cc_po');
			
			$table->integer('ebl_po2');
			$table->integer('rbc_returned_po2');
			$table->integer('wash_amount_po2');
			$table->boolean('vc_po2');
			$table->boolean('cc_po2');
			
			$table->integer('ebl_total');
			$table->integer('rbc_returned_total');
			$table->integer('wash_amount_total');
			
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
		Schema::drop('procedure_totals');
	}

}
