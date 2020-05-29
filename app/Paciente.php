<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HistoriaInternacion;
use App\Persona;
use App\PacienteCama;
use Illuminate\Support\Facades\Log;

class Paciente extends Model
{
  protected $table = "paciente";

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

  public function get_id(){return $this->id;}
  public function get_persona(){
    Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
    $persona = Persona::find($this->get_id());
  	Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__.' con la persona: '.$persona);
    return $persona;
  }
  public function get_name(){return $this->get_persona()->get_name();}
  public function get_apellido(){return $this->get_persona()->get_apellido();}
  public function get_numero_doc(){return $this->get_persona()->get_numero_doc();}
  public function get_observacion(){return $this->get_persona()->get_observacion();}
  public function get_direccion(){return $this->get_persona()->get_direccion();}
  public function get_email(){return $this->get_persona()->get_email();}
  public function get_provincia(){return $this->get_persona()->get_provincia();}
  public function get_localidad(){return $this->get_persona()->get_localidad();}
  public function get_sexo(){return $this->get_persona()->get_sexo();}
  public function get_fecha_nac(){return $this->get_persona()->get_fecha_nac();}
  public function get_tipo_documento_id(){return $this->get_persona()->get_tipo_documento_id();}
  public function get_tipo_documento(){return $this->get_persona()->get_tipo_documento();}

}
