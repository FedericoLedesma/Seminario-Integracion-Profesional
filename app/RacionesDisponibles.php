<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Horario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
         $raciones_disponibles = static::where('fecha','=', $fecha)
         ->get();
         foreach ($raciones_disponibles as $r_d) {
           if(($r_d->horario_racion->horario->id==$horario_id)&&($r_d->horario_racion->racion->id==$racion_id)){
             return $r_d;
           }
         }
         Log::debug('Recuperada la racionDisponible: '.$raciones_disponibles);
         #if($raciones_disponibles){
           return null;
       #} return null;
    }
    public static function getRacionesDisponiblesPatologias($patologias,$fecha,$horario_id)
    {
      Log::Debug("static function getRacionesDisponiblesPatologias");
      $raciones_disponibles= RacionesDisponibles::getRacionesDisponiblesFecha($fecha)->get();
      Log::Debug("Obtengo todas las raciones disponibles para la fecha");

      $r_d=array();
      $raciones=array();

      foreach ($patologias as $patologia) {
        Log::Debug("Patologia ".$patologia->name);
        $dieta=$patologia->dieta->dietaActiva->where('fecha_final','=',null)->first();
        Log::Debug("Obtengo la dieta activa de la patologia");
        Log::info($dieta);

        $rs=$dieta->raciones;
        Log::Debug("Se guardan todas las raciones asociadas a la dieta dentro del array raciones ");

        foreach ($rs as $r) {
          array_push($raciones,$r);
        }
      }

      foreach ($raciones as $racion) {
        $r=RacionesDisponibles::findByHorarioRacionFecha($horario_id,$racion->id,$fecha);
          if(!empty($r)){
            Log::info("Raciondisp ".$r);
            array_push($r_d,$r);
          }
      }
      return $r_d;
    }

    public static function buscar_por_racion_horario_fecha($racion_id, $horario_id, $fecha){
      $raciones_disponibles_fecha = static::where('fecha','=', $fecha)->get();
      $horario_racion = HorarioRacion::buscar_por_unique_key_horario_racion($horario_id,$racion_id);
      foreach ($raciones_disponibles_fecha as $rac_dis) {
        if ($rac_dis->get_horario_racion_id()==$horario_racion->get_id())
          return $rac_dis;
      }
      return null;
    }

    public static function buscar_por_fecha_racion($fecha, Racion $racion){
      $hor_rac = HorarioRacion::buscar_por_racion($racion);
      $rac_dis = static::where('fecha','=', $fecha)->get();
      $res = array();
      foreach ($hor_rac as $hr) {
        foreach ($rac_dis as $rd) {
          if ($rd->horario_racion->id==$hr->id)
            array_push($res,$rd);
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
        ->orderBy('id', 'asc');
    }
    /**
     Getters y setters
     */
    public function get_horario_racion_id(){return $this->horario_racion_id;}
    public function get_horario_racion(){return HorarioRacion::find($this->get_horario_racion_id());}
    public function get_fecha(){return $this->fecha;}
    public function set_fecha($fecha){$this->fecha = $fecha;}
    public function get_horario(){return $this->get_horario_racion()->get_horario();}
    public function get_racion(){return $this->get_horario_racion()->get_racion();}
    public function get_racion_id(){return $this->get_racion()->get_id();}

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
              ->where('id', $this->id)
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
          /*$hor_rac = HorarioRacion::buscar_por_horario($horario);
          $res = Array();
          foreach ($rac_dis as $r_d) {
            foreach ($hor_rac as $h_r) {
              if ($r_d->get_horario_racion_id()==$h_r->get_id())
                array_push($res, $r_d);
            }
          }*/
          $res = array();
          foreach ($rac_dis as $r_d){
            Log::Debug('Analizando el horario de: '.$r_d);
            $hor_r_d =$r_d->get_horario();
            Log::debug('Su horario es: '.$hor_r_d);
            if ($hor_r_d->get_id()==$horario->get_id()){
              array_push($res, $r_d);
              Log::debug('Agregada: '.$r_d->get_racion());
            }
          }
          Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
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

    public function get_id(){
      return $this->id;
    }

    public function set_id(int $id){
      $this->id = $id;
    }
    public function movimientos(){
      //return $this->hasMany('App\Movimiento');

      return Movimiento::all()->where('racion_disponible_id',$this->id);


    }

    public function is_in_date_range($days){
      $c = static::where('fecha','>=',Carbon::now()->subDays($days))->
        where('id','=',$this->get_id())->count();
      if ($c>0){
        return true;
      }
      return false;
    }

    public static function buscar_entre_fechas($f_ini,$f_fin){
      Log::debug('Buscando disponibilidades entre fechas');
      Log::debug('Parámetros: 1-'.$f_ini.' || 2-'.$f_fin);
      if ($f_fin==null){
        return static::where('fecha','>=',$f_ini)->get();
      }
      return static::where('fecha','>=',$f_ini)->
        where('fecha','<=',$f_fin)->
        get();
    }
}
