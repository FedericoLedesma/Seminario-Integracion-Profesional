<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sector;
use App\Cama;
use Illuminate\Support\Facades\Log;

class Habitacion extends Model
{
    //
    protected $table = "habitaciones";

    protected $fillable = [
        'habitacion_id', 'sector_id','name','descripcion',
    ];
    public static function findByIdSector($habitacion_id, $sector_id)
    {
        if(($habitacion_id)&&($sector_id)){
           $habitacion = static::where('habitacion_id', $habitacion_id)
           ->where('sector_id',$sector_id)
           ->first();
           if($habitacion){
             return $habitacion;
         }
       }return null;
    }

    public function scopeFindBySector($query,$sector_id)
    {
      if($sector_id){
        return $query->where('sector_id',$sector_id)
        ->orderBy('habitacion_id', 'asc');
      }return null;
    }
    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name',$name)
        ->orderBy('sector_id', 'asc');
      }return null;
    }

    public static function buscar_por_sector($id){
      return static::where('sector_id','=',$id)->get();
    }

    public static function buscar_por_id($id){
      return static::where('habitacion_id','=',$id)
        ->get()
        ->first();
    }

    public function get_sector(){
      return Sector::findById($this->sector_id);
    }

    public function get_camas(){
      return Cama::buscar_por_habitacion($this->habitacion_id);
    }

    public function get_pacientes(){
      $res = Array();
      $cam = $this->get_camas();
      foreach ($cam as $p) {
        array_push($res,$p->get_pacientes());
      }
      return $res;
    }

    public function get_pacientes_internados(){
      $res = Array();
      $cam = $this->get_camas();
      foreach ($cam as $p) {
        array_push($res,$p->get_pacientes_internados());
      }
      return $res;
    }
}
