<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
  protected $table = "movimiento";

  protected $fillable = [
      'id','racion_disponible_id',/*'horario_id','racion_id',*/ 'fecha','creado',
      'user_id','tipo_movimiento_id','cantidad',
  ];
  public $timestamps = false;

  public static function findByHorarioRacionId($horario_racion_id, $fecha,$created_at,
    $user_id,$tipo_movimiento_id)
  {
      $movimiento = static::where('horario_racion_id', $horario_racion_id)
      ->where('fecha','=', $fecha)
      ->where('user_id','=', $user_id)
      ->where('created_at','=', $created_at)
      ->where('tipo_movimiento_id', $tipo_movimiento_id)
      ->first();
      if($movimiento){
        return $movimiento;
      } return null;
  }

  public function scopeAllHorarioFecha($query,$horario_id,$fecha)
  {
    $all_m=Movimiento::all();
    $movimientos=array();
    foreach ($all_m as $movimiento) {
      $f=date_create($movimiento->creado);
      if(($movimiento->racionDisponible->horario_racion->horario->id==$horario_id)&&($fecha== $f->format('Y-m-d'))){
        array_push($movimientos,$movimiento);
      }
    }return $movimientos;
  }
  public function scopeAllFecha($query,$fecha)
  {
    $all_m=Movimiento::all();
    $movimientos=array();
    foreach ($all_m as $movimiento) {
      $f=date_create($movimiento->creado);
      if($fecha== $f->format('Y-m-d')){
        array_push($movimientos,$movimiento);
      }
    }return $movimientos;
  }
  public function scopeFindByTipoMovimientoHorarioFecha($query,$horario_id,$fecha,$tipo_movimiento_id)
  {
    if(($horario_id)&&($fecha)){
      return $query->where('fecha','=',$fecha)
      ->where('horario_id',$horario_id)
      ->where('tipo_movimiento_id',$tipo_movimiento_id)
      ->orderBy('created_at', 'asc');
    }return null;
  }
  public static function findByFechaNombreRacion($fecha,$racion_name)
  {
    $movimientos_por_nombre=Movimiento::allPorNombreRacion($racion_name);
    $movimientos=array();
    foreach ($movimientos_por_nombre as $movimiento) {
      $f=date_create($movimiento->creado);
      if($fecha == $f->format('Y-m-d')){
        array_push($movimientos,$movimiento);
      }
    }return $movimientos;
  }
  public static function findByHorarioFechaNombreRacion($horario_id,$fecha,$racion_name)
  {
    $movimientos_por_nombre=Movimiento::findByFechaNombreRacion($fecha,$racion_name);
    $movimientos=array();
    foreach ($movimientos_por_nombre as $movimiento) {
      if($movimiento->racion_disponible->horario_racion->horario->id==$horario_id){
        array_push($movimientos,$movimiento);
      }
    }return $movimientos;
  }
  public static function allPorNombreRacion($racion_name)
  {
    $all_m=Movimiento::all();
    $movimientos=array();
    foreach ($all_m as $movimiento) {
      $str=$movimiento->racion_disponible->horario_racion->racion->name;
      if(!stristr($str,$racion_name) === false){
        array_push($movimientos,$movimiento);
      }
    }
    return $movimientos;
  }

  public function racion_disponible()
  {
    return $this->belongsTo('App\RacionesDisponibles', 'racion_disponible_id');
  }
  public function racion()
  {
    return $this->belongsTo('App\Racion', 'racion_id');
  }
  public function horario()
  {
    return $this->belongsTo('App\Horario', 'horario_id');
  }
  public function tipoMovimiento()
  {
    return $this->belongsTo('App\TipoMovimiento', 'tipo_movimiento_id');
  }
  public function personal()
  {
    return $this->belongsTo('App\Personal', 'user_id');
  }
  public function racionDisponible(){
    return $this->belongsTo('App\RacionesDisponibles', 'racion_disponible_id');
  }

}
