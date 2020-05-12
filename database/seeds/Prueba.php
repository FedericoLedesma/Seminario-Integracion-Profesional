<?php

use Illuminate\Database\Seeder;

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
        DB::table('tipo_dnis')->insert([
          'name'=>'dni',
        ]);
        DB::table('personas')->insert([
      			'name' => 'prueba',
            'dni'=>'1234',
            'apellido'=>'unlu',
            'direccion'=>'calle falsa',
            'email'=>'hola@gmail.com',
            'provincia'=>'Buenos aires',
            'localidad'=>'Lujan',
            'sexo'=>'M',
            'fecha_nac'=>'1997-08-02',
            'tipo_dni_id'=>'1',


      	]);


    }
}
