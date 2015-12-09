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
    protected $fillable = ['name', 'state', 'anticoagulent_volume'];
    
    public function invoice()
    {
        return $this->hasMany('App\Models\Invoice');
    }
}
