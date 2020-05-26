<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Horario;
use Carbon\Carbon;
use App\Informes\InformeRacion;

class MenuPersona extends Model
{
  protected $table = "menu_persona";

  protected $fillable = [
      'id', 'persona_id','racion_disponible_id','personal_id',
      'dieta_id','realizado',
  ];

  public static $dias = 30;

  public static function findById($horario_id,$persona_id,$fecha)
  {
       $menu_personas = static::where('horario_id', $horario_id)
       ->where('fecha','=', $fecha)
       ->where('persona_id', $persona_id)
       ->first();
       if($menu_personas){
         return $menu_personas;
     } return null;
  }

  public function scopeAllHorarioFecha($query,$horario_id,$fecha)
  {
    if(($horario_id)&&($fecha)){
      return $query->where('fecha','=',$fecha)
      ->where('horario_id',$horario_id)
      ->orderBy('persona_id', 'asc');
    }return null;
  }

  public function scopeAllRealizadosHorarioFecha($query,$horario_id,$fecha)
  {
    if(($horario_id)&&($fecha)){
      return $query->where('fecha','=',$fecha)
      ->where('horario_id',$horario_id)
      ->where('realizado',true)
      ->orderBy('persona_id', 'asc');
    }return null;
  }

  public function scopeAllRealizadosFecha($query,$fecha)
  {
    if($fecha){
      return $query->where('fecha','=',$fecha)
      ->where('realizado',true)
      ->orderBy('persona_id', 'asc');
    }return null;
  }
  public function scopeAllFecha($query,$fecha)
  {
    if($fecha){
      return $query->where('fecha','=',$fecha)
      ->orderBy('persona_id', 'asc');
    }return null;
  }
  public function scopeAllPersonaFecha($query,$persona_id,$fecha)
  {
    if(($persona_id)&&($fecha)){
      return $query->where('fecha','=',$fecha)
      ->where('persona_id',$persona_id)
      ->orderBy('persona_id', 'asc');
    }return null;
  }
  public function scopeAllPersona($query,$persona_id)
  {
    if($persona_id){
      return $query->where('persona_id',$persona_id)
      ->orderBy('fecha', 'asc');
    }return null;
  }

  /**
  Métodos de instancia según nuestro modelo de funciones.
  */

  /**
   *
   *
   * @return Racion
   */
  public static function get_racion_menos_consumida($persona,$raciones){
    $racion = array();
    $c = -1;
    foreach($raciones as $r){
      $cantidad = static::where([
        ['persona_id','=',$persona->id],
        ['fecha','>=',Carbon::now()->subDays(30)],
        ['racion_id','=',$r->id]
      ])
        ->count();
      if($c==-1){
        $c = $cantidad;
        $racion = $r;
      }
      else{
        if ($cantidad<$c){
          $c = $cantidad;
          $racion = $r;
        }
      }
    }
    return $racion;
  }


  /**
   *
   * @return boolean
   */
  public function descontar_disponibilidad_racion(){
    return $this->get_disponibilidad_racion()->descontar_disponibilidad();
  }

  /**
   *
   * @return boolean
   */
  public function registrar_movimiento($usuario, $tipo_movimiento){
    return $this->get_disponibilidad_racion()->registrar_movimiento($usuario, $tipo_movimiento);
  }

  public function tengo_la_fecha($fecha){
    if($fecha<>null){
      //falta validar
      return $this->fecha==$fecha;
    }
    return null;
  }

  /**
   getters y settes

   *
   * Para evitar código repetido, ya que se repite mucho el tema de los get/set de las FK
   *
   */


  /**
   *
   * @return Racion
   */

  public function get_racion(){
    $racion = null;
    $racion = Racion::findById($this->racion_id);
    return $racion;
  }

  /**
   *
   * @return String
   */

  public function get_racion_name(){
    $racion_name = "no hay racion";
    $aux = null;
    $aux = $this->get_racion();
    if ($aux){
      $racion_name = $aux->name;
    }
    return $racion_name;
  }

