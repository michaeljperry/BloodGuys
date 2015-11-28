<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model 
{
	// The values that can be updated through the application.
	protected $fillable = ['procedure_date', 'po_number', 'special_notes', 'completed', 'hospital_id', 'created_by', 'last_modified_by'];

	// Gets the hospital associated with this invoice.
	public function hospital()
	{
		return $this->belongsTo('App\Models\Hospital');
	}
	
	public function staffInformation()
	{
		return $this->hasOne('App\Models\StaffInformation');
	}
	
	public function patientInformation()
	{
		return $this->hasOne('App\Models\PatientInformation');
	}
	
	public function procedureInformation()
	{
		return $this->hasOne('App\Models\ProcedureInformation');	
	}
	
	public function labInformation()
	{
		return $this->hasOne('App\Models\LabInformation');
	}
	
	public function processingInformation()
	{
		return $this->hasMany('App\Models\ProcessingInformation');
	}
	
	public function procedureTotals()
	{
		return $this->hasOne('App\Models\ProcedureTotals');
	}
	
	public function equipment()
	{
		return $this->hasOne('App\Models\Equipment');
	}
	
	public function transfusionServices()
	{
		return $this->hasOne('App\Models\TransfusionServices');
	}
	
	public function transfusionSupplies()
	{
		return $this->hasOne('App\Models\TransfusionSupplies');
	}
	
	public function invoiceSections()
	{
		return $this->belongsToMany('App\Models\InvoiceSection')->withPivot('completed');
	}
	
	public function invoiceFiles()
	{
		return $this->hasMany('App\Models\InvoiceFile');
	}
}
