<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    
    protected $table = "vote";

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'miss_id',
        'type',
        'value'
    ];

    protected $guarded = [
        '*'
    ];


    public function miss()
    {
        return $this->belongsTo('MissVote\Models\Miss','miss_id');
    }
}
