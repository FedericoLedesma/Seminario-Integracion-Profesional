<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Persona;
use App\Personal;
use App\TipoDocumento;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
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
        'name'=>'dni',
      ]);
      $persona = Persona::create([
          #'id'=>1,
          'name'=>'pepe',
          'apellido'=>'carlitos',
          'tipo_documento_id'=>$tipo_doc->id,
          'numero_doc'=>1234,
          'direccion'=>'10 n° 100',
          'email'=>'a',
          'provincia'=>'a',
          'localidad'=>' a',
          'sexo'=>'a',
          'fecha_nac'=>Carbon::now()
      ]);
      $personal=Personal::create([
        'id'=>$persona->id,
      ]);
        // $this->call(UsersTableSeeder::class);
    	DB::table('users')->insert([
    			'dni' => '1234',
    			'name'=>'admin',
          'personal_id'=>1,
    			'password'=>bcrypt('12345678'),

    	]);
    	DB::table('roles')->insert([
    			'name' => 'Super-User',
    			'guard_name'=>'web',
    	]);

    	DB::table('permissions')->insert([
    			'name' => 'alta_usuarios',
    			'guard_name'=>'web',
    	]);
      DB::table('permissions')->insert([
          'name' => 'ver_usuarios',
          'guard_name'=>'web',
      ]);

    	DB::table('permissions')->insert([
    			'name' => 'modificacion_usuarios',
    			'guard_name'=>'web',
    	]);
    	DB::table('permissions')->insert([
    			'name' => 'baja_usuarios',
    			'guard_name'=>'web',
    	]);

    	DB::table('permissions')->insert([
    			'name' => 'alta_roles',
    			'guard_name'=>'web',
    	]);
    	DB::table('permissions')->insert([
    			'name' => 'baja_roles',
    			'guard_name'=>'web',
    	]);
    	DB::table('permissions')->insert([
    			'name' => 'modificacion_roles',
    			'guard_name'=>'web',
    	]);
      DB::table('permissions')->insert([
    			'name' => 'ver_roles',
    			'guard_name'=>'web',
    	]);

      DB::table('permissions')->insert([
          'name' => 'alta_permisos',
          'guard_name'=>'web',
      ]);
      DB::table('permissions')->insert([
          'name' => 'baja_permisos',
          'guard_name'=>'web',
      ]);

      DB::table('permissions')->insert([
          'name' => 'ver_permisos',
          'guard_name'=>'web',
	  ]);

	  DB::table('permissions')->insert([
		'name' => 'ver_menu_persona',
		'guard_name'=>'web',
	  ]);

	  DB::table('permissions')->insert([
		'name' => 'modificacion_menu_persona',
		'guard_name'=>'web',
	  ]);

	  DB::table('permissions')->insert([
		'name' => 'alta_menu_persona',
		'guard_name'=>'web',
	  ]);

	  DB::table('permissions')->insert([
		'name' => 'baja_menu_persona',
		'guard_name'=>'web',
	  ]);

    //---------permisos Personas---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_personas',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_personas',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_personas',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_personas',
        'guard_name'=>'web',
    ]);

    //---------permisos alimentos---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_alimentos',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_alimentos',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_alimentos',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_alimentos',
        'guard_name'=>'web',
    ]);
    //---------permisos raciones---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_raciones',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_raciones',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_raciones',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_raciones',
        'guard_name'=>'web',
    ]);
    //---------permisos patologias---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_patologias',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_patologias',
        'guard_name'=>'web',
    ]);
    //---------permisos racionDisponible---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_raciones-disponibles',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_raciones-disponibles',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_raciones-disponibles',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_raciones-disponibles',
        'guard_name'=>'web',
    ]);
    //---------permisos tipos de patologias---------------------------
    DB::table('permissions')->insert([
        'name' => 'modificacion_tipos-patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'ver_tipos-patologias',
        'guard_name'=>'web',
    ]);

    DB::table('permissions')->insert([
        'name' => 'alta_tipos-patologias',
        'guard_name'=>'web',
    ]);
    DB::table('permissions')->insert([
        'name' => 'baja_tipos-patologias',
        'guard_name'=>'web',
    ]);
	  $user=User::find('1');
	  $role=Role::create(['name'=>'Super-Admin']);
	  $permisos=Permission::all();
	  foreach($permisos as $permiso){
		  $role->givePermissionTo($permiso);
	  }
	  $user->assignRole('Super-Admin');
/*
		$this->call([
			Menu_personaSeeder::class
		]);*/

	}

}
