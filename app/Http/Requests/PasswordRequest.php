<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
        		'mypassword'=>'required',
				'password'=>'required|confirmed|min:8|max:18',
            //
        ];
    }
    public function messages()
    {
    	return $messages=[
				'mypassword.required'=>"El campo password es requerido",
				'password.required'=>"El campo nuevo password es requerido",
				'password.confirmed'=>"El campo confirmar password es requerido",
				'password.min'=>"La nueva contrasena debe tener minimo 8 caracteres",
				'password.max'=>"El password no puede superar los 18 caracteres",
		
		];
    }
}
