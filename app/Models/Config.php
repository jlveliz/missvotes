<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = "config";

    protected $primaryKey = "id";

    protected $fillable = [
    	'key',
    	'user_id_created',
    	'payload'
    ];


    public function setPayload($value)
    {
    	return $this->attributes['payload'] = serialize($value);
    }

    public function getPayload($value)
    {
    	return unserialize($vaue);
    }

    public function user($value='')
    {
    	return $this->belongsTo('MissVote\Models\User','user_id_created');
    }
}
