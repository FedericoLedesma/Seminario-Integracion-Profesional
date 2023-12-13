<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Persona;
use App\Personal;
use App\TipoDocumento;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use App\Racion;
use App\Alimento;
use App\Horario;
use App\Paciente;
use App\Acompanante;
use App\Sector;
use App\Cama;
use App\PacienteCama;
use App\Habitacion;
use App\HorarioRacion;
use App\RacionesDisponibles;
use App\Unidad;
use Illuminate\Support\Facades\Log;
use App\HistoriaInternacion;
#use Database\Menu_personaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $tipo_doc=TipoDocumento::create([
        'name'=>'DNI',
      ]);
      $persona = Persona::create([
          #'id'=>1,
          'name'=>'Federico',
          'apellido'=>'Admin',
          'tipo_documento_id'=>$tipo_doc->id,
          'numero_doc'=>40000000,
          'direccion'=>'Lavalle 1506',
          'email'=>'admin@seminario.com',
          'provincia'=>'Buenos Aires',
          'localidad'=>'General Rodriguez',
          'sexo'=>'Masculino',
          'fecha_nac'=>'1997-02-02'
      ]);
      $personal=Personal::create([
        'id'=>$persona->id,
      ]);
        // $this->call(UsersTableSeeder::class);
    	DB::table('users')->insert([
    			'dni' => '40000000',
				  'personal_id'=>1,
    			'password'=>bcrypt('12345678'),

    	]);
    	DB::table('roles')->insert([
    			'name' => 'Super-User',
    			'guard_name'=>'web',
    	]);

      $acciones = ['alta','baja','modificacion','ver'];
      $tablas = ['usuarios','roles','patologias','permisos','personas','raciones','alimentos',
      'tipos-patologias','raciones-disponibles','sectores','historial','menu','camas',
      'profesion','personal'];

      foreach ($acciones as $accion) {
        foreach ($tablas as $tabla) {
          Permission::create([
        			'name' => $accion.'_'.$tabla,
        			'guard_name'=>'web',
        	]);
        }
      }
      //--------Tipos de Movimientos----------------------
      DB::table('tipo_movimiento')->insert([
          'name' => 'Agregar al stock',
      ]);
      DB::table('tipo_movimiento')->insert([
          'name' => 'Entregar racion (descontar)',
      ]);
  	  $user=User::find('1');
  	  $role=Role::create(['name'=>'Administrador']);
  	  $permisos=Permission::all();
  	  foreach($permisos as $permiso){
  		  $role->givePermissionTo($permiso);
  	  }
  	  $user->assignRole('Administrador');