    /**
     *
     * @return int
     */

    public function get_racion_id(){
      $racion_id = -1;
      $aux = null;
      $aux = $this->get_racion();
      if ($aux){
        $racion_id = $aux->id;
      }
      return $racion_id;
    }

  public function isRealizado_str(){
    if ($this->realizado)
      return 'si';
    #else
    return 'no';
  }

  public function get_persona(){
    $racion = null;
    $racion = Persona::findById($this->persona_id);
    return $racion;
  }

  public function get_persona_nombre_completo(){
    $persona = $this->get_persona();
    return $persona->name . ' ' . $persona->apellido;
  }

  public function get_personal(){
    $racion = null;
    $racion = Personal::findById($this->personal_id);
    return $racion;
  }

  public function get_horario(){
    $horario = Horario::findById($this->horario_id);
    return $horario;
  }

  public function get_horario_name(){
    return $this->get_horario()->name;
  }

  public function get_disponibilidad_racion(){
    $r = RacionesDisponibles::findById($this->horario_id,$this->racion_id,$this->fecha);
    return $r;
  }

  public function set_disponibilidad_racion($racion,$horario,$fecha){
    $this->racion_id = $racion->id;
    $this->horario_id = $horario->id;
    $this->fecha = $fecha;
  }

  public function set_persona($persona){
    $this->persona_id = $persona->id;
  }

  public function set_personal($personal){
    $this->personal_id = $personal->id;
  }

  public function is_realizado(){
    return $this->realizado;
  }


  /**
   Métodos de clase, según nuestro MenuController de nuestro modelo de funciones.
   */


  /**
   * Crea un menú persona.
   *
   * @param Persona tipo App\Persona obligatorio
   * @param Racion tipo App\Racion obligatorio
   * @param Horario tipo App\Horario obligatorio
   * @param fecha tipo date obligatorio
   *
   *
   * @return App\MenuPersona
   *
   *
   */

   public static function createMenuPersona($Persona,$Racion,$Horario,$fecha){
    if (($Persona<>null)&($Racion<>null)&($Horario<>null)&($fecha<>null)){
      $new_menu = MenuPersona::create([
        'persona_id'=>$Persona->id,
        'horario_id'=>$Horario->id,
        'racion_id'=>$Racion->id,
        'fecha'=>$fecha
      ]);
      return $new_menu;
    }
    return;
   }

   public static function get_menu_recomendado($persona,$fecha,$horario){
    $racion = $persona->recomendar_racion($fecha,$horario);
    return static::createMenuPersona($persona,$racion,$horario,$fecha);
   }

  /**
   * Busca todos los menues persona según un string que tiene nombres y apellidos separados por espacios.
   *
   * @param String nombres y apellidos separados por espacio.
   *
   * @return array App\MenuPersona
   *
   */

  public static function buscar_por_persona_nombre_y_apellido($nombre_apellido){
    Log::debug("Se recibio un ".$nombre_apellido.', y luego se buscarán las personas que tengan esos nombres o apellidos');
    $menues = Array();
    $personas = Persona::buscar_por_nombre_y_apellido($nombre_apellido);
    #Log::debug("Se buscará por ".$personas);
    foreach($personas as $persona){
      Log::debug("Buscando todos los menues de los ".implode($persona));
      $menues = static::union_menu_persona($menues, static::buscar_por_persona($persona));
    }
    #Log::debug('Se devuelven: '.implode(', ', $menues));
    return $menues;
  }

  public static function union_menu_persona($a,$b){
    $menues = Array();
    foreach($a as $x){
      if (!in_array($x,$menues)){
        array_push($menues,$x);
      }
    }
    foreach($b as $x){
      if (!in_array($x,$menues)){
        array_push($menues,$x);
      }
    }
    return $menues;
  }

  /**
   *
   * Busca todas las raciones que hayan sido consumidas por una persona
   *
   * Recibe un objeto Persona
   *
   * @param persona App\Persona
   *
   * @return array MenuPersona
   *
   */

