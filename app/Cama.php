<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Habitacion;
use App\PacienteCama;
use Illuminate\Support\Facades\Log;

class Cama extends Model
{
    protected $table = "cama";

    protected $fillable = [
        /*'cama_id',*/'id','habitacion_id', #'sector_id',
    ];
    public static function findByIdHabitacionSector($id,$habitacion_id, $sector_id)
    {
        if((($habitacion_id)&&($sector_id))&&($id)){
           $habitacion = static::where('id', $id)
           ->where('habitacion_id', $habitacion_id)
           ->where('sector_id',$sector_id)
           ->first();
           if($habitacion){
             return $habitacion;
         }
       }return null;
    }

    public function scopeFindBySectorHabitacion($query,$sector_id,$habitacion_id)
    {
      if(($sector_id)&&($habitacion_id)){
        return $query->where('sector_id',$sector_id)
        ->where('habitacion_id',$habitacion_id)
        ->orderBy('id', 'asc');
      }return null;
    }

    public static function buscar_por_id($id){
      return static::where('id','=',$id)
        ->get()
        ->first();
    }

    public static function buscar_por_habitacion($habitacion_id){
      return static::where('habitacion_id','=',$habitacion_id)
        ->get();
    }

    public function get_id(){
      return $this->id;
    }

    public function set_id(int $id){
      $this->id = $id;
    }

    /*public function get_habitacion(){
      return Habitacion::buscar_por_id($this->habitacion_id);
    }*/

    public function set_habitacion(Habitacion $habitacion){
      $this->set_habitacion_id($habitacion->get_id());
    }

    public function set_habitacion_id(int $habitacion_id){
      $this->habitacion_id = $habitacion_id;
    }

    public function get_pacientes(){
      return PacienteCama::buscar_pacientes($this->id);
    }

    public function buscar_paciente_actual(){
      return PacienteCama::buscar_paciente_actual($this->id);
    }

    public function get_habitacion(){return Habitacion::find($this->get_habitacion_id());}
    public function get_habitacion_id(){return $this->habitacion_id;}
    public function get_habitacion_name(){return $this->get_habitacion()->get_name();}
    public function get_sector(){return $this->get_habitacion()->get_sector();}
    public function get_sector_id(){return $this->get_sector()->get_id();}
    public function get_sector_name(){return $this->get_sector()->get_name();}
    public function is_desocupada(){return PacienteCama::cama_is_desocupada($this->get_id());}
    public static function contar_por_id_habitacion($id_habitacion){return static::where('habitacion_id','=',$id_habitacion)->count();}
    public static function eliminar_una_por_id_habitacion($habitacion_id){
      #$camas = static::where('habitacion_id');
    }
    public static function buscar_camas_desocupadas_por_id_habitacion($habitacion_id){
      Log::debug('Buscando las camas desocupadas de la habitacion '.$habitacion_id);
      $res = array();
      $camas = static::where('habitacion_id','=',$habitacion_id)->get();
      foreach ($camas as $cama) {
        Log::debug('Checkeando la cama '.$cama);
        if ($cama->is_desocupada()){
          Log::debug('Desocupada');
          array_push($res,$cama);
        }
        else {
          Log::debug('Ocupada');
        }
      }
      return $res;
    }

    public static function borrar(Cama $cama){$cama->delete();}

    public static function buscar_por_sector_name($sector_name){
      $res = array();
      $habitaciones = Habitacion::buscar_por_sector_name($sector_name);
      $all = static::all();
      foreach ($all as $cama) {
        foreach ($habitaciones as $habitacion) {
          if ($cama->get_habitacion_id()==$habitacion->get_id()){
            array_push($res,$cama);
          }
        }
      }
      return $res;
    }
    public function habitacion()
    {
      return $this->belongsTo('App\Habitacion', 'habitacion_id');
    }
}
