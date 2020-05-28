<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cama;
use App\Paciente;

class PacienteCama extends Model
{
    protected $table = "paciente_cama";

    protected $fillable = [
        'id','paciente_id', 'fecha', 'fecha_fin', 'cama_id','habitacion_id','sector_id',
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
      return static::where('paciente_id','=',$id_paciente)
        ->orderBy('fecha', 'desc')
        ->get()
        ->first();
    }

    public function get_cama(){
      return Cama::buscar_por_id($this->cama_id);
    }

    public function get_habitacion(){
      return $this->get_cama()->get_habitacion();
    }

    public function get_sector(){
      return $this->get_cama()->get_sector();
    }

    public function get_paciente(){
      return Paciente::findById($this->paciente_id);
    }

    public static function buscar_pacientes($id_cama){
      $res = Array();
      $con = static::where('cama_id','=',$id_cama)->get();
      foreach ($con as $c) {
        array_push($res,$c->get_paciente());
      }
      return $res;
    }

    public static function buscar_paciente_actual($id_cama){
      #$res = Array();
      $con = static::where('cama_id','=',$id_cama)->orderBy('fecha','desc')->get()->first();
      #foreach ($con as $c) {
      if ($con<>null)
        return $con->get_paciente();
      else
        return null;
        #if ($p->is_internado()){
        #  array_push($res,$p);
        #}
      #}
      #return $res;
    }

    public function get_fecha_fin(){return $this->fecha_fin;}
    public static function cama_is_desocupada($cama_id){
      $res = true;
      $camas = static::where('cama_id','=',$cama_id)->get();
      foreach ($camas as $cama) {
        if ($cama->get_fecha_fin()==null)
          $res= false;
      }
      return $res;
    }

}
