<?php

namespace MissVote\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class Client extends Authenticatable
{
    use Notifiable;

    protected $table = "user";

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','is_admin','confirmation_code','confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function tickets()
    {
        return $this->hasMany('MissVote\Models\TicketVoteClient');
    }
}