  public static function buscar_por_persona($persona){
    Log::debug('Se recibió '.implode($persona));
    #$munues = Array();
    $menues = static::where('persona_id','=',$persona['id'])
      ->orderBy('fecha','desc')
      ->get()
      #->toArray()
      ;
    Log::debug('Se encontraron los siguientes menues persona: '.$menues);
    return $menues;
  }


  public static function create($persona_id, $racion_id, $horario_id, $fecha, $personal_id){
    Log::debug('Se quiere insertar una nueva tupla en menus_persona: id de persona: '.$persona_id);
    Log::debug(' id de racion: '.$racion_id);
    Log::debug(' id horario: '.$horario_id);
    Log::debug(' fecha: '.$fecha);
    Log::debug(' id de personal: '.$personal_id);
    $r = static::insert([
      'persona_id' => $persona_id,
      'racion_id'=>$racion_id,
      'horario_id'=>$horario_id,
      'fecha'=>$fecha,
      'personal_id'=>$personal_id,
      'realizado'=>false,
    ]);
    Log::debug('La query dio como resultado: '.$r);
  }

  public static function buscar_por_nombre_de_horario($query){
    $horarios = Horario::buscar_por_nombre($query);
    $menues = Array();
    foreach ($horarios as $horario){
      $sub = static::where('horario_id','=',$horario->id)
        ->get();
      foreach ($sub as $m) {
        array_push($menues, $m);
      }
    }
    return $menues;
  }


  /**
  *   Busca los menúes dada una fecha pasada como parámetro
  *   @param query String yyyy-mm-dd
  *   @return MenuRacion[]
  */
  public static function buscar_por_fecha($fecha){
    return static::where('fecha','=',$fecha)
      ->get();
  }


  /**
  * Busca un menu persona, y si existe en la base de datos, la borrar
  *
  *
  * @param App\MenuPersona $menu_persona
  *
  * @return boolean, true si tuvo éxito de lo contrario false.
  *
  */

  public static function borrar(MenuPersona $menu_persona){
    if ($menu_persona<>null){
      static::
        where('persona_id','=',$menu_persona->persona_id)->
        where('horario_id','=',$menu_persona->horario_id)->
        where('fecha','=',$menu_persona->fecha)->
        delete();
      return true;
    }
    return false;
  }


  public static function generar_informe($fecha_inicial, $fecha_final, $horario_inicial, $horario_final)
  {
    $conjunto = static::where('fecha','>=',$fecha_inicial)
                  ->where('fecha','<=',$fecha_final)
                  ->where('horario_id','>=',$horario_inicial)
                  ->where('horario_id','<=',$horario_final)
                  ->orderBy('realizado', 'desc')
                  ->orderBy('racion_id', 'desc')
                  ->get();
    Log::debug('Se creó un conjunto de menú persona. Variables: '.$fecha_inicial .' '. $fecha_final .' '. $horario_inicial .' '. $horario_final);
    foreach ($conjunto as $c) {
      // code...
      Log::debug($c);
    }
    return InformeRacion::create_informe_racion($conjunto,$fecha_inicial, $fecha_final, $horario_inicial, $horario_final);
  }

  public static function set_realizado_by_id($fecha,$horario,$racion,bool $valor){
    static::
      where('fecha','=',$fecha)->
      where('horario_id','=',$horario)->
      where('racion_id','=',$racion)->
      update(['realizado'=> $valor]);
  }

  public function set_realizado(bool $valor){
    static::
      where('fecha','=',$this->fecha)->
      where('horario_id','=',$this->horario_id)->
      where('persona_id','=',$this->persona_id)->
      update(['realizado'=> $valor]);
  }

  function getJsonData(){
    $var = get_object_vars($this);
    foreach ($var as &$value) {
        if (is_object($value) && method_exists($value,'getJsonData')) {
            $value = $value->getJsonData();
        }
    }
    return $var;
  }

}
