<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name'];
    
    /**
    * Get all the professionals that belong to this profession.
    */
    public function professionals()
    {
        return $this->hasMany('App\Models\Professional');
    }
}
