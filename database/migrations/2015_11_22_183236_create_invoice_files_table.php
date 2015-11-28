<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_files', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('filename', 150);
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
		Schema::drop('invoice_files');
	}

}
