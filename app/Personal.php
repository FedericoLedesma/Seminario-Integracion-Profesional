<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Personal extends Model
{
  protected $table = "personal";

  protected $fillable = [
      'id', 'matricula',
  ];
  public static function findById($id)
  {
      if($id){
         $personal = static::where('id', $id)->first();
         if($personal){
           return $personal;
       }
     }return null;
  }
  public static function buscar_por_numero_doc($dni){
    Log::debug('Buscando por dni a '.$dni);

    $all = Personal::all();
    foreach ($all as $personal) {
      if($personal->persona->numero_doc==$dni){
        return $personal;
      }
    }
  }
  public function persona()
  {
    return $this->belongsTo('App\Persona', 'id');
  }
  public static function findByMatricula($matricula)
  {
      if($matricula){
       $personal = static::where('matricula', $matricula)->first();
       if($personal){
         return $personal;
     }
    }return null;
  }
  public function sectores(){
    return $this->belongsToMany('App\Sector', 'personal_sector')
    ->withPivot('fecha','fecha_hasta');
  }
  public function sectorActual(){
    return $this->sectores()->wherePivot('fecha_hasta','=',null)->first();
  }
  public static function scopeAllBySectorName($query,$sector_name)
  {
    $personal=Personal::all();
    $personal_array=array();
    foreach($personal as $p){
      $sector=$p->sectorActual();
      if((!empty($sector))&&($sector->name==$sector_name)){
        array_push($personal_array,$p);
      }
    }return $personal_array;
  }

}
