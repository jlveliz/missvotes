<?php

namespace MissVote\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use MissVote\Notifications\MyResetPassword;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    protected $table = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name', 'email', 'password','address','is_admin','photo','confirmed','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }


    public function client()
    {
        return $this->hasOne('MissVote\Models\Client','id');
    }

    public static function boot(){
        parent::boot();

        static::creating(function($user){
            $user->gender = "male";
        });
    }
}
