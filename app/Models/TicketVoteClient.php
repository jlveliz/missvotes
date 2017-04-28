<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class TicketVoteClient extends Model
{
    protected $table = "ticket_vote_client";

    protected $fillable = [
    	'raffle_vote_id',
    	'client_id',
        'payment_type',
        'val_vote',
        'description',
    	'state'
    ];


    public function client()
    {
    	return $this->belongsTo('MissVote\Models\Client','client_id');
    }
}