/*
		$this->call([
			Menu_personaSeeder::class
		]);*/

    static::cargar_menu_persona();

	}

  /*public static function cargar_admin_y_permisos(){
  User::create([
        'dni' => '1234',
        'name'=>'admin',
        'password'=>bcrypt('12345678'),

    ]);
    Role::create([
        'name' => 'Super-User',
        'guard_name'=>'web',
    ]);

    Permission::create([
        'name' => 'alta_usuarios',
        'guard_name'=>'web',
    ]);
    Permission::create([
        'name' => 'ver_usuarios',
        'guard_name'=>'web',
    ]);

    Permission::create([
        'name' => 'modificacion_usuarios',
        'guard_name'=>'web',
    ]);
    Permission::create([
        'name' => 'baja_usuarios',
        'guard_name'=>'web',
    ]);

    Permission::create([
        'name' => 'alta_roles',
        'guard_name'=>'web',
    ]);
    Permission::create([
        'name' => 'baja_roles',
        'guard_name'=>'web',
    ]);
    Permission::create([
        'name' => 'modificacion_roles',
        'guard_name'=>'web',
    ]);
    Permission::create([
        'name' => 'ver_roles',
        'guard_name'=>'web',
    ]);

    Permission::create([
        'name' => 'alta_permisos',
        'guard_name'=>'web',
    ]);
    Permission::create([
        'name' => 'baja_permisos',
        'guard_name'=>'web',
    ]);

    Permission::create([
        'name' => 'ver_permisos',
        'guard_name'=>'web',
    ]);

    Permission::create([
    'name' => 'ver_menu_persona',
    'guard_name'=>'web',
    ]);

    Permission::create([
    'name' => 'modificacion_menu_persona',
    'guard_name'=>'web',
    ]);

    Permission::create([
    'name' => 'alta_menu_persona',
    'guard_name'=>'web',
    ]);

    Permission::create([
    'name' => 'baja_menu_persona',
    'guard_name'=>'web',
    ]);

    $user=User::find('1');
    $role=Role::create(['name'=>'Administrador']);
    $permisos=Permission::all();
    foreach($permisos as $permiso){
    $role->givePermissionTo($permiso);
    }
    $user->assignRole('Administrador');
  }*/
  private static function cargar_raciones_ali(){
    $r1 = Racion::create([
      'name'=>'Churrasco con fideos',
    ]);

    $r2 = Racion::create([
      'name'=>'Milanesas con pure de papas',
    ]);

    $r3 = Racion::create([
      'name'=>'Pizza de cebolla',
    ]);

    $r4 = Racion::create([
      'name'=>'Té con galletitas de agua',
    ]);

    $r5 = Racion::create([
      'name'=>'Gelatina de frutilla',
    ]);

    $r6 = Racion::create([
      'name'=>'Sopa',
    ]);
    $r7 = Racion::create([
      'name'=>'Ensalada de pollo con espinaca',
    ]);
    $r8 = Racion::create([
      'name'=>'Pata de pollo con pure de papa',
    ]);

    $r9 = Racion::create([
      'name'=>'Pata de pollo con pure de batata',
    ]);

    $r10 = Racion::create([
      'name'=>'Pechuga de pollo con pure zapallo y aceite de oliva',
    ]);

    $r11 = Racion::create([
      'name'=>'Pollo con arroz',
    ]);

    $r12 = Racion::create([
      'name'=>'Salmón al horno con pure',
    ]);

    $r13 = Racion::create([
      'name'=>'Manzana rallada',
    ]);

    $r14 = Racion::create([
      'name'=>'Jugo de naranja',
    ]);

    $r15 = Racion::create([
      'name'=>'Tarta de acelga',
    ]);

    $r16 = Racion::create([
      'name'=>'Churrasco con ensalada de pepino',
    ]);

    $r17 = Racion::create([
      'name'=>'Matecocido con galletitas',
    ]);

    $r18 = Racion::create([
      'name'=>'Matecocido con galletitas',
    ]);

    $r19 = Racion::create([
      'name'=>'Leche con cereal sin azúcar',
    ]);

    $a1 = Alimento::create([
      'name'=>'Lechuga'
    ]);

    $a2 = Alimento::create([
      'name'=>'Carne de vaca'
    ]);

    $a3 = Alimento::create([
      'name'=>'Galletitas de agua'
    ]);

    $a4 = Alimento::create([
      'name'=>'Cebolla'
    ]);

    $a5 = Alimento::create([
      'name'=>'Fideos'
    ]);

    $a6 = Alimento::create([
      'name'=>'Mermelada'
    ]);
    $u= Unidad::create([
      'name'=>'Kilogramos'
    ]);
    $u2= Unidad::create([
      'name'=>'Gramos'
    ]);
    $u3= Unidad::create([
      'name'=>'Litros'
    ]);
    $alimentos = ['Pollo','Pescado','Arroz integral','Avena integral','Quinoa','Maiz integral','Manzana','Naranja',
    'Pera','Espinaca','Acelga','Repollo','Zanahoria','Pepino','Zapallo','Papa','Tomate','Queso','Leche descremada',
    'Leche de almendras','Yogurt','Leche de soja','Leche de avena','Matecocido','Te','Pan (con sal)','Pure de tomate', 
    'Morron','Pan (sin sal)','Banana','Aceite de oliva','Azucar','Lentejas','Garbanzos','Batata','Cereal (sin azucar)',
    'Cereal (con azucar)'];
    foreach ($alimentos as $x) {
      $alimento = Alimento::create([
        'name' => $x,
      ]);
    }
    $r1->add_alimento($a2,100,$u2->id);
    $r1->add_alimento($a5,100,$u2->id);
    $r2->add_alimento($a2,200,$u2->id);
    $r3->add_alimento($a4,200,$u2->id);
    $r4->add_alimento($a3,200,$u2->id);
    $r5->add_alimento($a3,200,$u2->id);
    $r5->add_alimento($a6,200,$u2->id);
    $r6->add_alimento($a1,200,$u2->id);
    $r6->add_alimento($a4,200,$u2->id);

  }

  private static function cargar_horarios(){
    $data = [
      'name'=>'Desayuno'
    ];
    $h1 = new Horario($data);
    $h1->save();
    $data = [
      'name'=>'Colación'
    ];
    $h2 = new Horario($data);
    $h2->save();
    $data = [
      'name'=>'Almuerzo'
    ];
    $h3 = new Horario($data);
    $h3->save();
    $data = [
      'name'=>'Merienda'
    ];
    $h4 = new Horario($data);
    $h4->save();
    $data = [
      'name'=>'Cena'
    ];
    $h5 = new Horario($data);
    $h5->save();
  }

  private static function cargar_tipo_documentos(){

    $data =[
      'name'=>'Libreta Cívica'
    ];
    $t2 = new TipoDocumento($data);
    $t2->save();
    $data =[
      'name'=>'Indocumentado'
    ];
    $t3 = new TipoDocumento($data);
    $t3->save();
    $data =[
      'name'=>'Pasaporte'
    ];
    $t4 = new TipoDocumento($data);
    $t4->save();
    $data =[
      'name'=>'Libreta Enrolamiento'
    ];
    $t5 = new TipoDocumento($data);
    $t5->save();
    $data =[
      'name'=>'CUIL'
    ];
    $t6 = new TipoDocumento($data);
    $t6->save();
    $data =[
      'name'=>'CI Extranjeros'
    ];
    $t7 = new TipoDocumento($data);
    $t7->save();
  }

  private static function cargar_personas(){
    static::cargar_tipo_documentos();
    $data = [
      'numero_doc'=>31241573,
      'apellido'=>'Aguirre',
      'name'=>'Andres',
      'observacion'=>'OK',
      'direccion'=>'Independencia 601',
      'email'=>'andres@test.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Moreno',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1960-5-5',
      'tipo_documento_id'=>1,
    ];
    $p1 = new Persona($data);
    $p1->save();
    $data = [
      'numero_doc'=>34154498,
      'apellido'=>'Arbo',
      'name'=>'Cecilia',
      'observacion'=>'OK',
      'direccion'=>'Rivadavia 36001',
      'email'=>'lopez.juan@test.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Merlo',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1960-2-8',
      'tipo_documento_id'=>1,
    ];
    $p2 = new Persona($data);
    $p2->save();
    $data = [
      'numero_doc'=>16582895,
      'apellido'=>'Arduino',
      'name'=>'Mario Eugenio',
      'observacion'=>'OK',
      'direccion'=>'Balcarce 606',
      'email'=>'arduinoma@test.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Merlo',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1985-2-2',
      'tipo_documento_id'=>1,
    ];
    $p3 = new Persona($data);
    $p3->save();
    $data = [
      'numero_doc'=>22576032,
      'apellido'=>'Baioni',
      'name'=>'Gabriela Roberta',
      'observacion'=>'OK',
      'direccion'=>'Libertad 2548',
      'email'=>'Baionig@test.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Luján',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1989-5-5',
      'tipo_documento_id'=>1,
    ];
    $p4 = new Persona($data);
    $p4->save();
    $data = [
      'numero_doc'=>13214174,
      'apellido'=>'Fernandez',
      'name'=>'Maria',
      'observacion'=>'Ok',
      'direccion'=>'Calle 14 N°.355',
      'email'=>'-',
      'provincia'=>'Buenos Aires',
      'localidad'=>'San Andrés de Giles',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1979-2-15',
      'tipo_documento_id'=>1,
    ];
    $p5 = new Persona($data);
    $p5->save();
    $data = [
      'numero_doc'=>24618959,
      'apellido'=>'Barcos',
      'name'=>'Pedro',
      'observacion'=>'Ok',
      'direccion'=>'-',
      'email'=>'-',
      'provincia'=>'-',
      'localidad'=>'-',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1965-11-8',
      'tipo_documento_id'=>1,
    ];
    $p6 = new Persona($data);
    $p6->save();
    $data = [
      'numero_doc'=>12566554,
      'apellido'=>'Benitez',
      'name'=>'Verónica',
      'observacion'=>'-',
      'direccion'=>'Juan Manuel de Rosas 456',
      'email'=>'veronica@gmail.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Luján',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1995-12-12',
      'tipo_documento_id'=>3,
    ];
    $p7 = new Persona($data);
    $p7->save();
    $data = [
      'numero_doc'=>95531632,
      'apellido'=>'Berge',
      'name'=>'Pamela',
      'observacion'=>'OK',
      'direccion'=>'La Pinta 287',
      'email'=>'pamela@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Morón',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1990-5-5',
      'tipo_documento_id'=>1,
    ];
    $p8 = new Persona($data);
    $p8->save();
    $data = [
      'numero_doc'=>12647194,
      'apellido'=>'Oliverti',
      'name'=>'Ricardo',
      'observacion'=>'OK',
      'direccion'=>'Pueyrredón 600',
      'email'=>'oliverti@test.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Jauregui',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1990-5-5',
      'tipo_documento_id'=>1,
    ];
    $p9 = new Persona($data);
    $p9->save();
    $data = [
      'numero_doc'=>19325205,
      'apellido'=>'Gomez',
      'name'=>'Fabián',
      'observacion'=>'OK',
      'direccion'=>'San Martín 1245',
      'email'=>'fabian@yahoo.com.ar',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Moreno',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1989-7-2',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>16809531,
      'apellido'=>'Benitez',
      'name'=>'Carlos',
      'observacion'=>'OK',
      'direccion'=>'El Facón 1245',
      'email'=>'benitezzz@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'General Rodriguez',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1977-7-27',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>17448901,
      'apellido'=>'Mallo',
      'name'=>'Marcos Agustín',
      'observacion'=>'OK',
      'direccion'=>'El Amanecer 145',
      'email'=>'malloyo@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'General Rodriguez',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1987-7-25',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>20987908,
      'apellido'=>'Pighin',
      'name'=>'Nelida Clara',
      'observacion'=>'OK',
      'direccion'=>'El Pericón 4564',
      'email'=>'nelidacp@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Marcos Paz',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1998-5-27',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>21040557,
      'apellido'=>'Perez',
      'name'=>'Julio Andres',
      'observacion'=>'OK',
      'direccion'=>'CARLOS PELLEGRINI 198',
      'email'=>'perezjulio@gmail.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Moreno',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1980-10-5',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>21399214,
      'apellido'=>'Massa',
      'name'=>'Dolores Guadalupe',
      'observacion'=>'OK',
      'direccion'=>'Agüero 457',
      'email'=>'massaaguero@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Moreno',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1979-9-13',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>17448901,
      'apellido'=>'Menseguez',
      'name'=>'Lucía Laura',
      'observacion'=>'OK',
      'direccion'=>'Jose C. Paz 544',
      'email'=>'menseguez12@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'General Rodriguez',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1989-9-7',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>17448901,
      'apellido'=>'Brandan',
      'name'=>'Celia',
      'observacion'=>'OK',
      'direccion'=>'Piedras 1245',
      'email'=>'brandancelia@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'General Rodriguez',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1977-7-27',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>16821037,
      'apellido'=>'Brasili',
      'name'=>'Fernando',
      'observacion'=>'OK',
      'direccion'=>'Vidt 1245',
      'email'=>'brasili@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Lobos',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1978-7-17',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>13285797,
      'apellido'=>'Bruno',
      'name'=>'Sebastian Leandro',
      'observacion'=>'OK',
      'direccion'=>'Pinciroli 4578',
      'email'=>'bruno@gmail.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'General Rodriguez',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1997-7-27',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>27033530,
      'apellido'=>'Valero',
      'name'=>'Cesar Josué',
      'observacion'=>'OK',
      'direccion'=>'Sarmiento 9852',
      'email'=>'sarmiento@hotmail.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'General Rodriguez',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1992-2-15',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>18860528,
      'apellido'=>'Telias',
      'name'=>'Esteban Hernan',
      'observacion'=>'OK',
      'direccion'=>'Almirante Brown 192',
      'email'=>'hernan@hotmail.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Marcos Paz',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1991-2-19',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>24834180,
      'apellido'=>'Torres',
      'name'=>'Maria José',
      'observacion'=>'OK',
      'direccion'=>'Constitución 1233',
      'email'=>'torresmj@hotmail.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Marcos Paz',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1996-2-15',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>26725275,
      'apellido'=>'Sotelo',
      'name'=>'Natalia María',
      'observacion'=>'OK',
      'direccion'=>'Avellaneda 1230',
      'email'=>'soteloa@yahoo.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'General Rodriguez',
      'sexo'=>'Femenino',
      'fecha_nac'=>'1994-8-2',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
    $data = [
      'numero_doc'=>14490519,
      'apellido'=>'Tolosa',
      'name'=>'Marcos Román',
      'observacion'=>'OK',
      'direccion'=>'El mate 2154',
      'email'=>'toledomg@hotmail.com',
      'provincia'=>'Buenos Aires',
      'localidad'=>'Merlo',
      'sexo'=>'Masculino',
      'fecha_nac'=>'1985-2-2',
      'tipo_documento_id'=>1,
    ];
    $p10 = new Persona($data);
    $p10->save();
  }

  private static function cargar_personal_y_pacientes(){
    static::cargar_personas();
    /*$data = [
      'id'=>1,
      'matricula'=>11111111
    ];
    $p1 = new Personal($data);
    $p1->save();*/
    $data = [
      'id'=>2,
      'matricula'=>22222222
    ];
    $p2 = new Personal($data);
    $p2->save();
    $data = [
      'id'=>3,
      'matricula'=>33333333
    ];
    $p3 = new Personal($data);
    $p3->save();
    $data = [
      'id'=>4,
      'matricula'=>44444444
    ];
    $p4 = new Personal($data);
    $p4->save();
    $data = [
      'id'=>5
    ];
    $p5 = new Paciente($data);
    $p5->save();
    $data = [
      'id'=>6
    ];
    $p6 = new Paciente($data);
    $p6->save();
    $data = [
      'id'=>7
    ];
    $p7 = new Paciente($data);
    $p7->save();
    $data = [
      'id'=>8
    ];
    $p8 = new Paciente($data);
    $p8->save();
    $data = [
      'id'=>9
    ];
    $p9 = new Paciente($data);
    $p9->save();
    $data = [
      'id'=>10
    ];
    $p10= new Paciente($data);
    $p10->save();
  }

  private static function cargar_horario_racion(){
    static::cargar_raciones_ali();
    static::cargar_horarios();
    $data =[
      'racion_id'=>1,
      'horario_id'=>3
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>1,
      'horario_id'=>5
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>2,
      'horario_id'=>3
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>2,
      'horario_id'=>5
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>3,
      'horario_id'=>3
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>3,
      'horario_id'=>5
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>4,
      'horario_id'=>1
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>4,
      'horario_id'=>2
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>4,
      'horario_id'=>4
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>5,
      'horario_id'=>1
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>5,
      'horario_id'=>2
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>5,
      'horario_id'=>4
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>6,
      'horario_id'=>1
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>6,
      'horario_id'=>2
    ];
    $r = new HorarioRacion($data);
    $r->save();
    $data =[
      'racion_id'=>6,
      'horario_id'=>4
    ];
    $r = new HorarioRacion($data);
    $r->save();
  }

  public static function cargar_raciones_disponibles(){
    static::cargar_horario_racion();
    $menu_raciones = HorarioRacion::all();
    foreach ($menu_raciones as $x) {
      // code...
      Log::debug('Método cargar raciones disponibles: se encontró un horario racion: '.$x);
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>date('Y-m-d',strtotime("-0 days")),
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];

      //Raciones para el 20
      $rd = new RacionesDisponibles($data);
      $rd->save();
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>date('Y-m-d',strtotime("-1 days")),
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 19
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>date('Y-m-d',strtotime("-2 days")),
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 18
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>date('Y-m-d',strtotime("-4 days")),
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 17
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>date('Y-m-d',strtotime("-5 days")),
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 16
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>date('Y-m-d',strtotime("-6 days")),
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 15
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>date('Y-m-d',strtotime("-7 days")),
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();

      //Raciones para el 14
      $data = [
          'horario_racion_id'=>$x->get_horario_racion_id(),
          'fecha'=>date('Y-m-d',strtotime("-8 days")),
          'stock_original'=>10,
          /*'cantidad_restante'=>10,
          'cantidad_realizados'=>0,*/
      ];
      $rd = new RacionesDisponibles($data);
      $rd->save();
    };

  }

  public static function cargar_menu_persona(){
    static::cargar_personal_y_pacientes();
    static::cargar_raciones_disponibles();
    $data = [
      'paciente_id'=>5,
      'fecha_ingreso'=>date('Y-m-d',strtotime("-1 days")),
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h1 = new HistoriaInternacion($data);
    $h1->save();
    $data = [
      'paciente_id'=>6,
      'fecha_ingreso'=>date('Y-m-d',strtotime("-2 days")),
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h2 = new HistoriaInternacion($data);
    $h2->save();
    $data = [
      'paciente_id'=>7,
      'fecha_ingreso'=>date('Y-m-d',strtotime("-3 days")),
      'peso'=>80,
      'fecha_egreso'=>null,
    ];
    $h3 = new HistoriaInternacion($data);
    $h3->save();
    $data = [
      'paciente_id'=>8,
      'fecha_ingreso'=>date('Y-m-d',strtotime("-4 days")),
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h4 = new HistoriaInternacion($data);
    $h4->save();
    $data = [
      'paciente_id'=>9,
      'fecha_ingreso'=>date('Y-m-d',strtotime("-5 days")),
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h5 = new HistoriaInternacion($data);
    $h5->save();
    $data = [
      'paciente_id'=>10,
      'fecha_ingreso'=>'2020-5-10',
      'peso'=>70,
      'fecha_egreso'=>null,
    ];
    $h6 = new HistoriaInternacion($data);
    $h6->save();



    $data= [
      'name'=>'Pabellón 1',
      'descripcion'=>'Terapia intesiva y cuidados paliativos',
    ];
    $s1= new Sector($data);
    $s1->save();
    $data= [
      'name'=>'PABELLON 4',
      'descripcion'=>'Hospital de día',
    ];
    $s2= new Sector($data);
    $s2->save();
    $data= [
      'name'=>'Pabellón 3',
      'descripcion'=>'Agudos',
    ];
    $s3= new Sector($data);
    $s3->save();
    $data= [
      'name'=>'Centro de jubilados',
      'descripcion'=>'-',
    ];
    $s4= new Sector($data);
    $s4->save();

    $data= [
      'sector_id'=>$s1->id,
      'name'=>'Habitación 1',
      'descripcion'=>'Cuidados paliativos',
    ];
    //--------habitacion 1 sector 1--------------------------
    $h1= new Habitacion($data);
    $h1->save();
    $data= [
      'sector_id'=>$s1->id,
      'name'=>'Habitación 2',
      'descripcion'=>'Cuidados paliativos',
    ];
    $h2= new Habitacion($data);
    $h2->save();
    $data= [
      'sector_id'=>$s1->id,
      'name'=>'Habitación 3',
      'descripcion'=>'Terapia intensiva',
    ];
    $h3= new Habitacion($data);
    $h3->save();
    $data= [
      'sector_id'=>$s1->id,
      'name'=>'Habitación 4',
      'descripcion'=>'Terapia intensiva',
    ];
    $h4= new Habitacion($data);
    $h4->save();
    //------------habitacion 2 sector 2------------------
    $data= [
      'sector_id'=>$s2->id,
      'name'=>'Habitación 1',
      'descripcion'=>'Internación común',
    ];
    $h1s2= new Habitacion($data);
    $h1s2->save();
    $data= [
      'sector_id'=>$s2->id,
      'name'=>'Habitación 2',
      'descripcion'=>'Internación común',
    ];
    $h2s2= new Habitacion($data);
    $h2s2->save();
    $data= [
      'sector_id'=>$s2->id,
      'name'=>'Habitación 3',
      'descripcion'=>'Maternidad',
    ];
    $h2s2= new Habitacion($data);
    $h2s2->save();
    //--------camas----habitacion 1 sector 1--------------------------
    $data=[
      'habitacion_id'=>$h1->id,
    ];
    $cama1= new Cama($data);
    $cama1->save();
    $data=[
      'habitacion_id'=>$h1->id,
    ];
    $cama2= new Cama($data);
    $cama2->save();
    $data=[
      'habitacion_id'=>$h1->id,
    ];
    $cama3= new Cama($data);
    $cama3->save();
    //-------camas habitacion 2 sector 1---------
    $data=[
      'habitacion_id'=>$h2->id,
    ];
    $cama1h2s1= new Cama($data);
    $cama1h2s1->save();
    $data=[
      'habitacion_id'=>$h2->id,
    ];
    $cama2h2s1= new Cama($data);
    $cama2h2s1->save();
    $data=[
      'habitacion_id'=>$h2->id,
    ];
    $cama3h2s1= new Cama($data);
    $cama3h2s1->save();
    $data=[
      'habitacion_id'=>$h2->id,
    ];
    $cama4h2s1= new Cama($data);
    $cama4h2s1->save();
    //----------camas habitacion1 sector 2------
    $data=[
      'habitacion_id'=>$h1s2->id,
    ];
    $cama1h1s2= new Cama($data);
    $cama1h1s2->save();
    $data=[
      'habitacion_id'=>$h1s2->id,
    ];
    $cama2h1s2= new Cama($data);
    $cama2h1s2->save();
    $data=[
      'habitacion_id'=>$h1s2->id,
    ];
    $cama3h1s2= new Cama($data);
    $cama3h1s2->save();
    $data=[
      'habitacion_id'=>$h1s2->id,
    ];
    $cama4h1s2= new Cama($data);
    $cama4h1s2->save();
    //-----------pacientes camas--------------
    $data=[
      'paciente_id'=>5,
      'cama_id'=>$cama1->id,
      'fecha'=>date('Y-m-d',strtotime("-1 days"))
    ];
    $paci_cama= new PacienteCama($data);
    $paci_cama->save();
    $data=[
      'paciente_id'=>6,
      'cama_id'=>$cama2->id,
      'fecha'=>date('Y-m-d',strtotime("-2 days"))
    ];
    $paci2_cama= new PacienteCama($data);
    $paci2_cama->save();
    $data=[
      'paciente_id'=>7,
      'cama_id'=>$cama3->id,
      'fecha'=>date('Y-m-d',strtotime("-3 days"))
    ];
    $paci1_cama= new PacienteCama($data);
    $paci1_cama->save();
    $data=[
      'paciente_id'=>8,
      'cama_id'=>$cama1h1s2->id,
      'fecha'=>date('Y-m-d',strtotime("-1 days"))
    ];
    $paci3_cama= new PacienteCama($data);
    $paci3_cama->save();
    $data=[
      'paciente_id'=>9,
      'cama_id'=>$cama2h1s2->id,
      'fecha'=>date('Y-m-d',strtotime("-1 days"))
    ];
    $paci4_cama= new PacienteCama($data);
    $paci4_cama->save();
    $data=[
      'paciente_id'=>10,
      'cama_id'=>$cama3h1s2->id,
      'fecha'=>date('Y-m-d',strtotime("-1 days"))
    ];
    $paci5_cama= new PacienteCama($data);
    $paci5_cama->save();


  }
}
