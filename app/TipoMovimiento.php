<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    protected $table = "tipos_movimientos";

    protected $fillable = [
        'id', 'name',
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
}
