<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HistoriaInternacion;
use App\Persona;
use App\PacienteCama;
use Illuminate\Support\Facades\Log;
use App\Acompanante;

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
  public static function findByNumeroDoc($numero_doc)
  {
    if($numero_doc){
      $persona=Persona::findByNumeroDoc($numero_doc);
      if(!(empty($persona))){
        try{
          return Paciente::findById($numero_doc);
        } catch (\Exception $e){
          return null;
        }
      }return null;
    }return null;
  }

  public static function get_pacientes_internados(){
    $historial = HistoriaInternacion::get_pacientes_internados();
    $res = Array();
    foreach($historial as $h){
      array_push($res,Paciente::find($h->paciente_id));
    }
    return $res;
  }

  public function get_cama(){
    Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
    return PacienteCama::buscar_ultima_cama_ocupada_por_paciente($this->id);
    Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
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

  public function persona()
  {
    return $this->belongsTo('App\Persona', 'id');
  }

  public function get_tipo_documento_name(){return $this->get_tipo_documento()->get_name();}


  public static function buscar_por_nombre_y_apellido($nombre_y_apellido){
    Log::debug('Buscando por nombre y apellido a '.$nombre_y_apellido);
    $pacientes = Array();
    //Separo todos los strings pasados separados por comas
    $campos = explode(' ',$nombre_y_apellido.' ',-1);
    Log::debug('String separado en '.implode($campos));
    foreach($campos as $campo){
      $res_no = static::buscar_por_nombre($campo);
      $res_ap = static::buscar_por_apellido($campo);
      $pacientes = $res_no + $res_ap;
      Log::debug('Campos de $persona: '.implode($pacientes));
    }
    return $pacientes;
  }

  public static function buscar_por_nombre($name)
  {
    Log::debug('Buscando por nombre a '.$name[0]);
    $res = array();
    $all = Persona::buscar_por_nombre($name);
    foreach ($all as $persona) {
      $paciente = static::find($persona->get_id());
      if ($paciente<>null){
        array_push($res,$paciente);
      }
    }
    return $res;
  }

  public static function buscar_por_apellido($apellido)
  {
    Log::debug('Buscando por apellido a '.$apellido);
    $res = array();
    $all = Persona::buscar_por_apellido($apellido);
    foreach ($all as $persona) {
      $paciente = static::find($persona->get_id());
      if ($paciente<>null){
        array_push($res,$paciente);
      }
    }
    return $res;
  }

  public static function buscar_por_dni($dni){
    Log::debug('Buscando por dni a '.$dni);
    $res = array();
    $all = Persona::buscar_por_numero_doc($dni);
    foreach ($all as $persona) {
      $paciente = static::find($persona->get_id());
      if ($paciente<>null){
        array_push($res,$paciente);
      }
    }
    return $res;
  }

  public function get_sector_actual(){return $this->get_cama()->get_sector();}
  public function get_sector_actual_name(){return $this->get_cama()->get_sector_name();}
  public function get_habitacion_actual(){return $this->get_cama()->get_habitacion();}
  public function get_habitacion_actual_name(){return $this->get_cama()->get_habitacion_name();}

  public function get_historial_sectores($fecha_inicio, $fecha_fin){
    return PacienteCama::buscar_sectores_por_paciente_entre_fechas($fecha_inicio, $fecha_fin, $this);
  }

  public function get_historial_habitaciones($fecha_inicio, $fecha_fin){
    return PacienteCama::buscar_habitaciones_por_paciente_entre_fechas($fecha_inicio, $fecha_fin, $this);
  }

  public function get_historial_camas($fecha_inicio, $fecha_fin){
    return PacienteCama::buscar_camas_por_paciente_entre_fechas($fecha_inicio, $fecha_fin, $this);
  }

  public static function buscar_por_nombre_sector($sector){
    $res = array();
    $all = static::all();
    foreach ($all as $paciente) {
      if ($paciente->pertenece_a_sector_like($sector)){
        array_push($res,$paciente);
      }
    }
    return $res;
  }

  public function pertenece_a_sector_like($sector){
    return ($sector == $this->get_sector_actual_name());
  }

  public static function get_pacientes_internados_por_nombre_sector($sector){
    $res = array();
    $internados = static::get_pacientes_internados();
    $camas = PacienteCama::buscar_camas_por_sector_name($sector);
    foreach ($internados as $paciente) {
      foreach ($camas as $cama) {
        if ($paciente->get_cama()->get_id()==$cama->get_id()){
          array_push($res,$paciente);
        }
      }
    }
    return $res;
  }

  public static function get_all_personas(){return Persona::all();}
  public function have_acompanante(){return ($this->get_acompanante_actual()<>null);}
  public function get_acompanante_actual(){return Acompanante::get_acompanante_actual($this->get_id());}
  public function get_acompanante_id(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_id();
    return -1;
  }
  public function get_acompanante_name(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_name();
    return 'Ninguno';
  }
  public function get_acompanante_apellido(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_apellido();
    return 'Ninguno';
  }
  public function get_acompanante_tipo_documento(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_tipo_documento();
    return null;
  }
  public function get_acompanante_tipo_documento_id(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_tipo_documento_id();
    return -1;
  }
  public function get_acompanante_tipo_documento_name(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_tipo_documento_name();
    return 'Ninguno';
  }
  public function get_acompanante_numero_doc(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_numero_doc();
    return 0;
  }
  public function get_acompanante_observacion(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_observacion();
    return 'Ninguna';
  }
  public function get_acompanante_direccion(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_direccion();
    return 'Ninguna';
  }
  public function get_acompanante_email(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_email();
    return 'Ninguno';
  }
  public function get_acompanante_provincia(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_provincia();
    return 'Ninguna';
  }
  public function get_acompanante_localidad(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_localidad();
    return 'Ninguna';
  }
  public function get_acompanante_sexo(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_sexo();
    return 'Ninguno';
  }
  public function get_acompanante_fecha_nac(){
    $acompanante = $this->get_acompanante_actual();
    if ($acompanante<>null)
      return $acompanante->get_fecha_nac();
    return 'Ninguna';
  }

  public function dar_alta_acompanante(){
    if ($this->have_acompanante()==true){
      $this->get_acompanante_actual()->dar_alta();
    }
  }
}
