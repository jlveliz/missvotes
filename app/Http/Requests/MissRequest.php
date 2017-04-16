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
                    'is_precandidate'=>'required',
                    'country_id' => 'required|exists:country,id',
                    'state' => 'required|integer',
                    'birthdate' => 'required|date',
                    'placebirth'=>'required',
                    'email'=>'required|email',
                    'phone_number'=>'required',
                    'how_did_you_hear_about_us'=>'required_with:how_did_you_hear_about_us',
                    'height' => 'required',
                    'weight'=>'required',
                    'address'=>'required',
                    'city'=>'required',
                    'state_province'=>'required',
                    'bust_measure' => 'required|integer',
                    'waist_measure' => 'required|integer',
                    'hip_measure' => 'required|integer',
                    'hair_color'=>'required',
                    'eye_color'=>'required',
                    'dairy_philosophy'=>'required',
                    'why_would_you_win'=>'required', 
                    'photos'=>'required|array',
                ];
                break;
            case "PUT":
                return [
                    'name' => 'required_with:name',
                    'last_name' => 'required_with:last_name',
                    'is_precandidate'=>'required_with:is_precandidate',
                    'country_id' => 'required_with:country_id|exists:country,id',
                    'state' => 'required_with:state|integer',
                    'birthdate' => 'required_with:birthdate|date',
                    'placebirth'=>'required_with:placebirth',
                    'email'=>'required_with:email|email',
                    'phone_number'=>'required_with:phone_number',
                    'how_did_you_hear_about_us'=>'required_with:how_did_you_hear_about_us',
                    'height' => 'required_with:height',
                    'weight'=>'required_with:weight',
                    'address'=>'required_with:address',
                    'city'=>'required_with:city',
                    'state_province'=>'required_with:state_province',
                    'bust_measure' => 'required_with:bust_measure|integer',
                    'waist_measure' => 'required_with:waist_measure|integer',
                    'hip_measure' => 'required_with:waist_measure|integer',
                    'hair_color'=>'required_with:hair_color',
                    'eye_color'=>'required_with:eye_color',
                    'dairy_philosophy'=>'required_with:dairy_philosophy',
                    'why_would_you_win'=>'required_with:why_would_you_win', 
                    'photos'=>'required_with:photos|array',
                ];
                break;
        }
           
    }

    public function messages()
    {
        
        switch ($this->method()) {
              case 'POST':
                return [
                   'name.required' => 'Escriba sus nombres por favor',
                   'last_name.required' => 'Escriba sus apellidos por favor',
                   'is_precandidate.required' => 'la precandidatura es requerida',
                   'country_id.required' => 'El País es requerido',
                   'country_id.exists' => 'El País que intenta ingresar no existe',
                   'state.required' => 'El estado es requerida',
                   'state.integer' => 'El estado es inválido',
                   'birthdate.required' => 'Ingrese una fecha de nacimiento',
                   'birthdate.date' => 'La fecha de nacimiento es inválida',
                   'placebirth.required'=>'Ingrese un lugar de nacimiento',
                   'email.required'=>'Ingrese un correo electrónico',
                   'email.email' => 'EL correo electrónico es inválido',
                   'phone_number.required'=>'Ingrese un número telefónico por favor', 
                   'how_did_you_hear_about_us.required_with'=>'Ingrese una razón',
                   'height.required' => 'Ingrese una altura',
                   'weight.required' => 'Ingrese un peso',
                   'address.required'=>'Ingrese una dirección',
                   'city.required'=>'Ingrese una ciudad',
                   'state_province.required'=>'Ingrese un estado o provincia',
                   'bust_measure.required' => 'Medida de busto requerida',
                   'bust_measure.integer' => 'Medida de busto inválida', 
                   'waist_measure.required' => 'Medida de cintura requerida',
                   'waist_measure.integer' => 'Medida de cintura inválida',
                   'hip_measure.required' => 'Medida de cadera requerida',
                   'hip_measure.integer' => 'Medida de cadera inválida',
                   'hair_color.required'=>'Ingrese un color de cabello',
                   'eye_color.required'=>'Ingrese un color de ojos',
                   'dairy_philosophy.required'=>'Ingrese una filosofía diaria',
                   'why_would_you_win.required'=>'Ingrese porque le gustaría Ganar '.config('app.name'),
                   'photos.required'=>'Las fotos son requeridas',
                   'photos.array'=>'No es un arreglo',
                ];
                break;
            case "PUT":
                 return [
                   'name.required_with' => 'Escriba sus nombres por favor',
                   'last_name.required_with' => 'Escriba sus apellidos por favor',
                   'is_precandidate.required_with' => 'la precandidatura es requerida',
                   'country_id.required_with' => 'El País es requerido',
                   'country_id.exists' => 'El País que intenta ingresar no existe',
                   'state.required_with' => 'El estado es requerida',
                   'state.integer' => 'El estado es inválido',
                   'birthdate.required_with' => 'Ingrese una fecha de nacimiento',
                   'birthdate.date' => 'La fecha de nacimiento es inválida',
                   'placebirth.required_with'=>'Ingrese un lugar de nacimiento',
                   'email.required_with'=>'Ingrese un correo electrónico',
                   'email.email' => 'EL correo electrónico es inválido',
                   'phone_number.required_with'=>'Ingrese un número telefónico por favor', 
                   'how_did_you_hear_about_us.required_with'=>'Ingrese una razón',
                   'height.required_with' => 'Ingrese una altura',
                   'weight.required_with' => 'Ingrese un peso',
                   'address.required_with'=>'Ingrese una dirección',
                   'city.required_with'=>'Ingrese una ciudad',
                   'state_province.required_with'=>'Ingrese un estado o provincia',
                   'bust_measure.required_with' => 'Medida de busto requerida',
                   'bust_measure.integer' => 'Medida de busto inválida', 
                   'waist_measure.required_with' => 'Medida de cintura requerida',
                   'waist_measure.integer' => 'Medida de cintura inválida',
                   'hip_measure.required_with' => 'Medida de cadera requerida',
                   'hip_measure.integer' => 'Medida de cadera inválida',
                   'hair_color.required_with'=>'Ingrese un color de cabello',
                   'eye_color.required_with'=>'Ingrese un color de ojos',
                   'dairy_philosophy.required_with'=>'Ingrese una filosofía diaria',
                   'why_would_you_win.required_with'=>'Ingrese porque le gustaría Ganar '.config('app.name'),
                   'photos.required_with'=>'Las fotos son requeridas',
                   'photos.array'=>'No es un arreglo',
                ];
        }
    }
}
