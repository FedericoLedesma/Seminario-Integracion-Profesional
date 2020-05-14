<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\TipoDni;
use App\Patologia;
class Prueba extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      $personas=Persona::findByProvincia('buenos aires')->get();
      if($personas){
        foreach ($personas as $person) {
            echo $person->id;
            echo $person->dni;
            echo $person->name;

          // code...
        }
      }
    }
}