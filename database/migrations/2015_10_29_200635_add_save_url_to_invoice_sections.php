<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaveUrlToInvoiceSections extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoice_sections', function($table)
		{
			$table->string('save_url', 50)->after('update_url');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('invoice_sections', function($table)
		{
			$table->dropColumn('save_url');
		});
	}

}
