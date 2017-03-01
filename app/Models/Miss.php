<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class Miss extends Model
{
    
    protected $table = "miss";

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'city','height','measures','hobbies','state'
    ];
}
