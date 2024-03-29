<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Patologia;

class PersonaPatologia extends Pivot
{
    protected $table = "persona_patologia";

    protected $fillable = [
        'id', 'patologia_id', 'persona_id', 'fecha',
    ];

    public $timestamps = false;

    public static function findByIdPersonaPatologiaFecha($patologia_id, $persona_id,$fecha)
    {
        if((($patologia_id)&&($persona_id))&&($fecha)){
           $personaPatologia = static::where('patologia_id', $patologia_id)
           ->where('persona_id',$persona_id)
           ->where('fecha','=',$fecha)
           ->first();
           if($personaPatologia){
             return $personaPatologia;
         }
       }return null;
    }
    public function scopeFindByPersona($query,$persona_id)
    {
      if($persona_id){
        return $query->where('persona_id',$persona_id)
        ->orderBy('fecha', 'asc');
      }return null;
    }

    public function scopeFindByPatologia($query,$patologia_id)
    {
      if($patologia_id){
        return $query->where('patologia_id',$patologia_id)
        ->orderBy('persona_id', 'asc');
      }return null;
    }
    //Deberia agregarse Fecha_final

    public function get_patologia(){return Patologia::find($this->patologia_id);}

}
