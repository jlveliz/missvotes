<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Config extends Model
{
    protected $table = "config";

    protected $primaryKey = "id";

    protected $fillable = [
    	'key',
    	'user_id_created',
    	'payload'
    ];


    public function setPayloadAttribute($value)
    {
    	$this->attributes['payload'] = serialize($value);
    }

    public function getPayloadAttribute($value)
    {
    	return unserialize($value);
    }

    public function user($value='')
    {
    	return $this->belongsTo('MissVote\Models\User','user_id_created');
    }

    public function countries()
    {
        return $this->hasMany('MissVote\Models\Country','casting_id');
    }

    public static function boot(){
        parent::boot();

        static::creating(function($config){
            $config->user_id_created = Auth::user()->id;
        });
    }
}
