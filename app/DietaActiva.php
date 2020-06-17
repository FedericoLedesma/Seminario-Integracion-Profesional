<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dieta;
use Illuminate\Support\Facades\DB;
use App\DietaActivaRacion;

class DietaActiva extends Model
{
    protected $table = "dieta_activa";

    protected $fillable = [
        'id', 'dieta_id', 'fecha', 'fecha_final', 'observacion',
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
    public function scopeFindDietaActiva($query,$dieta_id)
    {
      if($dieta_id){
        return $query->where('dieta_id',$dieta_id)
        ->where('fecha_final','=',null)
        ->first();
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
    public function guardar(){
      DB::table($this->table)
              ->where('dieta_id', $this->dieta_id)
              ->where('fecha','=', $this->fecha)
              ->update(['fecha_final' => $this->fecha_final,
              ]);
    }
    public function dieta(){
        return $this->belongsTo('App\Dieta', 'dieta_id');
    }
    public function raciones(){
      return $this->belongsToMany('App\Racion', 'dieta_activa_racion')
      ->withPivot('fecha');
    }

    public function get_raciones(){
      $res = array();
      $all = DietaActivaRacion::where('dieta_activa_id','=',$this->id)->get();
      foreach ($all as $x) {
        array_push($res,$x->get_racion());
      }
      return $res;
    }
    public function fecha()
    {
      $fecha_ = date("d/m/Y", strtotime($this->fecha));
      return $fecha_;
    }
    public function fecha_final()
    {
      if($this->fecha_final){
        $fecha_ = date("d/m/Y", strtotime($this->fecha_final));
        return $fecha_;
      }return null;

    }
}
