<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalInformation extends Model {

	//Tell Eloquent to use a different table
	protected $table = 'hospital_information';
	
	// Tell Eloquent which attributes are fillable
	protected $fillable = ['hospital_id', 'invoice_id'];
}
