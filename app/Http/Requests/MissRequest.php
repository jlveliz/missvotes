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
                    'country_id' => 'required|exists:country,id',
                    'state' => 'required|integer',
                    'birthdate' => 'required',
                    'placebirth'=>'required',
                    'email'=>'required|email|unique:miss',
                    'phone_preffix'=>'required',
                    'phone_number'=>'required',
                    // 'how_did_you_hear_about_us'=>'required|not_in:null',
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
                    'photos'=>'array',
                    // 'applicant_body_photo'=>'required|image|max:2000',
                    // 'applicant_face_photo'=>'required|image|max:2000',
                ];
                break;
            case "PUT":
                return [
                    'state' => 'required|integer',
                    // 'photos'=>'array',
                ];
                break;
        }
           
    }

    public function messages()
    {
        
        switch ($this->method()) {
              case 'POST':
              if (app()->isLocale('es')) {
                return [
                   'name.required' => 'Escriba sus nombres por favor',
                   'last_name.required' => 'Escriba sus apellidos por favor',
                   'is_precandidate.required' => 'la precandidatura es requerida',
                   'country_id.required' => 'El País es requerido',
                   'country_id.exists' => 'El País que intenta ingresar no existe',
                   'state.required' => 'El estado es requerida',
                   'state.integer' => 'El estado es inválido',
                   'birthdate.required' => 'Ingrese una fecha de nacimiento',
                   'birthdate.date_format' => 'La fecha de nacimiento es inválida',
                   'placebirth.required'=>'Ingrese un lugar de nacimiento',
                   'email.required'=>'Ingrese un correo electrónico',
                   'email.email' => 'EL correo electrónico es inválido',
                   'email.unique' => 'EL correo electrónico ya pertenece a otra candidata',
                   'phone_preffix.required'=>'El Campo prefijo es requerido',
                   'phone_number.required'=>'Ingrese un número telefónico por favor', 
                   'how_did_you_hear_about_us.sometimes'=>'Ingrese una razón',
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
                   'applicant_body_photo.required'=>'La Foto es requerida',
                   'applicant_body_photo.image'=>'La archivo debe ser un formato de imagen',
                   'applicant_body_photo.max'=>'la foto excede el tamaño permitido',
                   'applicant_face_photo.required'=>'La Foto es requerida',
                   'applicant_face_photo.image'=>'La archivo debe ser un formato de imagen',
                   'applicant_face_photo.max'=>'la foto excede el tamaño permitido',
                ];
              } else {
                return [
                    'name.required' => 'Please, write your names',
                   'last_name.required' => 'Pleaase, write your lastname',
                   'is_precandidate.required' => 'la precandidatura es requerida',
                   'country_id.required' => 'The Country is required',
                   'country_id.exists' => 'The country you are trying to enter does not exist',
                   'state.required' => 'The state is required',
                   'state.integer' => 'The state is invalid',
                   'birthdate.required' => 'Enter a date of birth',
                   'birthdate.date_format' => 'The date of birth is invalid',
                   'placebirth.required'=>'Enter a place of birth',
                   'email.required'=>'Enter an email',
                   'email.email' => 'E-mail is invalid',
                   'email.unique' => 'The email already belongs to another candidate',
                   'phone_preffix.required'=>'The field prefix is required',
                   'phone_number.required'=>'Enter a phone number please', 
                   'how_did_you_hear_about_us.sometimes'=>'Enter a reason',
                   'height.required' => 'Enter a height',
                   'weight.required' => 'Enter a weight',
                   'address.required'=>'Enter an address',
                   'city.required'=>'Enter a city',
                   'state_province.required'=>'Enter a state or province',
                   'bust_measure.required' => 'Bust measurement required',
                   'bust_measure.integer' => 'Invalid bust measurement', 
                   'waist_measure.required' => 'Required waist measurement',
                   'waist_measure.integer' => 'Invalid waist measurement',
                   'hip_measure.required' => 'Hip measurement required',
                   'hip_measure.integer' => 'Invalid hip measurement',
                   'hair_color.required'=>'Enter a hair color',
                   'eye_color.required'=>'Enter an eye color',
                   'dairy_philosophy.required'=>'Enter a daily philosophy',
                   'why_would_you_win.required'=>'Enter because you would like to win '.config('app.name'),
                   'photos.required'=>'Photos are required',
                   'photos.array'=>'No es un arreglo',
                   'applicant_body_photo.required'=>'Photo of is required',
                   'applicant_body_photo.image'=>'The file must be an image format',
                   'applicant_body_photo.max'=>'the photo exceeds the allowed size',
                   'applicant_face_photo.required'=>'The photo is required',
                   'applicant_face_photo.image'=>'The file must be an image format',
                   'applicant_face_photo.max'=>'The photo exceeds the allowed size',
                ];
              }
              break;
            case "PUT":
                if (app()->isLocale('es')) {
                  return [
                     'name.required' => 'Escriba sus nombres por favor',
                     'last_name.required' => 'Escriba sus apellidos por favor',
                     'is_precandidate.required' => 'la precandidatura es requerida',
                     'country_id.required' => 'El País es requerido',
                     'country_id.exists' => 'El País que intenta ingresar no existe',
                     'state.required' => 'El estado es requerida',
                     'state.integer' => 'El estado es inválido',
                     'birthdate.required' => 'Ingrese una fecha de nacimiento',
                     'birthdate.date_format' => 'La fecha de nacimiento es inválida',
                     'placebirth.required'=>'Ingrese un lugar de nacimiento',
                     'email.required'=>'Ingrese un correo electrónico',
                     'email.email' => 'EL correo electrónico es inválido',
                     'phone_number.required'=>'Ingrese un número telefónico por favor', 
                     'how_did_you_hear_about_us.required'=>'Ingrese una razón',
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
                     'applicant_body_photo.required'=>'La Foto es requerida',
                     'applicant_body_photo.image'=>'La archivo debe ser un formato de imagen',
                     'applicant_body_photo.max'=>'la foto excede el tamaño permitido',
                     'applicant_face_photo.required'=>'La Foto es requerida',
                     'applicant_face_photo.image'=>'La archivo debe ser un formato de imagen',
                     'applicant_face_photo.max'=>'la foto excede el tamaño permitido',
                  ];
               }
        }
    }
}
