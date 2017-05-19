<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'email' => 'required|email|unique:user',
                    'name' => 'required',
                    'last_name' => 'required',
                    'country_id' => 'required|exists:country,id',
                    'city' => 'required',
                    'address' => 'required',
                    'password' => 'required',
                    'password_repeat' => 'required|same:password',
                ];
            }
            case 'PUT':
            {
                return [
                    'email' => 'required|email|unique:user,email,'.$this->get('key'),
                    'name' => 'required',
                    'last_name' => 'required',
                    'country_id' => 'required|exists:country,id',
                    'city' => 'required',
                    'address' => 'required',
                    'password' => 'required_with:password',
                    'password_repeat' => 'required_with:password|same:password',
                ];   
            }
            default:
                # code...
                break;
        }
    }

    // public function messages()
    // {
        
    //     switch ($this->method()) {
    //         case 'GET':
    //         case 'DELETE':
    //         {
    //             return [];
    //         }
    //         case 'POST':
    //         {
    //             return [
    //                 'email.required' => 'Email requerido',
    //                 'email.email'=>'No es un email válido',
    //                 'email.unique' => 'El correo ya existe',
    //                 'last_name.required' => 'El apellido es requerido',
    //                 'country_id.required' => 'El país es requerido',
    //                 'country_id.exists' => 'El país no existe',
    //                 'city.required' => 'La ciudad es requerida',
    //                 'name.required' => 'El nombre es requerido',
    //                 'address.required' => 'La dirección es requerida',
    //                 'password.required'=>'Clave requerida',
    //                 'password_repeat.required'=>'Confirmación de clave requerida',
    //                 'password_repeat.same'=>'Las claves no coinciden',
    //             ];
    //         }
    //         case 'PUT':
    //             return [
    //                 'email.required' => 'Email requerido',
    //                 'email.email'=>'No es un email válido',
    //                 'email.unique' => 'El correo ya existe',
    //                 'name.required' => 'El nombre es requerido',
    //                 'last_name.required' => 'El apellido es requerido',
    //                 'country_id.required' => 'El país es requerido',
    //                 'country_id.exists' => 'El país no existe',
    //                 'city.required' => 'La ciudad es requerida',
    //                 'address.required' => 'La dirección es requerida',
    //                 'password.required_with' =>'Clave requerida',
    //                 'password_repeat.required_with'=>'Confirmación de clave requerida',
    //                 'password_repeat.same'=>'Las claves no coinciden',
    //             ];
    //         default:
    //             # code...
    //             break;
    //     }
    // }
}
