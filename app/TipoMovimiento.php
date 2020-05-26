<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movimiento;

class TipoMovimiento extends Model
{
    protected $table = "tipo_movimiento";

    protected $fillable = [
        'id', 'name', 'query',
    ];
    public static function findById($id)
    {
         $tipo_movimiento = static::where('id', $id)->first();
         if($tipo_movimiento){
           return $tipo_movimiento;
       } return null;
    }
    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name','LIKE','%'.$name.'%')
        ->orderBy('id', 'asc');
      }return null;
    }

    public function aplicar_movimiento(Movimiento $movimiento){

    }
}
