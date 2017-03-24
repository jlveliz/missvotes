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
            'description' => 'required',
            'price' => 'required|numeric',
            'duration_mode' => 'required|string',
            'duration_time' => 'required|integer',
            'num_votes_per_day' => 'required|integer',
        ];      
    }

    public function messages()
    {
        
        return [
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida',
            'price.required' => 'El precio es requerida',
            'price.numeric' => 'El precio no es válido',
            'duration_mode.required' => 'El modo de duración de la membresía es requerida',
            'duration_mode.string' => 'El modo de duración tiene un formato inválido',
            'duration_time.required' => 'El tiempo de duración de la membresía es requerida',
            'duration_time.integer' => 'El tiempo de duración tiene un formato inválido',
            'num_votes_per_day.required' => 'El numero de votos por día es requerida',
            'num_votes_per_day.integer' => 'El numero de votos por día tiene un formato inválido',
        ];
    }
}
