<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cama;
use App\Paciente;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PacienteCama extends Model
{
    protected $table = "paciente_cama";

    protected $fillable = [
        'id','paciente_id', 'fecha', 'fecha_fin', 'cama_id',/*'habitacion_id','sector_id',*/
    ];

    public static function findByPacienteFecha($paciente_id,$fecha)
    {
        if(($paciente_id)&&($fecha)){
           $pacienteCama = static::where('paciente_id', $paciente_id)
           ->where('fecha','=',$fecha)
           ->first();
           if($pacienteCama){
             return $pacienteCama;
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
    public function scopeFindByFecha($query,$fecha)
    {
      if($fecha){
        return $query->where('fecha',$fecha)
        ->orderBy('paciente_id', 'asc');
      }return null;
    }

    public static function buscar_ultima_cama_ocupada_por_paciente($id_paciente){
      Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__.' ID paciente: '.$id_paciente);
      $res = static::where('paciente_id','=',$id_paciente)
        ->orderBy('fecha', 'desc')
        ->get()
        ->first();
      Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__.' || resultado: '.$res);
      return $res;
    }

    public function get_cama(){
      return Cama::buscar_por_id($this->cama_id);
    }

    public function get_cama_id(){return $this->get_cama()->get_id();}

    public function get_habitacion(){
      return $this->get_cama()->get_habitacion();
    }

    public function get_habitacion_name(){
      return $this->get_cama()->get_habitacion_name();
    }

    public function get_sector(){
      return $this->get_cama()->get_sector();
    }

    public function get_sector_name(){
      return $this->get_cama()->get_sector_name();
    }

    public function get_paciente(){
  	  Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
      $paciente = Paciente::find($this->paciente_id);
      Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__.' se retorna: '.$paciente);
      return $paciente;
    }

    public static function buscar_paciente($id_cama){
      $res = Array();
      $con = static::where('cama_id','=',$id_cama)->get();
      foreach ($con as $c) {
        array_push($res,$c->get_paciente());
      }
      return $res;
    }

    public static function buscar_paciente_actual($id_cama){
  	  Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
        #$res = Array();
      $paciente_cama = static::where('cama_id','=',$id_cama)
    		->whereNull('fecha_fin')
    		->get()
    		->first();
        #foreach ($con as $c) {
      if ($paciente_cama<>null){
        Log::Debug('Revisando la relación paciente-cama: '.$paciente_cama);
        $paciente=$paciente_cama->get_paciente();
	      Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__.' se encontró un paciente: '.$paciente);
        return $paciente;
      }
      Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__.' NO se econtró un paciente');
      return null;

      /*}else{
		Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__.' NO se econtró un paciente');
        return null;*/
	  }
        #if ($p->is_internado()){
        #  array_push($res,$p);
        #}
      #}
      #return $res;
    #}

    public function get_fecha_egreso(){return $this->fecha_fin;}
    public static function cama_is_desocupada($cama_id){
      $camas = static::where('cama_id','=',$cama_id)
	  ->where('fecha_fin','=',null)
	  ->get()->count();
      return ($camas<=0);
    }

    public static function buscar_camas_por_paciente_entre_fechas($fecha_inicio, $fecha_fin, Paciente $paciente){
      if ($fecha_fin==null){
        $fecha_fin = Carbon::now()->toDateString();
      }
      return static::where('fecha','>=',$fecha_inicio)
        ->where('fecha','<=', $fecha_fin)
        ->orWhere([['fecha_fin','>=',$fecha_inicio],
        ['fecha_fin','<=', $fecha_fin]])
        ->get();
    }

    public static function buscar_habitaciones_por_paciente_entre_fechas($fecha_inicio, $fecha_fin, Paciente $paciente){
      $res = array();
      $camas = buscar_camas_por_paciente_entre_fechas($fecha_inicio, $fecha_fin, $paciente);
      foreach ($camas as $cama) {
        $x = $cama->get_habitacion();
        array_push($res,$x);
      }
      return $res;
    }

    public static function buscar_sectores_por_paciente_entre_fechas($fecha_inicio, $fecha_fin, Paciente $paciente){
      $res = array();
      $camas = buscar_camas_por_paciente_entre_fechas($fecha_inicio, $fecha_fin, $paciente);
      foreach ($camas as $cama) {
        $x = $cama->get_sector();
        array_push($res,$x);
      }
      return $res;
    }

    public static function buscar_camas_por_sector_name($sector_name){return Cama::buscar_por_sector_name($sector_name);}
    public function get_id(){return $this->id;}

    public static function dar_baja_por_paciente($paciente_id){
      $paciente_cama = static::where('paciente_id','=',$paciente_id)
        ->whereNull('fecha_fin')
        ->get();
      foreach ($paciente_cama as $pac_cam) {
        $pac_cam->fecha_fin = Carbon::now();
        $pac_cam->update();
      }
    }

    public static function create_from_paciente($habitacion, $paciente_id){
      /*$habitaciones = $habitacion->get_camas_desocupadas();
      $cama = $habitaciones[0];
      $new = new $pacienteCama([
        'paciente_id'=>$paciente_id,
        'fecha'=>Carbon::now(),
        'cama_id'=>$cama->get_id(),
      ]);
      $new->save();*/
      $paciente = Paciente::find($paciente_id);
      $habitacion->ingresar_paciente($paciente,Carbon::now());
    }

    public static function get_ultima_fecha_ingreso_por_paciente($paciente,$cama){
      $pac_cam = static::where('paciente_id','=',$paciente->get_id())
        ->where('cama_id','=',$cama->get_id())
        ->whereNull('fecha_fin')
        ->get()->first();
      return $pac_cam->fecha;
    }

    public function get_fecha_ingreso(){return $this->fecha;}

    public function get_persona(){
      Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
      $persona = Persona::find($this->get_id());
    	Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__.' con la persona: '.$persona);
      return $persona;
    }
    public function get_name(){return $this->get_paciente()->get_name();}
    public function get_apellido(){return $this->get_paciente()->get_apellido();}
    public function get_numero_doc(){return $this->get_paciente()->get_numero_doc();}
    public function get_observacion(){return $this->get_paciente()->get_observacion();}
    public function get_direccion(){return $this->get_paciente()->get_direccion();}
    public function get_email(){return $this->get_paciente()->get_email();}
    public function get_provincia(){return $this->get_paciente()->get_provincia();}
    public function get_localidad(){return $this->get_paciente()->get_localidad();}
    public function get_sexo(){return $this->get_paciente()->get_sexo();}
    public function get_fecha_nac(){return $this->get_paciente()->get_fecha_nac();}
    public function get_tipo_documento_id(){return $this->get_paciente()->get_tipo_documento_id();}
    public function get_tipo_documento(){return $this->get_paciente()->get_tipo_documento();}


    public static function all_inactive_with_cama_id($cama_id){
      return static::where('cama_id','=',$cama_id)->whereNotNull('fecha_fin')->get();
    }

    public static function get_paciente_cama_entre_fechas($f_ini,$f_fin,$paciente){
      return static::where([['fecha','>=',$f_ini],['paciente_id','=',$paciente->get_id()]])->
        orWhere([['fecha_fin','<=',$f_fin],['paciente_id','=',$paciente->get_id()]])->
        orderBy('fecha','DESC')->
        orderBy('fecha_fin','ASC')->
        get();
    }

    public function get_habitacion_id(){$this->get_cama()->get_habitacion_id();}
}
