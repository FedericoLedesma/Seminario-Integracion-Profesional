<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Habitacion;
use App\PacienteCama;

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

    public static function buscar_por_habitacion($id){
      return static::where('habitacion_id','=',$id)
        ->get();
    }

    public function get_id(){
      return $this->id;
    }

    public function set_id(int $id){
      $this->id = $id;
    }

    public function get_habitacion(){
      return Habitacion::buscar_por_id($this->habitacion_id);
    }

    public function set_habitacion(Habitacion $habitacion){
      $this->set_habitacion_id($habitacion->get_id());
    }

    public function set_habitacion_id(int $habitacion_id){
      $this->habitacion_id = $habitacion_id;
    }

    public function get_sector(){
      return $this->get_habitacion()->get_sector();
    }

    public function get_pacientes(){
      return PacienteCama::buscar_pacientes($this->id);
    }

    public function get_pacientes_internados(){
      return PacienteCama::buscar_paciente_actual($this->id);
    }
}
