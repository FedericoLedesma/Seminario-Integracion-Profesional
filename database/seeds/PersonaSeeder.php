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
        $persona= Persona::findById(1);
        echo $persona->name;
        echo $persona->apellido;
    }
}