<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if (Auth::user()){
    return view('home');
	}return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/prueba',function(){

	return view('prueba');
});
/**
 * Rutas para un usuario con rol administrador
 */

//Route::group(['middleware' => ['role:Administrador']], function () {
	//
	Route::resource('/admin/users', 'AdminUsersController');
	Route::resource('/admin/roles', 'AdminRolesController');
	Route::resource('/admin/permisos', 'AdminPermissionController');

	Route::get('/users/buscar','AdminUsersController@buscar')->name('user.buscar');
	Route::post('/users/buscar','AdminUsersController@buscar')->name('user.buscar');


//});
/**
 * RUTAS PARA UN USUARIO LOGGEADO
 *
 */
Route::get('/user/config',["as"=>"user.config", "uses"=>'UserController@config'] );
Route::get('/perfil',["as"=>"user.perfil", "uses"=>'UserController@index'] );
Route::match(array('PUT', 'PATCH'), "/user/config/{id}", array(
		'uses' => 'UserController@update',
		'as' => 'user.update'
));

Route::get('/perfil/cambiarpassword',["as"=>"user.cambiarpass", "uses"=>'UserController@cambiarPassword'] );

Route::match(array('PUT', 'PATCH'), "/user/updatepass/{id}", array(
		'uses' => 'UserController@updatePassword',
		'as' => 'user.updatepass'
));

Route::resource('MenuPersona','MenuPersonaController');
Route::get('/MenuPersona/show/{horario_id}/{persona_id}/{fecha}','MenuPersonaController@show');
