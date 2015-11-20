<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcedureInformation extends Model {

	//Tell Eloquent to use a different table
	protected $table = 'procedure_information';
	
	// Tell Eloquent which attributes are fillable
	protected $fillable = ['procedure_date', 'physician_order', 'method_group', 'procedure', 'operation_start_time', 'collection_start_time', 'operation_end_time', 'wash_time', 'invoice_id'];

}
