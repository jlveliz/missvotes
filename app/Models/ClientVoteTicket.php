<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class ClientVoteTicket extends Model
{
    protected $table = "client_vote_ticket";


    public function client()
    {
    	return $this->belongsTo('MissVote\Models\Client','client_id');
    }

    public function ticket()
    {
    	return $this->belongsTo('MissVote\Models\VoteTicket','vote_ticket_id');
    }
}
