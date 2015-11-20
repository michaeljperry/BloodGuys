<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingInformation extends Model {

	//
	protected $table = 'processing_information';
	public $incrementing = false;
	protected $fillable = ['column_id', 'amount_processed', 'anticoagulant_volume', 'irrigation_volume', 'ebl', 'rbcs_salvaged', 'time', 'invoice_id'];
	
	protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query)
	{
		$query->where('column_id', '=', $this->column_id)->where('invoice_id', '=', $this->invoice_id);
		
		return $query;
	}
}
