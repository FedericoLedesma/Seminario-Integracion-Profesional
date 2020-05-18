<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
        // $this->call(UsersTableSeeder::class);
    	DB::table('users')->insert([
    			'dni' => '1234',
    			'name'=>'admin',
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
		
	}
		
}
