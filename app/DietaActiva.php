<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dieta;

class DietaActiva extends Model
{
    protected $table = "dieta_activas";

    protected $fillable = [
        'dieta_id', 'fecha', 'fecha_final', 'observacion',
    ];
    public static function findById($dieta_id)
    {
         $dieta = static::where('dieta_id', $dieta_id)
         ->where('fecha_final','=', null)
         ->first();
         if($dieta){
           return $dieta;
       } return null;
    }
    public static function findByIdFecha($dieta_id,$fecha)
    {
         $dieta = static::where('dieta_id', $dieta_id)
         ->where('fecha','=', $fecha)
         ->first();
         if($dieta){
           return $dieta;
       } return null;
    }
    public function scopeFindDieta($query,$dieta_id)
    {
      if($dieta_id){
        return $query->where('dieta_id',$dieta_id)
        ->orderBy('fecha', 'asc');
      }return null;
    }
    public function scopeGetNoActivas($query,$dieta_id)
    {
      if($dieta_id){
        return $query->where('dieta_id',$dieta_id)
        ->where('fecha_final','<>', null)
        ->orderBy('fecha', 'asc');
      }return null;
    }

    public function get_dieta(){
      $d = Dieta::findById($this->dieta_id);
      return $d;
    }

    public function get_patologia(){
      return $this->get_dieta()->get_patologia();
    }

    public function get_alimentos_prohibidos(){
      return $this->get_patologia()->get_alimentos_prohibidos();
    }
}
