<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('procedure_date');
			$table->string('last_step');
			$table->string('next_step');
			$table->boolean('completed');
			$table->integer('hospital_id')->unsigned();
			$table->string('created_by');
			$table->string('last_modified_by');			
			$table->timestamps();
			
			// add foreign key to hospital
			$table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invoices');
	}

}
