<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketVoteRequest extends FormRequest
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
            'name' => 'required',
            'val_vote' => 'required',
            'price' => 'required',
        ];
           
    }

    public function messages()
    {
        
        return [
            'name.required' => 'El nombre es requerido',
            'val_vote.required' => 'El valor del voto es requerido',
            'price.required' => 'El precio es requerido',
        ];
    }
}
