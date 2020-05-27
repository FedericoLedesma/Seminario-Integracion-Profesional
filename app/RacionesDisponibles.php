<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Horario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class RacionesDisponibles extends Model
{
    protected $table = "racion_disponible";

    protected $fillable = [
        'id','horario_racion_id',/*'racion_id',*/ 'fecha', /*'horario_id',*/'stock_original','cantidad_restante',
        'cantidad_realizados',
    ];
    public static function findById($id)
    {
        if($id){
          $raciones_disponibles = static::where('id', $id)->first();
          Log::debug('Recuperada la racionDisponible: '.$raciones_disponibles);
          #if($raciones_disponibles){
            return $raciones_disponibles;
        #} return null;
        }

    }
    public static function findByHorarioRacionFecha($horario_id,$racion_id,$fecha)
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

    public static function buscar_por_racion_horario_fecha(Racion $racion, Horario $horario, $fecha){
      return static::where('horario_id','=', $horario->get_id())
      ->where('racion_id','=', $racion->get_id())
      ->where('fecha','=', $fecha)
      ->get()->first();
    }

    public static function buscar_por_fecha_racion($fecha, Racion $racion){
      $hor_rac = HorarioRacion::buscar_por_racion($racion);
      $rac_dis = static::where('fecha','=', $fecha)->get();
      $res = array();
      foreach ($hor_rac as $hr) {
        foreach ($rac_dis as $rd) {
          if ($rd->get_horario_id()==$rh->get_id())
            array_pus($res,$rd);
        }
      }
      return $res;
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
      return HorarioRacion::find($this->get_horario_racion_id())->get_racion();
    }

    public function get_racion_id(){
      return $this->get_racion()->get_id();
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

    public static function buscar_por_fecha_horario($fecha, Horario $horario){
        Log::debug('Buscando raciones en la fecha '.$fecha.' y horario '.$horario->name);
        if(($horario)&&($fecha)){
          $rac_dis = static::where('fecha','=',$fecha)->get();
          $hor_rac = HorarioRacion::buscar_por_horario($horario);
          $res = Array();
          foreach ($rac_dis as $r_d) {
            foreach ($hor_rac as $h_r) {
              if ($r_d->get_horario_racion_id()==$h_r->get_id())
                array_push($res, $r_d);
            }
          }
          return $res;
        }
        return Array();
    }
    public function racion(){
      return $this->belongsTo('App\Racion', 'racion_id');
    }
    public function horario(){
      return $this->belongsTo('App\Horario', 'horario_id');
    }
    public function horario_racion(){
        return $this->belongsTo('App\HorarioRacion','horario_racion_id');
    }

    public function get_horario_racion_id(){
      return $this->horario_racion_id;
    }

    public function get_fecha(){
      return $this->fecha;
    }

    public function set_fecha($fecha){
      $this->fecha = $fecha;
    }

    public function get_id(){
      return $this->id;
    }

    public function set_id(int $id){
      $this->id = $id;
    }
}
