<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class TicketVoteClient extends Model
{
    protected $table = "ticket_vote_client";

    protected $fillable = [
    	'ticket_vote_id',
    	'client_id',
    	'payment_type',
    	'state'
    ];


    public function client()
    {
    	return $this->belongsTo('MissVote\Models\Client','client_id');
    }

    public function ticket()
    {
    	return $this->belongsTo('MissVote\Models\TicketVote','ticket_vote_id');
    }
}
