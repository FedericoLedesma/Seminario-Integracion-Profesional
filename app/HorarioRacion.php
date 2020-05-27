<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Racion;
use App\Horario;

class HorarioRacion extends Model
{
    protected $table = "horario_racion";

    protected $fillable = [
        'id','horario_id', 'racion_id',
    ];
    public $timestamps = false;
    public static function findById($horario_id,$racion_id)
    {
         $horarioRacion = static::where('horario_id', $horario_id)
         ->where('racion_id', $racion_id)
         ->first();
         if($horarioRacion){
           return $horarioRacion;
       } return null;
    }
    public function scopeFindByHorario($query,$horario_id)
    {
      if($horario_id){
        return $query->where('horario_id',$horario_id)
        ->orderBy('racion_id', 'asc');
      }return null;
    }

    public function scopeFindByRacion($query,$racion_id)
    {
      if($racion_id){
        return $query->where('racion_id',$racion_id)
        ->orderBy('horario_id', 'asc');
      }return null;
    }

    public static function buscar_por_id_horario($horario_id){
      return static::where('horario_id','=',$horario_id)->get();
    }

    public static function buscar_por_id_racion($racion_id){
      return static::where('racion_id','=',$racion_id)->get();
    }

    public static function buscar_por_horario($horario){
      return static::where('horario_id','=',$horario->get_id())->get();
    }

    public static function buscar_por_racion($racion){
      return static::where('racion_id','=',$racion->get_id())->get();
    }

    /**
    *
    Métodos de instancia
    *
    *
    */

    public function get_horario_racion_id(){
      return $this->id;
    }
    /**
     * Devuelve un objeto del tipo App\Racion
     * @return App\Racion [devuelve la ración asosiada al horario de este objeto]
     */
    public function get_racion(){
      return Racion::findById($this->racion_id);
    }

    public function get_racion_name(){
      return $this->get_racion()->name;
    }

    public function get_racion_id(){
      return $this->get_racion()->id;
    }

    public function get_horario(){
      return $this->horario;
    }

    public function get_horario_name(){
      return $this->get_horario()->name;
    }
    public function get_horario_id(){
      return $this->horario->id;
    }
    public function racion(){
      return $this->belongsTo('App\Racion', 'racion_id');
    }
    public function horario(){
      return $this->belongsTo('App\Horario', 'horario_id');
    }

    public function get_id(){
      return $this->id;
    }

    public function set_id(int $id){
      $this->id = $id;
    }

    public function set_horario(Horario $horario){
      $this->horario_id = $horario->get_id();
    }

    public function set_racion(Racion $racion){
      $this->racion_id = $racion->get_id();
    }


}
