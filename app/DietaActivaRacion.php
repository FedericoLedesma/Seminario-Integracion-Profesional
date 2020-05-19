<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DietaActiva;
use App\Racion;

class DietaActivaRacion extends Model
{
    protected $table = "dietas_activas_raciones";

    protected $fillable = [
        'dieta_id', 'fecha','fecha_final','observacion','racion_id'
    ];

    public static function findByDietaFecha($dieta_id,$fecha)
    {
        if(($dieta_id)&&($fecha)){
           $dietaActivaRacion = static::where('dieta_id', $dieta_id)
           ->where('fecha','=',$fecha)
           ->first();
           if($dietaActivaRacion){
             return $dietaActivaRacion;
         }
       }return null;
    }

    public function scopeFindByFecha($query,$fecha)
    {
      if($fecha){
        return $query->where('fecha',$fecha)
        ->where('fecha_final','=',null)
        ->orderBy('dieta_id', 'asc');
      }return null;
    }
    public function scopeFindActiva($query,$dieta_id)
    {
      if($dieta_id){
        return $query->where('dieta_id',$dieta_id)
        ->where('fecha_final','<>',null)
        ->orderBy('fecha', 'asc');
      }return null;
    }
    public function scopeAllFecha($query,$fecha)
    {
      if($fecha){
        return $query->where('fecha',$fecha)
        ->orderBy('dieta_id', 'asc');
      }return null;
    }

    public function get_dieta_activa(){
      return DietaActiva::findByIdFecha($this->dieta_id,$this->fecha);
    }

    public function get_patologia(){
      return $this->get_dieta_activa()->get_patologia();
    }

    public function get_alimentos_prohibidos(){
      $this->get_dieta_activa()->get_alimentos_prohibidos();
    }

    public function get_racion(){
      return Racion::findById($this->racion_id);
    }

}
