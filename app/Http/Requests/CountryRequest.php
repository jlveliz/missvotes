<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
        $formR = [];
       switch ($this->method()) {
           case 'POST':
                $formR =  [
                    'name' => 'required|unique:country,name',
                    'code' => 'required|unique:country,code'
                ];
               break;
           case 'PUT' :
                $formR = [
                    'name' => 'required|unique:country,name,'.$this->get('key'),
                    'code' => 'required|unique:country,code,'.$this->get('key')
                ];
               break;
       }

       return array_merge($formR,[
            'flag_img' => 'image'
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
