<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_sections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('display_name', 30);
			$table->integer('process_step')->unique();
			$table->string('title', 30);
			$table->string('update_button_text', 30);
			$table->string('form_path');	
			$table->string('create_url', 50);	
			$table->string('edit_url', 50);
			$table->string('update_url', 50);
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
		Schema::drop('invoice_sections');
	}

}
