<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnsToDecimal extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('procedure_totals', function(Blueprint $table)
		{
			//
            $table->decimal('ebl_or', 10, 2)->change();
			$table->decimal('rbc_returned_or', 10, 2)->change();
			$table->decimal('wash_amount_or', 10, 2)->change();
			
			$table->decimal('ebl_po', 10, 2)->change();
			$table->decimal('rbc_returned_po', 10, 2)->change();
			$table->decimal('wash_amount_po', 10, 2)->change();
			
			$table->decimal('ebl_po2', 10, 2)->change();
			$table->decimal('rbc_returned_po2', 10, 2)->change();
			$table->decimal('wash_amount_po2', 10, 2)->change();
			
			$table->decimal('ebl_total', 10, 2)->change();
			$table->decimal('rbc_returned_total', 10, 2)->change();
			$table->decimal('wash_amount_total', 10, 2)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('procedure_totals', function(Blueprint $table)
		{
			//
            $table->integer('ebl_or')->change();
			$table->integer('rbc_returned_or')->change();
			$table->integer('wash_amount_or')->change();
			
			$table->integer('ebl_po')->change();
			$table->integer('rbc_returned_po')->change();
			$table->integer('wash_amount_po')->change();
			
			$table->integer('ebl_po2')->change();
			$table->integer('rbc_returned_po2')->change();
			$table->integer('wash_amount_po2')->change();
			
			$table->integer('ebl_total')->change();
			$table->integer('rbc_returned_total')->change();
			$table->integer('wash_amount_total')->change();
		});
	}

}
