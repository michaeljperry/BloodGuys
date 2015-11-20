<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['first_name', 'last_name', 'profession_id'];
    
    /**
    * Get the profession this professional belongs too.
    */
    public function profession()
    {
        return $this->belongsTo('App\Models\Profession');
    }
    
    public function getFirstInitialLastName()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
}
