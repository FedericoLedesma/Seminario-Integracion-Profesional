<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioRacion extends Model
{
    protected $table = "horario_racion";

    protected $fillable = [
        'horario_id', 'racion_id',
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



}
