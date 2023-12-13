<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PatologiaAlimentosProhibidos;
use Illuminate\Support\Facades\Log;

class Patologia extends Model
{
    //
    protected $table = "patologia";

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

    public function get_dietas(){return Dieta::where('patologia_id','=',$this->id)->get();}


    /**
     *
     *
     * @return dieta
     */

    public function get_dieta_activa_reciente(){
      return $this->get_dietas()->first()->get_activa_reciente();
    }

    /**
     *
     * @return Racion[]
     */

    public function get_raciones_por_patologia(){
      Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
      $raciones = $this->get_dieta_activa_reciente()->get_raciones();
      /*$ids = DB::table('dietas')
        ->join('dieta_activas','dieta_activas.dieta_id','=','dietas.id')
        ->where('dietas.patologia_id','=',$this->id)
        ->whereNull('dieta_activas.fecha_final')
        ->select('dietas.id')
        ->get();*/
      $prohibidas = $this->get_raciones_prohibidas();
      /*foreach($ids as $id){
        array_push($raciones, Dieta::findById($id)->get_raciones());
      }*/
      $res = array();
      foreach ($raciones as $racion) {
        $flag =true;
        foreach ($prohibidas as $prohibida) {
          if ($racion->get_id()==$prohibida->get_id()){
            $flag=false;
          }
        }
        if($flag==true){
          Log::Debug('Agregada: '.$racion);
          array_push($res,$racion);
        }
      }
      Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
      return $res;
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
         $rac_ali = PatologiaAlimentosProhibidos::get_racion_por_alimento($a,$this->id);
       }
       return $res;
     }

     public function personas()
     {
       return $this->belongsToMany('App\Persona', 'persona_patologia')
       ->withPivot('fecha','hasta')->wherePivot('hasta','=',null);
     }
     public function alimentos()
     {
       return $this->belongsToMany('App\Alimento', 'patologia_alimento_prohibido')
       ->withPivot('fecha');
     }
    public function dieta()
    {
      return $this->hasOne('App\Dieta');

    }

    public function tipoPatologia()
    {
      return $this->belongsTo('App\TipoPatologia', 'tipo_patologia_id');
    }
    public function get_tipo_patologia_id(){return $this->tipo_patologia_id;}
    public function get_tipo_patologia(){return TipoPatologia::find($this->get_tipo_patologia_id());}
    public function get_tipo_patologia_name(){return $this->get_tipo_patologia()->get_name();}
}
