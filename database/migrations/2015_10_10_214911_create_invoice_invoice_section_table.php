<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceInvoiceSectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_invoice_section', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('invoice_id')->unsigned();
			$table->integer('invoice_section_id')->unsigned();
			$table->boolean('completed')->default(0);
			$table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
			$table->foreign('invoice_section_id')->references('id')->on('invoice_sections')->onDelete('cascade');
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
		Schema::drop('invoice_invoice_section');
	}

}
