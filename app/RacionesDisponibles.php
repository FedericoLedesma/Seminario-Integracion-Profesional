<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Horario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class RacionesDisponibles extends Model
{
    protected $table = "raciones_disponibles";

    protected $fillable = [
        'racion_id', 'fecha', 'horario_id','stock_original','cantidad_restante',
        'cantidad_realizados',
    ];
    public static function findById($horario_id,$racion_id,$fecha)
    {
         $raciones_disponibles = static::where('horario_id','=', $horario_id)
         ->where('racion_id','=', $racion_id)
         ->where('fecha','=', $fecha)
         ->get()
         ->first();
         Log::debug('Recuperada la racionDisponible: '.$raciones_disponibles);
         #if($raciones_disponibles){
           return $raciones_disponibles;
       #} return null;
    }
    public function scopeAllDisponibles($query,$horario_id,$fecha)
    {
      if(($horario_id)&&($fecha)){
        return $query->where('fecha','=',$fecha)
        ->where('horario_id',$horario_id)
        ->where('cantidad_restante','>',0)
        ->orderBy('racion_id', 'asc');
      }return null;
    }
    public function scopeAllRacionesHorarioFecha($query,$horario_id,$fecha)
    {
      if(($horario_id)&&($fecha)){
        return $query->where('fecha','=',$fecha)
        ->where('horario_id',$horario_id)
        ->orderBy('racion_id', 'asc');
      }return null;
    }

    /**
     * Funcionalidad principal.
     * Recomendar ración.
     *
     * @param $fecha
     *
     * @return Racion[ ]
     *
     */

    public function recuperar_raciones_disponibles($fecha){
      $raciones = array();
      try{
        foreach($raciones_disponibles as $rd){
          //Comparar el día, mes (y quizás año)
          if ((Carbon::createFromFormat('d-m-Y', $rd))==(Carbon::createFromFormat('d-m-Y', $fecha))){
            arrayPush($raciones,$rd);
          }
        }
      }
      catch(Throwable $e){

      }
      return $raciones;
    }
    public function eliminar(){
      $deleted = DB::delete('delete from '.$this->table.' where racion_id = :racion_id AND horario_id= :horario_id AND fecha = :fecha',
      [
        'racion_id' => $this->racion_id,
        'horario_id'=> $this->horario_id,
        'fecha'=>$this->fecha,     
      ]);
    }
    public function scopeGetRacionesDisponiblesFecha($query, $fecha)
    {
        return $raciones_disponibles = $query->where('fecha','=',$fecha)
        ->orderBy('horario_id', 'asc');
    }
    public function get_racion(){
      return Racion::findById($this->racion_id);
    }
    public function fecha()
    {
      $fecha_ = date("d/m/Y", strtotime($this->fecha));
      return $fecha_;
    }
    public function descontar_disponibilidad(){

      if ($this->cantidad_restante > 0){
        $this->cantidad_restante--;
        $this->cantidad_realizados++;
        return true;
      }

      return false;
    }
    public function guardar(){
      DB::table($this->table)
              ->where('racion_id', $this->racion_id)
              ->where('horario_id', $this->horario_id)
              ->where('fecha','=', $this->fecha)
              ->update(['stock_original' => $this->stock_original,
              'cantidad_restante' => $this->cantidad_restante,
              'cantidad_realizados'=>$this->cantidad_realizados,
              ]);
    }
    public function registrar_movimiento($usuario, $tipo_movimiento){
      $m = Movimiento::create([
        'horario_id'=>$this->horario_id,
        'racion_id'=>$this->racion_id,
        'fecha'=>$this->fecha,
        'created_at'=>Carbon::now(),
        'user_id'=>$usuario->id,
        'tipo_movimiento_id'=>$tipo_movimiento->id,
        'cantidad'=>1,
      ]);
      if ($m){
        Log::debug('Creado registrar movimiento ' . '$m');
        return true;
      }
      return false;
    }

    public static function buscar_por_fecha_horario($fecha, $horario){
        Log::debug('Buscando raciones en la fecha '.$fecha.' y horario '.$horario->name);
        if(($horario)&&($fecha)){
          return static::where('fecha','=',$fecha)->
            where('horario_id',$horario->id)->
            get();
        }
        return null;
    }
    public function racion(){
      return $this->belongsTo('App\Racion', 'racion_id');
    }
    public function horario(){
      return $this->belongsTo('App\Horario', 'horario_id');
    }
}
