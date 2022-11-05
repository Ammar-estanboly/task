<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
       $data = $this->validationData();
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'email'  =>[Rule::requiredIf(!array_key_exists('phone_number',$data)),
                        'email',
                        'unique:users,email'],

            'phone_number' =>[Rule::requiredIf(!array_key_exists('email',$data)),
                             'regex:/^[0]+[0-9]{9}$/',
                             'digits:10',
                             'unique:users,phone_number'],
        ];
    }//end role function
}//end class
