<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PersonaPatologia;
use Carbon\Carbon;
use App\RacionesDisponibles;
use App\Racion;
use App\MenuPersona;
use Illuminate\Support\Facades\Log;

class Persona extends Model
{
    //
    protected $table = "personas";

    protected $fillable = [
        'id', 'numero_doc', 'apellido', 'name', 'observacion', 'direccion', 'email', 'provincia',
        'localidad', 'sexo','fecha_nac','tipo_documento_id',
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

    public static function scopeFindByProvincia($query,$provincia)
    {
      if($provincia){
        return $query->where('provincia','LIKE','%'.$provincia.'%')->orderBy('id', 'asc');
      }return null;
    }

    public static function scopeFindByName($query,$name)
    {
      Log::debug('Buscando por nombre a '.$name);
      if($name){
        return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
      }return null;
    }

    public static function scopeFindByApellido($query,$apellido)
    {
      Log::debug('Buscando por apellido a '.$apellido);
      if($apellido){
        return $query->where('apellido','LIKE','%'.$apellido.'%')->orderBy('id', 'asc');
      }return null;
    }

    public static function scopeFindBySexo($query,$sexo)
    {
      if($sexo){
        return $query->where('sexo','LIKE','%'.$sexo.'%');
      }return null;
    }

    public static function scopeFindByLocalidad($query,$localidad)
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

     public function get_id(){
       return $this->id;
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
      public function delete(){
        $destroy = static::where('id', $this->id)->delete();

      }

      public function recomendar_racion($fecha,$horario){
          $raciones_disponibles = array();
          $racion_recomendada = null;
          try{
            $raciones_disponibles = RacionesDisponibles::recuperar_raciones_disponibles($fecha);
            $patologias_pac = $this->get_patologias();
            foreach($patologias_pac as $p){
              Racion::intercept_raciones($raciones_disponibles,$p->get_raciones_por_patologia());
            }

            $raciones_disponibles = Racion::union_raciones($raciones_disponibles,$this->get_ultimas_raciones_consumidas());

            $racion_recomendada = MenuPersona::get_racion_menos_consumida($this,$raciones_disponibles);

          }
          catch(Throwable $e){

          }
          return $racion_recomendada;
      }

      /**
       *
       * @return Racion[]
       */

      public function get_ultimas_raciones_consumidas(){
        $raciones = array();
        $sub = MenuPersona::select(DB::raw('racion_id'))
          ->where([
            ['persona_id','=',$this->id],
            ['fecha','>=',Carbon::now()->subDays(30)]
          ])
          ->groupBy('racion_id')
          ->get();
        foreach($sub as $r){
          array_push($raciones,Racion::findById($r));
        }
        return $raciones;
      }
  
  /**
   métodos estáticos
   */
  /**
   * Recibe un string con los nombres de una persona, separados por espacios.
   * Devuelve las personas que tengan esos nombres.
   * 
   * @param nombre_y_apellido nombres separados por espacios.
   * 
   * @return Persona[ ]
   */
  public static function buscar_por_nombre_y_apellido($nombre_y_apellido){
    Log::debug('Buscando por nombre y apellido a '.$nombre_y_apellido);
    $personas = Array();
    //Separo todos los strings pasados separados por comas
    $campos = explode(' ',$nombre_y_apellido.' ',-1);
    Log::debug('String separado en '.implode($campos));
    foreach($campos as $campo){
      $res_no = static::buscar_por_nombre($campo);
      $res_ap = static::buscar_por_apellido($campo);
      $personas = $res_no->toArray() + $res_ap->toArray();
      Log::debug('Campos de $persona: '.implode($personas[0]));
    }
    return $personas;
  }

  public static function buscar_por_nombre($name)
  {
    Log::debug('Buscando por nombre a '.$name[0]);
    if($name){
      $r = static::where('name','LIKE','%'.$name.'%')
        ->orderBy('id', 'asc')
        ->get()
        #->toArray()
        ;

      return $r;
    }return null;
  }

  public static function buscar_por_apellido($apellido)
  {
    Log::debug('Buscando por apellido a '.$apellido);
    if($apellido){
      return static::where('apellido','LIKE','%'.$apellido.'%')
        ->orderBy('id', 'asc')
        ->get()
        #->toArray()
        ;
    }return null;
  }

}
