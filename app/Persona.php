<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PersonaPatologia;
use App\Personal;
use App\Paciente;
use Carbon\Carbon;
use App\RacionesDisponibles;
use App\Racion;
use App\MenuPersona;
use App\Acompanante;
use DateTime;
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
    public function fecha_nac()
    {
      $fecha_ = date("d/m/Y", strtotime($this->fecha_nac));
      return $fecha_;
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
          array_push($res,$p->get_patologia());
        }
       }
       catch(Throwable $e){

       }
      Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
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
            Log::debug('Racion disponible: '.$rac_dis->get_racion());
          }

          foreach($patologias_pac as $p){
            $c =$p->get_raciones_por_patologia();
            foreach ($c as $r) {
              Log::debug('Racion por patologia: '.$r);
            }
            $conj_rac_dis = Racion::intercept_raciones($conj_rac_dis,$c);
            Log::debug('Patologia: '.$p);
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

      public function get_historial_menues($dias){
        Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
        if ($dias==null){
          $dias=30;
        }
        $menues = array();
        $sub = MenuPersona::#select(DB::raw('racion_id'))->
          where('persona_id','=',$this->id)->
          #where('fecha','>=',Carbon::now()->subDays(30))
          orderBy('racion_disponible_id','DESC')->
          #->groupBy('racion_id')
          get();
        foreach ($sub as $menu) {
          Log::Debug($menu->get_fecha().' -> '.$menu->is_in_date_range($dias));
          if ($menu->is_in_date_range($dias)==true){
            array_push($menues,$menu);
          }
        }
        Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
        return $menues;
      }
      public function tiene_menu_hoy_en_horario($horario_id)
      {
        $menu=MenuPersona::get_menu_por_persona_horario_fecha($this->id,$horario_id,date('Y-m-d'));
        if(!empty($menu)){
          return true;
        }return false;
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
  public function personal(){
    //return $this->hasOne('App\Personal');//corregir en de la bd personal debe tener el campo persona_id
    return Personal::findById($this->id);
  }
  public function paciente(){
    //return $this->hasOne('App\Paciente');//corregir en de la bd pacientes debe tener el campo $persona_id
    return Paciente::findById($this->id);
  }
  public function sectorFecha($fecha){
    if($this->personal())
    {
      return $this->personal()->sectorActual();//Cambiar esto debe devolver el sector que pertenecia esas fechas
    }else {
      if($this->paciente()){
        return $this->paciente()->camasFecha($fecha)->habitacion->sector;
      }else{
        if($this->acompanante){
          return $this->acompanante->sectorFecha($fecha);
        }else {
          return null;
        }
      }
    }
  }
  public function habitacionFecha($fecha){
    if($this->paciente()){
      return $this->paciente()->camasFecha($fecha)->habitacion;
    }if($this->acompanante){
      return $this->acompanante->habitacionFecha($fecha);
    }return null;
  }
  public function camaFecha($fecha){
    if($this->paciente()){
      return $this->paciente()->camasFecha($fecha);
    }return null;
  }
  public function acompanante(){
    return $this->hasOne('App\Acompanante');
  }

  public function toAcompanante(){
    return Acompanante::getByPersonaID($this->get_id());
  }

  public function get_acompanantes_desde_persona(){Acompanante::get_por_persona($this);}
  public function to_paciente(){
    $res = Paciente::find($this->get_id());
    if ($res == null){
      return null;
    }
    return $res;
  }

  public function get_historial_internacion_activo(){
    $paciente = $this->to_paciente();
    if ($paciente==null){
      return null;
    }
    return $paciente->get_historial_internacion_activo();
  }

  public function get_historico_internacion(){
    $paciente = $this->to_paciente();
    if ($paciente==null){
      return null;
    }
    return $paciente->get_historico_internacion();
  }

  public function get_like_paciente_list(){
    $paciente = $this->to_paciente();
    if ($paciente==null){
      return null;
    }
    return $paciente;
  }

  public function historial_activo_generar_informe(){
    $paciente = $this->to_paciente();
    if ($paciente==null){
      return null;
    }
    return $paciente->historial_activo_generar_informe();
  }

  public function historial_activo_generar_informe_get_renglones(){
    $paciente = $this->to_paciente();
    if ($paciente==null){
      return null;
    }
    return $paciente->historial_activo_generar_informe_get_renglones();
  }
}
