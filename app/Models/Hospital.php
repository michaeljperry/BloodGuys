<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name', 'street_address', 'street_address_2', 'city', 'zip_code', 'state'];
    
    public function invoice()
    {
        return $this->hasMany('App\Models\Invoice');
    }
}
