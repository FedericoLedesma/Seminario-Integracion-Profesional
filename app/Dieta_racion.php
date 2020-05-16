<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dieta_racion extends Model{

    protected $table = 'dieta_activa_racion';

    protected $fillable = [
        'dieta_id','racion_id','fecha'
    ];

    /**
     * @return Racion
     */
    public function get_racion(){
        $racion = null;
        $racion= Racion::find($this->id);
        return $racion;
    }

}