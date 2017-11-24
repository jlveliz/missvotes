<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;
use MissVote\Scopes\MissScope;


class Miss extends Model
{
    
    protected $table = "miss";

    // protected $with = ['photos'];

    protected $perPage = 12;

    private $isPrecandidate = 0;



      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'last_name',
        'code',
        'slug', 
        'country_id',
        'state',
        'birthdate',
        'placebirth',
        'email',
        'phone_number',
        'how_did_you_hear_about_us',
        'height',
        'weight',
        'address',
        'city',
        'state_province',
        'bust_measure',
        'waist_measure',
        'hip_measure',
        'hair_color',
        'eye_color',
        'dairy_philosophy',
        'why_would_you_win',
        'height_type_measure',
        'weight_type_measure',
        'applicant_face_photo',
        'applicant_body_photo'
    ];


     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new MissScope);
    }


    public function country()
    {
    	return $this->belongsTo('MissVote\Models\Country','country_id');
    }

    public function photos()
    {
      return $this->hasMany('MissVote\Models\MissPhoto','miss_id');
    }
}
