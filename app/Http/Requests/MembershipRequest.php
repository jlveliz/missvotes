<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MembershipRequest extends FormRequest
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
              $name = ['name' => 'required|unique:membership'];
               break;
           case 'PUT' :
              $name =  ['name' => 'required|unique:membership,name,'.$this->get('key')];
               break;
       }

       return array_merge($name,[
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration_mode' => 'required|string',
            'duration_time' => 'required|integer',
            'points_per_vote' => 'required|integer',
        ]);
    }

    // public function messages()
    // {
        
    //     return [
    //         'name.required' => 'El nombre es requerido',
    //         'name.unique' => 'El nombre de la membresía ya existe',
    //         'description.required' => 'La descripción es requerida',
    //         'description.string' => 'La descripción tiene un formato inválido',
    //         'price.required' => 'El precio es requerida',
    //         'price.numeric' => 'El precio no es válido',
    //         'duration_mode.required' => 'El modo de duración de la membresía es requerida',
    //         'duration_mode.string' => 'El modo de duración tiene un formato inválido',
    //         'duration_time.required' => 'El tiempo de duración de la membresía es requerida',
    //         'duration_time.integer' => 'El tiempo de duración tiene un formato inválido',
    //         'points_per_vote.required' => 'El numero de votos por día es requerida',
    //         'points_per_vote.integer' => 'El numero de votos por día tiene un formato inválido',
    //     ];
    // }
}
