<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPersona extends Model
{
  protected $table = "menus_personas";

  protected $fillable = [
      'persona_id','horario_id','racion_id', 'fecha','personal_id',
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

  public function get_persona(){
    $racion = null;
    $racion = Persona::findById($this->persona_id);
    return $racion;
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
  
}
