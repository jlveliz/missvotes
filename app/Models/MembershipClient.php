<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipClient extends Model
{

    protected $table = "membership_client";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'membership_id',
        'name',
        'stripe_id',
        'stripe_plan',
        'quantity',
        'trial_ends_at',
        'ends_at'
    ];


    public function client()
    {
        return $this->belongsTo('MissVote\Models\Client','user_id');
    }

    public function membership()
    {
        return $this->belongsTo('MissVote\Models\Membership','membership_id');
    }
    
}
