<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paciente;
use Carbon\Carbon;
use App\Acompanante;

class HistoriaInternacion extends Model
{
  protected $table = "historia_internacion";

  protected $fillable = [
      'id', 'paciente_id', 'fecha_ingreso', 'peso', 'fecha_egreso',
  ];
  public static function findByPaciente($paciente_id,$fecha_ingreso)
  {
      if(($paciente_id)&&($fecha_ingreso)){
         $historiaInternacion = static::where('paciente_id', $paciente_id)
         ->where('fecha_ingreso','=',$fecha_ingreso)
         ->first();
         if($historiaInternacion){
           return $historiaInternacion;
       }
     }return null;
  }

  public function scopeFindByPaciente($query,$paciente_id)
  {
    if($paciente_id){
      return $query->where('paciente_id',$paciente_id)
      ->orderBy('fecha_ingreso', 'asc');
    }return null;
  }

  public function scopeFindByPacienteEntreFechas($query,$paciente_id,$fecha_desde,$fecha_hasta)
  {
    if((($paciente_id)&&($fecha_desde))&&($fecha_hasta)){
      return $query->where('paciente_id',$paciente_id)
      ->where('fecha_ingreso','>=',$fecha_desde)
      ->where('fecha_ingreso','<=',$fecha_hasta)
      ->orderBy('fecha_ingreso', 'asc');
    }return null;
  }

  public static function get_pacientes_internados(){
    return static::where('fecha_egreso','=',null)
             ->get();
  }

  public static function is_internado($id){
    $pac = static::where('fecha_egreso','=',null)
             ->where('paciente_id','=',$id)
             ->get();
    if ($pac<>null)
      return true;
    else
      return false;
  }

  public function is_paciente_internado(){return $this->get_fecha_egreso()==null;}
  public function get_fecha_egreso(){return $this->fecha_egreso;}
  public function set_fecha_egreso($fecha_egreso){$this->fecha_egreso=$fecha_egreso;}
  public function get_fecha_ingreso(){return $this->fecha_ingreso;}
  public function get_peso(){return $this->peso;}
  public function get_paciente_id(){return $this->paciente_id;}
  public function get_paciente_name(){return $this->get_paciente()->get_name();}
  //métodos delegados por parte de App\Paciente: <paciente_id>
  public function get_paciente(){return Paciente::find($this->get_paciente_id());}
  public function get_id(){return $this->id;}
  public function get_name(){return $this->get_paciente()->get_name();}
  public function get_apellido(){return $this->get_paciente()->get_apellido();}
  public function get_tipo_documento(){return $this->get_paciente()->get_tipo_documento();}
  public function get_tipo_documento_id(){return $this->get_paciente()->get_tipo_documento_id();}
  public function get_tipo_documento_name(){return $this->get_paciente()->get_tipo_documento_name();}
  public function get_numero_doc(){return $this->get_paciente()->get_numero_doc();}
  public function get_observacion(){return $this->get_paciente()->get_observacion();}
  public function get_direccion(){return $this->get_paciente()->get_direccion();}
  public function get_email(){return $this->get_paciente()->get_email();}
  public function get_provincia(){return $this->get_paciente()->get_provincia();}
  public function get_localidad(){return $this->get_paciente()->get_localidad();}
  public function get_sexo(){return $this->get_paciente()->get_sexo();}
  public function get_fecha_nac(){return $this->get_paciente()->get_fecha_nac();}
  public function get_paciente_persona(){return $this->get_paciente()->get_persona();}
      //métodos para acceder a información útil en la carga de historial
  public function get_sector_actual(){return $this->get_paciente()->get_sector_actual();}
  public function get_sector_actual_name(){return $this->get_paciente()->get_sector_actual_name();}
  public function get_habitacion_actual(){return $this->get_paciente()->get_habitacion_actual();}
  public function get_habitacion_actual_name(){return $this->get_paciente()->get_habitacion_actual_name();}

  public function get_historial_sectores(){return $this->get_paciente()->get_historial_sectores($this->get_fecha_ingreso(),$this->get_fecha_egreso());}
  public function get_historial_habitaciones(){return $this->get_paciente()->get_historial_habitaciones($this->get_fecha_ingreso(),$this->get_fecha_egreso());}
  public function get_historial_camas(){return $this->get_paciente()->get_historial_camas($this->get_fecha_ingreso(),$this->get_fecha_egreso());}
  public function have_acompanante(){return $this->get_paciente()->have_acompanante();}


  public static function buscar_pacientes_internados_por_nombre($nombre){
    $all = static::get_pacientes_internados();
    $res = array();
    $busqueda = Paciente::buscar_por_nombre_y_apellido($nombre);
    foreach ($all as $internado) {
      foreach ($busqueda as $pac) {
        if ($pac->get_id()==$internado->get_paciente_id()){
          array_push($res,$internado);
        }
      }
    }
    return $res;
  }

