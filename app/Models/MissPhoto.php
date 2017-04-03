<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class MissPhoto extends Model
{
    
    protected $table = "miss_photo";

    public $timestamps = false;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'is_landscape',
    ];

    protected $guarded = [
        '*'
    ];
}
