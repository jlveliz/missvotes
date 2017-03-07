<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class VoteTicket extends Model
{
    protected $table = "vote_ticket";

    protected $primaryKey = "id";

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'val_vote', 
        'price',
    ];

}
