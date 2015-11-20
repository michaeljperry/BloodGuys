<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffInformation extends Model {

	//Tell Eloquent to use a different table
	protected $table = 'staff_information';
	
	// Tell Eloquent which attributes are fillable
	protected $fillable = ['anesthesiologist_id', 'primary_autotransfusionist_id', 'secondary_autotransfusionist_id', 'surgeon_id', 'invoice_id'];

}
