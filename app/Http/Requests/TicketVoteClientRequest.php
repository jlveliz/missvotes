<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketVoteClientRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id'=>'required',
            'raffle_vote_id' => 'required|unique',
            'payment_type'=>'required',
            'val_vote' => 'required',
            'state' => 'required',
        ];
           
    }
}
