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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required',
                    'last_name' => 'required',
                    'city_id' => 'required|exists:city,id',
                    'height' => 'required',
                    'bust_measure' => 'required|integer',
                    'waist_measure' => 'required|integer',
                    'hip_measure' => 'required|integer',
                    'state' => 'required|integer',
                    'photos'=>'required|array'
                ];
                break;
            case "PUT":
                return [
                    'name' => 'required',
                    'last_name' => 'required',
                    'city_id' => 'required|exists:city,id',
                    'height' => 'required',
                    'bust_measure' => 'required|integer',
                    'waist_measure' => 'required|integer',
                    'hip_measure' => 'required|integer',
                    'state' => 'required|integer',
                    'photos'=>'required_with:photos|array'
                ];
                break;
        }
           
    }

    public function messages()
    {
        
        return [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El apellido es requerido',
            'city_id.required' => 'La ciudad es requerida',
            'city_id.exists' => 'La ciudad que intenta ingresar no existe',
            'height.required' => 'La altura es requerida',
            'bust_measure.required' => 'Medida de busto requerida',
            'bust_measure.integer' => 'Medida de busto inválida', 
            'waist_measure.required' => 'Medida de cintura requerida',
            'waist_measure.integer' => 'Medida de cintura inválida',
            'hip_measure.required' => 'Medida de cadera requerida',
            'hip_measure.integer' => 'Medida de cadera inválida',
            'state.required' => 'El estado es requerida',
            'state.integer' => 'El estado es inválido',
            'photos.required'=>'Las fotos son requeridas',
            'photos.array'=>'No es un arreglo',
        ];
    }
}
