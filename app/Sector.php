<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Sector extends Model
{
  protected $table = "sectores";

  protected $fillable = [
      'id', 'name', 'descripcion',
  ];
  public static function findById(int $id)
  {
       $sector = static::where('id', $id)->first();
       if($sector){
         return $sector;
     } return null;
  }
  public function scopeFindByName($query,$name)
  {
    if($name){
      return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
    }return null;
  }

  public function get_habitaciones(){
    return Habitacion::buscar_por_sector($this->id);
  }

  public function get_camas(){
    $res = Array();
    $hab = $this->get_habitaciones();
    foreach ($hab as $h) {
      Log::debug('Habitacion: '.$h);
      $cam = $h->get_camas();
      foreach ($cam as $c) {
        Log::debug('Cama: '.$c);
        array_push($res,$c);
      }
    }
    return $res;
  }

  public function get_pacientes(){
    $res = Array();
    $cam = $this->get_camas();
    foreach ($cam as $c) {
      Log::debug('Cama: '.$c);
      array_push($res,$c->get_pacientes());
    }
    return $res;
  }

  public function get_pacientes_internados(){
    $res = Array();
    $cam = $this->get_camas();
    foreach ($cam as $c) {
      Log::debug('Get pacientes internados, cama: '.$c);
      $p = $c->get_pacientes_internados();
        Log::debug('Paciente: '.$p);
      if ($p<>null)
        $p = $p->get_persona();
        array_push($res,$p);
    }
    return $res;
  }

}
