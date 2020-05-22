<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patologia;
use App\Alimento;

class PatologiaAlimentosProhibidos extends Model
{
    protected $table = "patologia_alimentos_prohibidos";

    protected $fillable = [
        'patologia_id', 'alimento_id', 'fecha',
    ];
    public static function findById($patologia_id,$alimento_id,$fecha)
    {
         $patologiaAlimentosProhibidos = static::where('patologia_id', $patologia_id)
         ->where('alimento_id', $alimento_id)
         ->where('fecha','=',$fecha)
         ->first();
         if($patologiaAlimentosProhibidos){
           return $patologiaAlimentosProhibidos;
       } return null;
     }
     public function scopeFindByPatologia($query,$patologia_id)
     {
       if($patologia_id){
         return $query->where('patologia_id',$patologia_id)
         ->orderBy('alimento_id', 'asc');
       }return null;
     }

     public static function get_alimentos_por_patologia(Patologia $patologia){
        $target = static::where('patologia_id','=',$patologia->id)->
          get();
        $res = Array();
        foreach($target as $t){
          array_push($res,Alimento::findById($t->alimento_id));
        }
        return $res;
     }

     function static get_raciones_prohibidas($alimento){
        return Alimento::get_raciones_prohibidas($alimento);
     }
}
