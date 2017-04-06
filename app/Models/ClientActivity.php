<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class ClientActivity extends Model
{
    
    protected $table = "client_activity";

    protected $fillable = [
    	'name',
    	'client_id'
    ];


    public function client()
    {
    	return $this->belongsTo('MissVote\Models\Client','client_id');
    }

}
