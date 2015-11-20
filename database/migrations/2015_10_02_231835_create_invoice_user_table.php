<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('invoice_id')->unsigned();
			$table->integer('user_id')->unsigned();
			
			$table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invoice_user');
	}

}
