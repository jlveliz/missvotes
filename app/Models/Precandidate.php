<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;
use MissVote\Scopes\PrecandidateScope;


class Precandidate extends Model
{
    
    protected $table = "miss";

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
        'is_precandidate',
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
        'weight_type_measure'
    ];


     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PrecandidateScope);
    }


    public function country()
    {
    	return $this->belongsTo('MissVote\Models\Country','country_id');
    }
}
