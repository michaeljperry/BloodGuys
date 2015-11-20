<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientInformation extends Model {

	//Tell Eloquent to use a different table
	protected $table = 'patient_information';
	
	// Tell Eloquent which attributes are fillable
	protected $fillable = ['first_name', 'last_name', 'patient_number', 'medical_record_number', 'invoice_id'];

}
