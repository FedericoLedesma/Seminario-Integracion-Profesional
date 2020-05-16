<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dieta_racion;

class Dieta extends Model
{
  protected $table = "dietas";

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


}
