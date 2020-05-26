<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Racion;
use App\Horario;

class HorarioRacion extends Model
{
    protected $table = "horarios_raciones";

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

    /**
    *
    Métodos de instancia
    *
    *
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
      return Horario::findById($this->horario_id);
    }

    public function get_horario_name(){
      return $this->get_horario()->name;
    }

    public function get_horario_id(){
      return $this->get_horario()->id;
    }
    public function racion(){
      return $this->belongsTo('App\Racion', 'racion_id');
    }
    public function horario(){
      return $this->belongsTo('App\Horario', 'horario_id');
    }


}
