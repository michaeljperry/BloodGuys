<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model {

	protected $table = "equipment";	
	
	protected $fillable = ['device_name', 'manufacturer', 'serial_number', 'self_test_passed', 'invoice_id'];
}
