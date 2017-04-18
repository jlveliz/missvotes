<?php

namespace MissVote\Models;

use Illuminate\Database\Eloquent\Model;


class ClientApplyProcess extends Model
{
    
    protected $table = "client_apply_process";

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'process_status',
        'country_code_selected',
        'payed_at',
    ];


    public function client()
    {
    	return $this->belongsTo('MissVote\Models\Client','client_id');
    }
}
