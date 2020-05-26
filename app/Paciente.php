<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HistoriaInternacion;
use App\Persona;
use App\PacienteCama;

class Paciente extends Model
{
  protected $table = "pacientes";

  protected $fillable = [
      'id',
  ];
  public static function findById(int $id)
  {
       $sector = static::where('id', $id)->first();
       if($sector){
         return $sector;
     } return null;
  }

  public static function get_pacientes_internados(){
    $historial = HistoriaInternacion::get_pacientes_internados();
    $res = Array();
    foreach($historial as $h){
      array_push($res,Persona::findById($h->paciente_id));
    }
    return $res;
  }

  public function get_cama(){
    return PacienteCama::buscar_ultima_cama_ocupada_por_paciente($this->id);
  }

  public function get_habitacion(){
    return $this->get_cama()->get_habitacion();
  }

  public function is_internado(){
    return HistoriaInternacion::is_internado($this->id);
  }

  public function get_persona(){
    return Persona::findById($this->id);
  }

}
