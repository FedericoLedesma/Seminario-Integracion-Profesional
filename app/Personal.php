<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PersonalSector;
use App\Persona;
use App\PersonalEspecialidad;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Personal extends Model
{
  protected $table = "personal";

  protected $fillable = [
      'id', 'matricula',
  ];
  public static function findById($id)
  {
      if($id){
         $personal = static::where('id', $id)->first();
         if($personal){
           return $personal;
       }
     }return null;
  }
  public static function buscar_por_numero_doc($dni){
    Log::debug('Buscando por dni a '.$dni);

    $all = Personal::all();
    foreach ($all as $personal) {
      if($personal->persona->numero_doc==$dni){
        return $personal;
      }
    }
  }
  public function persona()
  {
    return $this->belongsTo('App\Persona', 'id');
  }
  public static function findByMatricula($matricula)
  {
      if($matricula){
       $personal = static::where('matricula', $matricula)->first();
       if($personal){
         return $personal;
     }
    }return null;
  }
  public function sectores(){
    return $this->belongsToMany('App\Sector', 'personal_sector')
    ->withPivot('fecha','fecha_hasta');
  }
  public function sectorActual(){
    return $this->sectores()->wherePivot('fecha_hasta','=',null)->first();
  }
  public static function scopeAllBySectorName($query,$sector_name)
  {
    $personal=Personal::all();
    $personal_array=array();
    foreach($personal as $p){
      $sector=$p->sectorActual();
      if((!empty($sector))&&($sector->name==$sector_name)){
        array_push($personal_array,$p);
      }
    }return $personal_array;
  }


      public function get_id(){return $this->id;}
      public function get_persona(){
        $persona = Persona::find($this->get_id());
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
      public function get_tipo_documento_name(){return $this->get_persona()->get_tipo_documento_name();}

      public function get_sector(){
        return PersonalSector::get_sector_reciente_por_personal_id($this->get_id());
      }

      public function get_sector_name(){
        $sector = $this->get_sector();
        if ($sector<>null)
          {return $sector->get_name();}
        else
          {return 'Ninguno';}
      }

      public static function buscar_por_nombre($nombre){
        $all = Persona::buscar_por_nombre_y_apellido($nombre);
        $res = array();
        foreach ($all as $persona) {
          $personal = static::find($persona['id']);
          if ($personal<>null){
            array_push($res,$personal);
          }
        }
        return $res;
      }

      public static function buscar_por_dni($dni){
        $all = Persona::buscar_por_numero_doc($dni);
        $res = array();
        foreach ($all as $persona) {
          $personal = static::find($persona->get_id());
          if ($personal<>null){
            array_push($res,$personal);
          }
        }
        return $res;
      }

      public static function buscar_por_nombre_sector($sector_name){
        $all = static::all();
        $res = array();
        foreach ($all as $personal) {
          if ($personal->get_sector_name()==$sector_name){
            array_push($res,$personal);
          }
        }
        return $res;
      }

      public static function get_no_personal(){
        $res = array();
        $all = Persona::all();
        $personales = static::all();
        foreach ($all as $persona) {
          $flag=true;
          foreach ($personales as $personal) {
            if ($personal->get_id()==$persona->get_id()){
              $flag=false;
            }
          }
          if($flag==true){
            array_push($res,$persona);
          }
        }
        return $res;
      }

      public function reubicar_personal($sector){
        $per_sec = new PersonalSector([
          'personal_id'=>$this->get_id(),
          'sector_id'=>$sector->get_id(),
          'fecha'=>Carbon::now(),
        ]);
        $per_sec->save();
      }

      public function get_profesiones(){
        $res = array();
        $all = PersonalEspecialidad::buscar_por_personal_id($this->get_id());
        foreach ($all as $per_esp) {
          array_push($res,$per_esp->get_profesion());
        }
        return $res;
      }

      public function add_profesion($profesion){
        PersonalEspecialidad::create_by_personal_profesion($this,$profesion);
      }

      public function del_profesion($profesion){
        PersonalEspecialidad::destroy_by_personal_profesion($this,$profesion);
      }

}
