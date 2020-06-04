<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patologia;
use App\Alimento;

class PatologiaAlimentosProhibidos extends Model
{
    protected $table = "patologia_alimento_prohibido";

    protected $fillable = [
        'id', 'patologia_id', 'alimento_id', 'fecha',
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

     public static function get_racion_por_alimento($alimento,$patologia_id){
        $res =array();
        $pat_ali = static::where('patologia_id','=',$patologia_id)->get();
        foreach ($pat_ali as $p_a) {
          $sub_total = $p_a->get_raciones();
          foreach ($sub_total as $racion) {
            array_push($res,$racion);
          }
        }
        return $res;
     }

     public function get_raciones(){
       return $this->get_alimento()->get_raciones();
     }

     public function get_alimento(){return Alimento::find($this->get_alimento_id());}
     public function get_alimento_id(){return $this->alimento_id;}
}
