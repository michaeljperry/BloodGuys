<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceFile extends Model {

	// The values that can be updated through the application
	protected $fillable = ['filename', 'invoice_id'];

}
