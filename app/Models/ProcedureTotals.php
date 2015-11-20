<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcedureTotals extends Model {

	//Tell Eloquent to use a different table
	protected $table = 'procedure_totals';
	
	// Tell Eloquent which columns to gurad
	protected $guarded = ['id'];
}
