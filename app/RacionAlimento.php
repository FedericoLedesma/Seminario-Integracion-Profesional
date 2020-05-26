<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RacionAlimento extends Model
{
    protected $table = "racion_alimento";

    protected $fillable = [
        'id', 'racion_id', 'alimento_id', 'cantidad',
    ];
    public $timestamps = false;
    public static function findById($racion_id,$alimento_id)
    {
         $racion_alimento= static::where('racion_id', $racion_id)
         ->where('alimento_id', $alimento_id)
         ->first();
         if($racion_alimento){
           return $racion_alimento;
       } return null;
    }
    public function scopeFindByRacion($query,$racion_id)
    {
      if($racion_id){
        return $query->where('racion_id',$racion_id)
        ->orderBy('alimento_id', 'asc');
      }return null;
    }

    public function scopeFindByAlimento($query,$alimento_id)
    {
      if($alimento_id){
        return $query->where('alimento_id',$alimento_id)
        ->orderBy('racion_id', 'asc');
      }return null;
    }

    public static function get_lista_alimentos_por_id_racion($id_racion){
      $lista_racion_alimento = Array();
      try{
        $lista_racion_alimento = static::
          where('racion_id','=',$id_racion)->
          get();
      }
      catch(Throwable $e){

      }
      return $lista_racion_alimento;
    }

    public static function findBy_racion_id($racion_id)
    {
     $racion_alimento= static::where('racion_id', $racion_id)
      ->get();
     return $racion_alimento;
    }

    public static function delete_by_racion_id($racion_id){
      $lista = static::findBy_racion_id($racion_id);
      foreach($lista as $x){
        $x->where('racion_id','=',$x->racion_id)
        ->delete();
      }
    }

}
