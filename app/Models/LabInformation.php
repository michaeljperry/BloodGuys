<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabInformation extends Model {

	//Tell Eloquent to use a different table
	protected $table = 'lab_information';
	
	// Tell Eloquent which attributes are fillable
	protected $fillable = ['pre_op_hematocrit', 'date_taken', 'invoice_id'];

}
