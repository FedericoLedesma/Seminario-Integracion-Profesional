<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisponibilidadRequest extends FormRequest
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
         'fecha'=>'after_or_equal:'.date('Y-m-d'),
       ];
    }
    public function messages()
    {
     return $messages=[
       'fecha.after_or_equal'=>'La fecha de la disponibilidad no puede ser anterior a la fecha actual',

      ];
    }
}
