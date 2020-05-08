<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        		'dni'=>'required|numeric|max:999999999999|unique:users',
        		'name'=>'required',
        		
        ];
    }
    public function messages()
    {
    	return $messages=[
				'dni.required'=>"El campo DNI es requerido",
				'name.required'=>"El campo Nombre es requerido",
				'dni.numeric'=>"El campo DNI debe ser numerico",
				'dni.max'=>"El numero de DNI deber ser menor a 999999999999",
        'dni.unique'=>"El DNI ya se encuentra registrado ",


		];
    }
}
