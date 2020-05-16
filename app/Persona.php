<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PersonaPatologia;
use Carbon\Carbon;
use App\RacionesDisponibles;

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

    /**
     * Funcion que tiene como objetivo agregar una patología.
     * 
     * Luego la patología debe ser recuperable.
     * 
     * Se agregó como fecha el momento actual.
     * 
     * @return boolean devuelve verdadero si tuvo éxito.
     */

    public function add_patologia_current_time($patologia){
      try{
        PersonaPatologia::create([
          'patologia_id'=>$patologia->id,
          'persona_id'=>$this->id,
          'fecha'=>Carbon::now()
        ]);
        return true;
      }
      catch(Throwable $e){
        return false;
      }
    }

    /**
     * Funcion que tiene como objetivo agregar una patología.
     * 
     * Luego la patología debe ser recuperable.
     * 
     * Se permite ingresar una fecha concreta.
     * 
     * @return boolean devuelve verdadero si tuvo éxito.
     */

    public function add_patologia_custom_time($patologia, $fecha){
      PersonaPatologia::create([
        'patologia_id'=>$patologia->id,
        'persona_id'=>$this->id,
        'fecha'=>$fecha
      ]);
      return true;
    }


    /**
     * Función con objeto de borrar una relación entre persona y patología en caso de ser necesario.
     * 
     * No debería usarse siempre, ya que la relación debería tener cierta historicidad.
     * 
     * @return boolean devuelve verdadero si tuvo éxito.
     * 
     */

    public function del_patologia($patologia){
    
      try{
        $pp = null; //Cargo la variable con nulo
        $pp = PersonaPatologia::where('patologia_id','=',$patologia->id)
                ->where('persona_id','=',$this->id)
                ->first();
        if ($pp == null){//Si sigue en nulo es porque la relación no existe
          $pp->delete();
          return true;
        }
        //else
      }
      catch(Throwable $e){
        return false;
      }
      return false;
    }


    /**
     * Función con objetivo de recuperar una colección con todas las patologías de un usuario
     * 
     * 
     * @return array<Patologia>
     * 
     */

     public function get_patologias(){
      $res = array(); 
      try{
        $pat_id = PersonaPatologia::where('persona_id','=',$this->id)
                ->get();
        foreach($pat_id as $p){
          $query = 'select racion_id';
        }
       }
       catch(Throwable $e){

       }
      return $res;
     }

     /**
      * Funcionalidad principal.
      * 
      * @param $fecha tipo date
      * @param $horario tipo Horario
      *
      * @return Racion
      *
      */

      public function recomendar_racion($fecha,$horario){
          $raciones_disponibles_hoy = array();
          $raciones_disponibles_segun_una_pat = array();
          $raciones_disponibles_segun_varias_pat = array();
          $racion_recomendada = array();
          $patologias_pac = array();
          try{
            $raciones_disponibles_hoy = RacionesDisponibles::recuperar_raciones_disponibles($fecha);
            $patologias_pac = $this->get_patologias();

          }
          catch(Throwable $e){

          }
          return $racion_recomendada;
      }

}
