<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    public static function findById(int $id)
    {
        try {
          $persona = static::where('id', $id)->first();
          if($persona){
            return $persona;
          }
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        

    }
}
