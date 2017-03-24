<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{

    protected $table = "membership";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price','duration_mode','duration_time','num_votes_per_day'
    ];

    
}