  public static function buscar_pacientes_internados_por_dni($dni){
    $all = static::get_pacientes_internados();
    $res = array();
    $busqueda = Paciente::buscar_por_dni($dni);
    foreach ($all as $internado) {
      foreach ($busqueda as $pac) {
        if ($pac->get_id()==$internado->get_paciente_id()){
          array_push($res,$internado);
        }
      }
    }
    return $res;
  }

  public static function buscar_pacientes_internados_por_nombre_sector($nombre){
    $res = array();
    $all = Paciente::get_pacientes_internados_por_nombre_sector($nombre);
    $internados = static::get_pacientes_internados();
    foreach ($internados as $internado) {
      foreach ($all as $paciente) {
        if($internado->get_paciente_id()==$paciente->get_id()){
          array_push($res,$internado);
        }
      }
    }
    return $res;
  }

  public function dar_alta(){
    $this->fecha_egreso=Carbon::now()->toDateString();
    $this->update();
    $this->get_paciente()->dar_alta();
  }

  public static function get_personas_no_internadas(){
    $all = Paciente::get_all_personas();
    $internados = static::get_pacientes_internados();
    $res = array();
    foreach ($all as $persona) {
      $flag = true;
      foreach ($internados as $internado) {
        if ($internado->get_paciente_id()==$persona->get_id()){
          $flag=false;
        }
      }
      if ($flag==true){
        array_push($res,$persona);
      }
    }
    return $res;
  }

  public function add_acompanante(Persona $persona){
    $acom = new Acompanante([
      'persona_id'=>$persona->get_id(),
      'paciente_id'=>$this->get_paciente_id(),
      'fecha'=>$this->get_fecha_ingreso(),
    ]);
    $acom->save();
  }


  public function get_acompanante(){return $this->get_paciente()->get_acompanante_actual();}
  public function get_acompanante_id(){return $this->get_paciente()->get_acompanante_id();}
  public function get_acompanante_name(){return $this->get_paciente()->get_acompanante_name();}
  public function get_acompanante_apellido(){return $this->get_paciente()->get_acompanante_apellido();}
  public function get_acompanante_tipo_documento(){return $this->get_paciente()->get_acompanante_tipo_documento();}
  public function get_acompanante_tipo_documento_id(){return $this->get_paciente()->get_acompanante_tipo_documento_id();}
  public function get_acompanante_tipo_documento_name(){return $this->get_paciente()->get_acompanante_tipo_documento_name();}
  public function get_acompanante_numero_doc(){return $this->get_paciente()->get_acompanante_numero_doc();}
  public function get_acompanante_observacion(){return $this->get_paciente()->get_acompanante_observacion();}
  public function get_acompanante_direccion(){return $this->get_paciente()->get_acompanante_direccion();}
  public function get_acompanante_email(){return $this->get_paciente()->get_acompanante_email();}
  public function get_acompanante_provincia(){return $this->get_paciente()->get_acompanante_provincia();}
  public function get_acompanante_localidad(){return $this->get_paciente()->get_acompanante_localidad();}
  public function get_acompanante_sexo(){return $this->get_paciente()->get_acompanante_sexo();}
  public function get_acompanante_fecha_nac(){return $this->get_paciente()->get_acompanante_fecha_nac();}
  public function get_acompanante_persona(){return $this->get_paciente()->get_acompanate_persona();}

  public function dar_alta_acompanante(){
    if ($this->have_acompanante()==true){
      $this->get_paciente()->dar_alta_acompanante();
    }
  }

  public function rehubicar_paciente($habitacion){return $this->get_paciente()->rehubicar_paciente($habitacion);}

  public static function get_historial_activo_por_paciente_id($paciente_id){
    $res = static::where('paciente_id','=',$paciente_id)
      ->whereNull('fecha_egreso')
      ->get();
    if ($res->count()>0){
      return $res->first();
    }
    else {
      return null;
    }
  }

  public function get_paciente_camas(){
    #if ($this->get_fecha_egreso()==null){
      #$f_egreso=Carbon::now();
    #}
    #else{
      $f_egreso=$this->get_fecha_egreso();
    #}
    return $this->get_paciente()->get_paciente_cama_entre_fechas($this->get_fecha_ingreso(),$f_egreso);
  }

  public function get_acompanantes(){return $this->get_paciente()->get_acompanante_entre_fechas($this->get_fecha_ingreso(),$this->get_fecha_egreso());}

  public static function get_historico_por_paciente($paciente){
    $res = static::where('paciente_id','=',$paciente->get_id())->
      whereNotNull('fecha_egreso')->
      orderBy('fecha_ingreso','DESC')->
      get();
    if ($res==null){
      $res = array();
    }
    return $res;
  }

}
