<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoices', function(Blueprint $table)
		{
			// Remove the next_step and last_step odbc_columns
			$table->dropColumn('next_step');
			$table->dropColumn('last_step');
			
			// Add po_number and special_notes
			$table->string('po_number', 20)->nullable()->after('hospital_id');
			$table->string('special_notes', 5000)->nullable()->after('po_number');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invoices', function(Blueprint $table)
		{
			// Drop po_number and special_notes
			$table->dropColumn('po_number');
			$table->dropColumn('speical_notes');
			
			// Add next_step and last_step
			$table->string('last_step');
			$table->string('next_step');
		});
	}

}
