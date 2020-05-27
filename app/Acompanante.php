<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paciente;

class Acompanante extends Model
{
  protected $table = "acompanante";

  protected $fillable = [
      'id', 'paciente_id','fecha',
  ];

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

}
