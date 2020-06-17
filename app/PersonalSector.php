<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalSector extends Model
{
  protected $table = "personal_sector";

  protected $fillable = [
      'id', 'sector_id', 'personal_id','fecha','fecha_hasta',
  ];
  public $timestamps = false;

  public static function findByPacienteFecha($personal_id,$fecha)
  {
      if(($fecha)&&($personal_id)){
         $personal_sector = static::where('personal_id',$personal_id)
         ->where('fecha','=',$fecha)
         ->first();
         if($personal_sector){
           return $personal_sector;
       }
     }return null;
  }

  public function scopeFindBySectorFecha($query,$sector_id,$fecha)
  {
    if(($fecha)&&($sector_id)){
      return $query->where('sector_id',$sector_id)
      >where('fecha',$fecha)
      ->orderBy('personal_id', 'asc');
    }return null;
  }
  public function scopeFindByFecha($query,$fecha)
  {
    if($fecha){
      return $query->where('fecha',$fecha)
      ->orderBy('sector_id', 'asc');
    }return null;
  }

  public static function get_sector_reciente_por_personal_id($personal_id){
    $personal_sector = PersonalSector::where('personal_id','=',$personal_id)
      ->orderBy('fecha','DESC')
      ->get()->first();
    if($personal_sector<>null){
      return $personal_sector->get_sector();
    }
    return null;
  }

  public function get_sector(){return Sector::find($this->sector_id);}

}
