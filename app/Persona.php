<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = "personas";

    protected $fillable = [
        'id', 'dni', 'apellido', 'name', 'observacion', 'direccion', 'email', 'provincia',
        'localidad', 'sexo','fecha_nac','tipo_dni',
    ];
    public static function findById(int $id)
    {
      if($id){
        $persona = static::where('id', $id)->first();
        if($persona){
             return $persona;
        }
      }return null;
    }
    public static function findByEmail(string $email)
    {
         $persona = static::where('email','LIKE','%'.$email.'%')->first();
         if($persona){
           return $persona;
       } return null;
    }

    public function scopeFindByProvincia($query,$provincia)
    {
      if($provincia){
        return $query->where('provincia','LIKE','%'.$provincia.'%')->orderBy('id', 'asc');
      }return null;
    }

    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
      }return null;
    }

    public function scopeFindByApellido($query,$apellido)
    {
      if($apellido){
        return $query->where('apellido','LIKE','%'.$apellido.'%')->orderBy('id', 'asc');
      }return null;
    }

    public function scopeFindBySexo($query,$sexo)
    {
      if($sexo){
        return $query->where('sexo','LIKE','%'.$sexo.'%');
      }return null;
    }

    public function scopeFindByLocalidad($query,$localidad)
    {
      if($localidad){
        return $query->where('localidad','LIKE','%'.$localidad.'%')->orderBy('id', 'asc');
      }return null;
    }


}
