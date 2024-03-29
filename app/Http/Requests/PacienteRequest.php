<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
           		'name'=>'required',
              'numero_doc'=>'required|numeric|max:999999999999|unique:persona',
              'apellido'=>'required',
              'direccion'=>'required',
              'provincia'=>'required',
              'localidad'=>'required',
              'sexo'=>'required',
              'fecha_nac'=>'required|before_or_equal:'.date('Y-m-d'),
              'tipo_documento_id'=>'required',
           ];
       }
       public function messages()
       {
       	return $messages=[
   				'numero_doc.required'=>"El campo Numero de documento es requerido",
   				'numero_doc.numeric'=>"El campo numero doc debe ser numerico",
   				'numero_doc.max'=>"El numero de doc deber ser menor a 999999999999",
          'numero_doc.unique'=>"El numero de documento ya se encuentra registrado ",
          'name.required'=>"El campo Nombre es requerido",
          'apellido.required'=>"El campo Apellido es requerido",
          'direccion.required'=>"El campo Direccion es requerido",
          'provincia.required'=>"El Provincia Nombre es requerido",
          'localidad.required'=>"El campo localidad es requerido",
          'sexo.required'=>"El campo sexo es requerido",
          'fecha_nac.required'=>"El campo fecha nacimiento es requerido",
          'tipo_documento_id.required'=>"El campo tipo documento es requerido",
          'fecha_nac.before_or_equal'=>'La fecha de nacimiento debe ser menor o igual a la fecha actual',

   		];
       }
}
