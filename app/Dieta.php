<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dieta_racion;
use App\Patologia;

class Dieta extends Model
{
  protected $table = "dieta";

  protected $fillable = [
      'id', 'patologia_id', 'observacion', 'personal_id',
  ];
  public static function findById($id)
  {
       $dieta = static::where('id', $id)->first();
       if($dieta){
         return $dieta;
     } return null;
  }
  public static function findByPatologia($patologia_id)
  {
       $dieta = static::where('patologia_id', $patologia_id)
       ->first();
       if($dieta){
         return $dieta;
     } return null;
  }
  public function scopeFindByPersonal($query,$personal_id)
  {
    if($personal_id){
      return $query->where('personal_id',$personal_id)
      ->orderBy('id', 'asc');
    }return null;
  }

  /**
   * @return Racion[]
   */

  public function get_raciones_prohibidas(){
    return $this->get_patologia()->get_raciones_prohibidas();
  }

  public function get_raciones(){
    $raciones = array();
    $rac_die = array();
    try{

    }
    catch(Throwable $e){
      $rac_die = Dieta_racion::where('dieta_id','=',$this->id)
        ->get();
      foreach ($rac_die as $rd){
        array_push($raciones, $rd->get_racion());
      }
    }
    return $raciones;
  }

  public function get_patologia(){
    return Patologia::findById($this->patologia_id);
  }

  public function get_alimentos_prohibidos(){
    return $this->get_patologia()->get_alimentos_prohibidos();
  }

  //'id', 'patologia_id', 'observacion', 'personal_id',

  public function get_id(){
    return $this->id;
  }

  public function set_id(int $id){
    $this->id = $id;
  }

  public function get_patologia_id(){
    return $this->patologia_id;
  }

  public function set_patologia_id(int $patologia_id){
    $this->patologia_id = $patologia_id;
  }

  public function set_patologia(Patologia $patologia){
    $this->set_patologia_id($patologia->get_id());
  }

  public function get_observacion(){
    return $this->observacion;
  }

  public function set_observacion($observacion){
    $this->observacion = $observacion;
  }

  public function get_personal_id(){
    return $this->personal_id;
  }

  public function get_personal(){
    return Personal::find($this->personal_id);
  }

  public function set_personal(Personal $personal){
    $this->set_personal_id($personal->get_id());
  }

  public function set_personal_id(int $personal_id){
    $this->personal_id = $personal_id;
  }
  
  public function patologia()
  {
    return $this->belongsTo('App\Patologia', 'patologia_id');
  }

}
