<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sector;
use App\Cama;
use Illuminate\Support\Facades\Log;

class Habitacion extends Model
{
    //
    protected $table = "habitacion";

    protected $fillable = [
        'id','habitacion_id', 'sector_id','name','descripcion',
    ];
    public static function findById($id)
    {
        if($id){
           $habitacion = static::where('habitacion_id', $habitacion_id)
           ->where('id',$id)
           ->first();
           if($habitacion){
             return $habitacion;
         }
       }return null;
    }
    public static function findByIdSector($habitacion_id, $sector_id)
    {
        if(($habitacion_id)&&($sector_id)){
           $habitacion = static::where('habitacion_id', $habitacion_id)
           ->where('sector_id',$sector_id)
           ->first();
           if($habitacion){
             return $habitacion;
         }
       }return null;
    }

    public function scopeFindBySector($query,$sector_id)
    {
      if($sector_id){
        return $query->where('sector_id',$sector_id)
        ->orderBy('habitacion_id', 'asc');
      }return null;
    }
    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name',$name)
        ->orderBy('sector_id', 'asc');
      }return null;
    }

    public static function buscar_por_sector($id){
      return static::where('sector_id','=',$id)->get();
    }

    public static function buscar_por_id($id){
      return static::where('habitacion_id','=',$id)
        ->get()
        ->first();
    }

    public function get_sector(){
      return Sector::findById($this->sector_id);
    }

    public function get_camas(){
      return Cama::buscar_por_habitacion($this->habitacion_id);
    }

    public function get_pacientes(){
      $res = Array();
      $cam = $this->get_camas();
      foreach ($cam as $p) {
        array_push($res,$p->get_pacientes());
      }
      return $res;
    }

    public function get_pacientes_internados(){
      $res = Array();
      $cam = $this->get_camas();
      foreach ($cam as $p) {
        array_push($res,$p->get_pacientes_internados());
      }
      return $res;
    }

    public function get_sector_name(){return $this->get_sector()->get_name();}
    public function set_sector_id($sector_id){$this->sector_id=$sector_id;}
    public function get_id(){return $this->id;}
    public function get_name(){return $this->name;}
    public function get_cantidad_camas(){return Cama::contar_por_id_habitacion($this->get_id());}
    public function get_camas_desocupadas(){return Cama::buscar_camas_desocupadas_por_id_habitacion($this->get_id());}
    public function get_cantidad_camas_desocupadas(){return sizeof($this->get_camas_desocupadas());}
    public function set_cantidad_camas($cantidad){
      Log::debug('Se quiere cambiar la cantidad de camas de la habitacion '.$this->get_name().' a '.$cantidad);
      if ($cantidad<0)
        return false;
      $c = $this->get_cantidad_camas();
      Log::Debug('Cantidad de camas actual '.$c);
      if ($c<>$cantidad){
        if ($c>$cantidad){
          $camas_desocupadas = $this->get_camas_desocupadas();
          if (sizeof($camas_desocupadas)==0)
            return false;
          if (sizeof($camas_desocupadas)<($c-$cantidad)){
            $c = sizeof($camas_desocupadas);
          }
          else{
            $c -= $cantidad;
          }
          for ($i=0; $i<$c; $i++){
            Cama::borrar($camas_desocupadas[$i]);
          }
        }
        else{
          for ($i=0; $i<($cantidad-$c); $i++){
            $cama = new Cama(['habitacion_id'=>$this->get_id()]);
            $cama->save();
          }
        }
      }
      return true;
    }
}
