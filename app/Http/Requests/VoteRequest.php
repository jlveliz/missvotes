<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoteRequest extends FormRequest
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
       switch ($this->method()) {
           case 'POST':
              return  [
                // 'value' => 'required|numeric',
                'client_id' => 'required|exists:user,id',
                'miss_id' => 'required|exists:miss,id'
            ];
            break;
       }

    }

    public function messages()
    {
        
        return [
            // 'value.required' => 'Por favor ingrese un valor',
            // 'value.numeric' =>'El valor tiene un formato inválido',
        'client_id.required' => 'Por favor inicie sesión para realizar la votación',
        'client_id.exists' => 'El cliente no existe',
        'miss_id.required'=> 'Por favor ingrese una candidata para realizar la votación',
        'miss_id.exists' => 'La candidata no existe'
        ];
    }
}
