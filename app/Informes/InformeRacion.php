<?php

namespace App\Informes;

use App\Informes\InformeRacion_cantidad_de_raciones;
use App\Racion;

class InformeRacion
{
  private _fecha_inicio;
  private _fecha_final;
  private _horario_inicio;
  private _horario_final;
  private _lista_informeRacion_cantidad_de_raciones;
  #private _id;

  function __construct() {
         $this->_lista_informeRacion_cantidad_de_raciones = Array();
  }

  public static function create_informe_racion($conjunto,$fecha_inicial, $fecha_final, $horario_inicial, $horario_final)
  {
    $informe = new InformeRacion;
    $informe->set_fecha_inicio($fecha_inicial);
    $informe->set_fecha_final($fecha_final);
    $informe->set_horario_inicio($horario_inicial);
    $informe->set_horario_final($horario_final);
    $flag = null;
    $c = 0;
    foreach ($conjunto as $menu) {
      if ($flag == null){
        $flag = $menu->get_racion();
      }
      if ($flag == $menu->get_racion()){
        $c++;
      }
      else{
        $x = new InformeRacion_cantidad_de_raciones;
        $x->set_racion($flag);
        $x->set_cantidad($c);
        $x->set_informe_racion($informe);
        $informe->add_racion_y_cantidad($x);
        $c = 0;
        $flag = $menu->get_racion();
      }
    }
    return $informe;
  }

  public function add_racion_y_cantidad($racion, int $cantidad)
  {
    if ($this->_lista_informeRacion_cantidad_de_raciones==null)
      $this->_lista_informeRacion_cantidad_de_raciones=Array();
    $inf_rac = new InformeRacion;
    $inf_rac->set_racion($racion);
    $inf_rac->set_cantidad($cantidad);
    $inf_rac->set_informe_racion($this);
    array_push($this->_lista_informeRacion_cantidad_de_raciones,$inf_rac);
  }

  public function get_fecha_inicio{
    return $this->_fecha_inicio;
  }

  public function set_fecha_inicio($fecha_inicio){
    $this->_fecha_inicio = $fecha_inicio;
  }

  public function get_fecha_final{
    return $this->_fecha_final;
  }

  public function set_fecha_final($fecha_final){
    $this->_fecha_final = $fecha_final;
  }

  public function get_horario_inicio{
    return $this->_horario_inicio;
  }

  public function set_horario_inicio($horario_inicio){
    $this->_horario_inicio = $horario_inicio;
  }

  public function get_horario_final{
    return $this->_horario_final;
  }

  public function set_horario_final($horario_final){
    $this->_horario_final = $horario_final;
  }
}
