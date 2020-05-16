<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=User::find('1');
        $role=Role::create(['name'=>'Administrador']);
        $permisos=Permission::all();
        foreach($permisos as $permiso){
        	$role->givePermissionTo($permiso);
        }
        $user->assignRole('Administrador');
    }
}
