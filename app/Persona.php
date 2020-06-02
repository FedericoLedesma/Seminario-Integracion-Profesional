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
    protected $table = "persona";

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
    public static function findByNumeroDoc($numero_doc)
    {
      Log::debug('Buscando por numero_doc a '.$numero_doc);
      if($numero_doc){
        $persona =  static::where('numero_doc',$numero_doc)->first();
        return $persona;
      }return null;
    }
    public static function buscar_por_numero_doc($numero_doc)
    {
      Log::debug('Buscando por numero_doc a '.$numero_doc);
      if($numero_doc){
        $persona =  static::where('numero_doc','=',$numero_doc)->get();
        return $persona;
      }return array();
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
      Log::debug('Se entró a recuperar las patologias de la persona: '.$this->id.', nombre: '.$this->name.' '.$this->apellido);
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

     public function get_name(){return $this->name;}
     public function get_apellido(){return $this->apellido;}
     public function get_numero_doc(){return $this->numero_doc;}
     public function get_observacion(){return $this->observacion;}
     public function get_direccion(){return $this->direccion;}
     public function get_email(){return $this->email;}
     public function get_provincia(){return $this->provincia;}
     public function get_localidad(){return $this->localidad;}
     public function get_sexo(){return $this->sexo;}
     public function get_fecha_nac(){return $this->fecha_nac;}
     public function get_tipo_documento_id(){return $this->tipo_documento_id;}
     public function get_tipo_documento(){return TipoDocumento::find($this->get_tipo_documento_id());}
     public function get_tipo_documento_name(){return $this->get_tipo_documento()->get_name();}

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

            $raciones_disponibles = $this->get_raciones_disponibles($fecha,$horario);

            $racion_recomendada = MenuPersona::get_racion_menos_consumida($this,$raciones_disponibles);

          }
          catch(Throwable $e){

          }
          return $racion_recomendada;
      }

      public function get_raciones_disponibles($fecha,$horario){
        Log::debug('Se buscarán las raciones diponibles de <'.$this->id.'> '.$this->name);
        $raciones_disponibles = array();
        $conj_rac_dis = array();
        try{
          $lista_raciones_disponibles = RacionesDisponibles::buscar_por_fecha_horario($fecha,$horario);
          $patologias_pac = $this->get_patologias();
          foreach ($lista_raciones_disponibles as $rac_dis) {
            // code...
            array_push($conj_rac_dis,$rac_dis->get_racion());
            Log::debug('Racion disponible: '.$rac_dis);
          }

          foreach($patologias_pac as $p){
            Racion::intercept_raciones($conj_rac_dis,$p->get_raciones_por_patologia());
            Log::debug('Patologia: '.p);
          }

          /*$lista_raciones_disponibles = Racion::union_raciones($lista_raciones_disponibles,$this->get_ultimas_raciones_consumidas());
          if(sizeof($lista_raciones_disponibles)>0)
            foreach ($lista_raciones_disponibles as $rac_dis) {
              // code...
                Log::debug('Persona->get_raciones_disponibles: '.$rac_dis);
                if($rac_dis<>null)
                  Array_push($raciones_disponibles,Racion::findById($rac_dis->racion_id));
            }*/
        }
        catch(Throwable $e){

        }
        Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
        return $conj_rac_dis;
      }

      /**
       *
       * @return Racion[]
       */

      public function get_ultimas_raciones_consumidas(){
        $raciones = array();
        $sub = MenuPersona::#select(DB::raw('racion_id'))->
          where('persona_id','=',$this->id)->
          where('fecha','>=',Carbon::now()->subDays(30))
          #->groupBy('racion_id')
          ->get();
        foreach($sub as $r){
            array_push($raciones,Racion::findById($r->racion_id));
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
  /**
  Metodo para realizar consultas a la tabla Pivot
  se puede filtrar la consulta utilizando el metodo wherePivot


  **/
  public function patologias()
  {
    return $this->belongsToMany('App\Patologia', 'persona_patologia')
    ->withPivot('fecha','hasta')->wherePivot('hasta','=',null);
  }
  public function getPatologiasFecha($fecha)
  {
     return $this->patologias()->wherePivot('fecha','=',$fecha)->get();
  }

  public function tipoDocumento()
  {
    return $this->belongsTo('App\TipoDocumento', 'tipo_documento_id');
  }

}
