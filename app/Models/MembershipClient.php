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
        'client_id',
        'membership_id',
        'payment_method',
        'date_start',
        'date_end'
    ];


    public function client()
    {
        return $this->belongsTo('MissVote\Models\Client','client_id');
    }

    public function membership()
    {
        return $this->belongsTo('MissVote\Models\Membership','membership_id');
    }
    
}
