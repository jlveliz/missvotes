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

    //states of miss
    const FORRATING = 0;
    const PRESELECTED = 1;
    const NOPRESELECTED = 2;
    const PRECANDIDATE = 3;
    const DISQUALIFIEDPRECANDIDATE = 4;
    const MISS = 5;
    const DISQUALIFIEDMISS = 6;



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

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    
    public function getFormattedHowDidYouHearAboutUs()
    {
        $string = preg_replace("/_/i", ' ', $this->how_did_you_hear_about_us);
        return ucwords($string);
    }

    public function getFormattedState()
    {
        $state = "";
        switch ($this->state) {
              case 0:
                $state = "For Evaluate";
                break;
            case 1:
                $state = "Pre-Selected";
                break;
            case 2:
                $state = "No Pre-Selected";
                break;
            default:
                # code...
                break;
        }
        return $state;
    }
}
