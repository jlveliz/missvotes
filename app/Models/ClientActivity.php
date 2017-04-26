<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class ClientActivity extends Model
{
    
    protected $table = "client_activity";

    protected $fillable = [
    	'client_id',
    	'name',
    	'params'
    ];

    public function getParamsAttribute($value)
    {
        return unserialize($value);
    }


    public function client()
    {
    	return $this->belongsTo('MissVote\Models\Client','client_id');
    }

}
