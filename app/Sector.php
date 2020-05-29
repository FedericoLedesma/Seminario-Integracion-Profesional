<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Sector extends Model
{
  protected $table = "sector";

  protected $fillable = [
      'id', 'name', 'descripcion',
  ];

  public function get_id(){return $this->id;}
  public function get_name(){return $this->name;}
  public function get_descripcion(){return $this->descripcion;}

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
    Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
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
    Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
    return $res;
  }

  public function get_pacientes(){
    Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
    $res = Array();
    $cam = $this->get_camas();
    foreach ($cam as $c) {
      Log::debug('Cama: '.$c);
      $p = $c->get_paciente();
      if ($p<>null){
        Log::debug('Paciente: '.$p);
        array_push($res,$p);
      }
    }
    Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
    return $res;
  }

  public function get_pacientes_internados(){
    Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__.' sector: '.$this->get_name());
    $res = Array();
    /*$cam = $this->get_camas();
    foreach ($cam as $c) {
      Log::debug('Get pacientes internados, cama: '.$c);
      $p = $c->get_pacientes_internados();
      Log::debug('Paciente: '.$p);
      if ($p<>null)
        $p = $p->get_persona();
        array_push($res,$p);
    }*/
    $habitaciones = Habitacion::buscar_por_sector($this->get_id());
    foreach ($habitaciones as $habitacion) {
      Log::debug(__CLASS__.' || método: '.__FUNCTION__.': Buscando en la habitacion '.$habitacion->get_name());
      $pacientes = $habitacion->get_pacientes_internados();
      foreach ($pacientes as $paciente) {
        Log::debug(__CLASS__.' || método: '.__FUNCTION__.': Agregando el paciente '.$paciente->get_name());
        array_push($res,$paciente);
      }
    }
    Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
    return $res;
  }

}
