<?php

namespace App\Informes;

use App\Informes\InformeRacion;
use App\Racion;

class InformeRacion_cantidad_de_raciones
{
  private _racion;
  private _cantidad;
  private _informe_racion;

  public function get_racion{
    return $this->_racion;
  }

  public function set_racion(Racion $racion){
    $this->_racion = $racion;
  }

  public function get_cantidad{
    return $this->_cantidad;
  }

  public function set_cantidad(int $cantidad){
    $this->_cantidad = $cantidad;
  }

  public function get_informe_racion{
    return $this->_informe_racion;
  }

  public function set_informe_racion(InformeRacion $informe_racion){
    $this->_informe_racion = $informe_racion;
  }

}
