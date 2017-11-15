<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    protected $table = "country";

    public $timestamps = false;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'lang',
        'flag_img'
    ];

    protected $guarded = [
        '*'
    ];
}
