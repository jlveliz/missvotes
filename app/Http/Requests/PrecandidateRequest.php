<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrecandidateRequest extends FormRequest
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
                    'how_did_you_hear_about_us'=>'required',
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
                    'g-recaptcha-response' => 'sometimes|required|recaptcha',
                    // 'photos'=>'required|array',
                ];
                break;
            case "PUT":
                return [
                    'state' => 'sometimes|required|integer',
                    'is_precandidate' => 'sometimes|required|integer',
                    // 'photos'=>'required_with:photos|array',
                ];
                break;
        }
           
    }

    public function messages()
    {
        
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
    }
}
