<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paciente;
use App\Persona;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Acompanante extends Model
{
  protected $table = "acompanante";

  protected $fillable = [
      'id', 'paciente_id','fecha', 'persona_id','fecha_fin'
  ];
  public static function findById(int $id)
  {
       $acompanante = static::where('id', $id)->first();
       if($acompanante){
         return $acompanante;
     } return null;
  }
  public static function buscar_por_id(int $id){
    return static::where('id','=',$id)->get()->first();
  }

  public static function findByPaciente($paciente_id,$fecha)
  {
      if(($paciente_id)&&($fecha)){
         $acompanante = static::where('paciente_id', $paciente_id)
         ->where('fecha','=',$fecha)
         ->first();
         if($acompanante){
           return $acompanante;
       }
     }return null;
  }
  public function scopeFindByPaciente($query,$paciente_id)
  {
    if($paciente_id){
      return $query->where('paciente_id',$paciente_id)
      ->orderBy('fecha', 'asc');
    }return null;
  }
  public function scopeFindByPacienteEntreFechas($query,$paciente_id,$fecha_desde,$fecha_hasta)
  {
    if((($paciente_id)&&($fecha_desde))&&($fecha_hasta)){
      return $query->where('paciente_id',$paciente_id)
      ->where('fecha','>=',$fecha_desde)
      ->where('fecha','<=',$fecha_hasta)
      ->orderBy('fecha', 'asc');
    }return null;
  }

	/**
	*
	*
	* @return int id de acompañante, FK: id App\Persona
	*/
	public function get_id(){
		return $this->id;
	}

	/**
	*
	* @param int id del acompañante
	*
	* @return void
	*/
	public function set_id(int $id){
		$this->id = $id;
	}
	/**
	* Devuelve el paciente con el que está relacionado el acompañante.
	*
	* @return App\Paciente
	*/
	public function get_paciente(){
		return Paciente::find($this->paciente_id);
	}
/**
*
* @param {App\Paciente} $paciente, el paciente con que se relacionará el acompañante
*
* @return void
*/
	public function set_paciente(Paciente $paciente){
		$this->set_paciente_id($paciente->get_id());
	}
	/**
	* Devuelve el ID del paciente con el que se relaciona el acompañante
	*
	* @return {int}
	*/
	public function get_paciente_id(){
		return $this->paciente_id;
	}
	/**
	*  Setter del ID del paciente de acompañante
	*
	* @param {int} paciente_id
	*
	* @return void
	*/
	public function set_paciente_id(int $paciente_id){
		$this->paciente_id = $paciente_id;
	}
	/**
	*
	*
	* @return {fecha}
	*/
	public function get_fecha(){
		return $this->fecha;
	}
	/**
	*
	* @param {} $fecha
	*
	* @return
	*/
	public function set_fecha($fecha){
		$this->fecha = $fecha;
	}

	/**
   * Devuelve la cama que ocupa el paciente a quien acompaña
   * @return App\Cama [description]
   */
	public function get_cama(){
		return $this->get_paciente()->get_cama();
	}

  public static function get_acompanante_actual($paciente_id){
    $acompanante = static::where('paciente_id','=',$paciente_id)
      ->whereNull('fecha_fin')
      ->orderBy('fecha','DESC')
	  ->get();
    if ($acompanante->count()>0){
      return $acompanante->first();
    }
    return null;
  }

  public function get_acompanante_id(){return $this->persona_id;}
  public function get_persona(){
    Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
    $persona = Persona::find($this->get_acompanante_id());
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

  public function dar_alta(){
    $this->fecha_fin = Carbon::now();
    $this->update();
  }
  public function paciente(){

    return $this->belongsTo('App\Paciente', 'paciente_id');

  }
  public function persona(){
    return $this->belongsTo('App\Persona', 'persona_id');
  }
  public function sector(){
    return $this->paciente()->sectorActual();
  }
  public function sectorFecha($fecha){
    return $this->paciente->camasFecha($fecha)->habitacion->sector;
  }
  public function habitacionFecha($fecha){
    return $this->paciente->camasFecha($fecha)->habitacion;
  }

  public function get_historial_internacion_activo(){
    return $this->get_persona()->get_historial_internacion_activo();
  }

  public static function get_entre_fechas_por_paciente($f_ini,$f_fin,$paciente){
    $res = array();
    if ($f_fin==null){
      $all = static::where('fecha','>=',$f_ini)->
        orWhereNull('fecha_fin')->
        where('paciente_id','=',$paciente->get_id())->
        orderBy('fecha_fin','ASC')->
        get();
    }
    else{
      $all = static::where('fecha','>=',$f_ini)->
        where('paciente_id','=',$paciente->get_id())->
        where('fecha','<=',$f_ini)
        ->get();
    }
    foreach ($all as $acomp) {
      array_push($res,$acomp);
    }
    return $res;
  }

  public function get_fecha_egreso(){return $this->fecha_fin;}

  public static function get_por_persona($persona){
    return static::where('persona_id','=',$persona->get_id())->get();
  }

  public static function getByPersonaID($persona_id){
    return static::where('persona_id','=',$persona_id)->get();
  }
}
