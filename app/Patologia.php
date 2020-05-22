<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PatologiaAlimentosProhibidos;

class Patologia extends Model
{
    //
    protected $table = "patologias";

    protected $fillable = [
        'id', 'name', 'descripcion', 'tipo_patologia_id',
    ];
    public static function findById(int $id)
    {
         $patologia = static::where('id', $id)->first();
         if($patologia){
           return $patologia;
       } return null;
    }

    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
      }return null;
    }

    public function scopeFindByTipoPatologia($query,$tipo_patologia_id)
    {
      if($tipo_patologia_id){
        return $query->where('tipo_patologia_id','LIKE','%'.$tipo_patologia_id.'%')->orderBy('id', 'asc');
      }return null;
    }

    public function delete(){
      $destroy = static::where('id', $this->id)->delete();

    }

    /**
     *
     *
     * @return dieta
     */

    public function get_dieta_activa_reciente(){
      $dieta = null;
      $ids = DB::table('dietas')
        ->join('dieta_activas','dieta_activas.dieta_id','=','dietas.id')
        ->where('dietas.patologia_id','=',$this->id)
        ->whereNull('dieta_activas.fecha_final')
        ->orderByRaw('fecha DESC')
        ->select('dietas.id')
        ->first();

      $dieta = Dieta::findById($ids);

      return $dieta;
    }

    /**
     *
     * @return Racion[]
     */

    public function get_raciones_por_patologia(){
      $raciones = array();
      $ids = DB::table('dietas')
        ->join('dieta_activas','dieta_activas.dieta_id','=','dietas.id')
        ->where('dietas.patologia_id','=',$this->id)
        ->whereNull('dieta_activas.fecha_final')
        ->select('dietas.id')
        ->get();

      foreach($ids as $id){
        array_push($raciones, Dieta::findById($id)->get_raciones());
      }

      return $raciones;
    }

    /**
     *
     * @return App\Alimento[]
     */

     public function get_alimentos_prohibidos(){
       $ali_pro = Array();
       $ali_pro = PatologiaAlimentosProhibidos::get_alimentos_por_patologia($this);
       return $ali_pro;
     }

    public function get_raciones_prohibidas(){
       $res = Array();
       $ali_pro = PatologiaAlimentosProhibidos::get_alimentos_por_patologia($this);
       foreach ($ali_pro as $a) {
         $rac_ali = PatologiaAlimentosProhibidos::get_racion_por_alimento($a);
       }
       return $res;
     }

     public function personas()
     {
       return $this->belongsToMany('App\Persona', 'personas_patologias')
       ->withPivot('fecha','hasta')->wherePivot('hasta','=',null);
     }

}
