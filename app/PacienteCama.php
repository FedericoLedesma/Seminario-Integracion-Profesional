<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PacienteCama extends Model
{
    protected $table = "pacientes_camas";

    protected $fillable = [
        'paciente_id', 'fecha', 'cama_id','habitacion_id','sector_id',
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

}
