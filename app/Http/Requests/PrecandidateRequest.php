<?php

namespace MissVote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

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
                    // 'state' => 'required|integer',
                    'birthdate' => 'required|date',
                    'placebirth'=>'required',
                    'email'=>'required|email',
                    'phone_number'=>'required',
                    'how_did_you_hear_about_us'=>'required|not_in:null',
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
                    'g-recaptcha-response' => 'required',
                    'precandidate_body_photo'=>'required|image|max:2000',
                    'precandidate_face_photo'=>'required|image|max:2000',
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
        
        return Lang::get('precandidate');
    }
}
