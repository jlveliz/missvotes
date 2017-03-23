<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class Miss extends Model
{
    
    protected $table = "miss";

    protected $with = ['photos'];

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'last_name', 
        'country_id',
        'height',
        'bust_measure',
        'waist_measure',
        'hip_measure',
        'hobbies',
        'state'
    ];


    public function country()
    {
    	return $this->belongsTo('MissVote\Models\Country','country_id');
    }

    public function photos()
    {
      return $this->hasMany('MissVote\Models\MissPhoto','miss_id');
    }
}
