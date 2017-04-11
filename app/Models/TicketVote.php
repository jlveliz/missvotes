<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class TicketVote extends Model
{
    protected $table = "ticket_vote";

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

    public function clients()
    {
        return $this->hasMany('MissVote\Models\TicketVoteClient','ticket_vote_id');
    }


}
