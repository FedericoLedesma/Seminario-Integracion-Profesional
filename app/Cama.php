<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Habitacion;
use App\PacienteCama;

class Cama extends Model
{
    protected $table = "camas";

    protected $fillable = [
        'cama_id','habitacion_id', #'sector_id',
    ];
    public static function findByIdHabitacionSector($cama_id,$habitacion_id, $sector_id)
    {
        if((($habitacion_id)&&($sector_id))&&($cama_id)){
           $habitacion = static::where('cama_id', $cama_id)
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
        ->orderBy('cama_id', 'asc');
      }return null;
    }

    public static function buscar_por_id($id){
      return static::where('cama_id','=',$id)
        ->get()
        ->first();
    }

    public static function buscar_por_habitacion($id){
      return static::where('habitacion_id','=',$id)
        ->get();
    }

    public function get_habitacion(){
      return Habitacion::buscar_por_id($this->habitacion_id);
    }

    public function get_sector(){
      return $this->get_habitacion()->get_sector();
    }

    public function get_pacientes(){
      return PacienteCama::buscar_pacientes($this->cama_id);
    }

    public function get_pacientes_internados(){
      return PacienteCama::buscar_paciente_actual($this->cama_id);
    }
}
