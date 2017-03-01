<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MissRequest extends FormRequest
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
            'last_name' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];
           
    }

    public function messages()
    {
        
        return [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El apellido es requerido',
            'city.required' => 'La ciudad es requerida',
            'state.required' => 'El estado es requerida',
        ];
    }
}
