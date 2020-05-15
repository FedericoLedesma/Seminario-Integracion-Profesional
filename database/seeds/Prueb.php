<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\TipoDni;
use App\Patologia;
use App\Horario;
use App\Racion;

class Prueb extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dni=TipoDni::create([
        'name'=>'dni',
      ]);
      $persona=Persona::create([
          'name' => 'p_prueba',
          'dni'=>'1253456',
          'apellido'=>'unlu',
          'direccion'=>'calle',
          'email'=>'prueb-a@gmail.com',
          'provincia'=>'Buenos aires',
          'localidad'=>'Lujan',
          'sexo'=>'M',
          'fecha_nac'=>'1997-08-05',
          'tipo_dni_id'=>'1',
        ]);
        $patologia=Patologia::create([
            'name' => 'patologia_1',

          ]);
      Racion::create([
        'name'=>'pollo',
        'observacion'=>'pollo con arroz',
      ]);
      Racion::create([
        'name'=>'guiso',
        'observacion'=>'guiso arroz',
      ]);
      Racion::create([
        'name'=>'fideos con tuco',
        'observacion'=>'fideos',
      ]);
      Horario::create([
        'name'=>'desayuno'
      ]);
      Horario::create([
        'name'=>'almuerzo'
      ]);
      Horario::create([
        'name'=>'merienda'
      ]);
      Horario::create([
        'name'=>'cena'
      ]);
    }
}
