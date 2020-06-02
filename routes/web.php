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

Route::resource('/menu_persona','MenuPersonaController');
#Route::resource('menu_persona/show/{persona}/{horario}/{fecha}','MenuPersonaController@show');
Route::get('/menu_persona/show/{persona}/{horario}/{fecha}','MenuPersonaController@show');
Route::get('/menu_persona/destroy/{persona}/{horario}/{fecha}','MenuPersonaController@destroy');
Route::get('/informes/generar','InformeController@create')
	->name('InformeController.create');
Route::get('/informes/settear','InformeController@set_realizado')
	->name('InformeController.set');
Route::resource('/informes','InformeController');
Route::post('/improvement/menu_persona/create','MenuPersona_enhanced_Controller@store')
->name('MenuPersona_enhanced_Controller.store');
Route::resource('/improvement/menu_persona','MenuPersona_enhanced_Controller');
/*Route::get('/habitaciones/delete', 'HabitacionController@delete')
	->name('HabitacionController.delete');*/
Route::resource('/habitaciones', 'HabitacionController');
Route::resource('/camas', 'CamaController');
Route::resource('/pacientes', 'PacienteController');
Route::post('/menu_persona/pacientes/{paciente}/patologias','PacienteController@getPatologias');
Route::get('/historialInternacion/alta/{id}', 'HistorialInternacionController@alta')
	->name('historialInternacion.alta');
Route::get('/historialInternacion/ingresarNuevo', 'HistorialInternacionController@ingresarNuevo')
		->name('historialInternacion.alta');
Route::get('/historialInternacion/ingresarNuevo/paciente', 'HistorialInternacionController@createPaciente')
		->name('historialInternacion.createPaciente');
Route::resource('/historialInternacion', 'HistorialInternacionController');

Route::resource('/personas', 'PersonaController');
Route::resource('/patologias', 'PatologiaController');
Route::get('/patologias/{patologia}/agregarAlimentosProhibidos',["as"=>"patologia.agregarAlimentosProhibidos", "uses"=> 'PatologiaController@agregarAlimentosProhibidos']);
Route::PUT('/patologias/{patologia}/guardaralimentos-prohibidos', 'PatologiaController@guardarAlimentos');
Route::PUT('/patologias/{patologia}/quitaralimento', 'PatologiaController@quitarAlimento');
Route::resource('/tipospatologias', 'TipoPatologiaController');
Route::resource('/alimentos', 'AlimentoController');
Route::resource('/sectores', 'SectorController');
Route::resource('/raciones', 'RacionController');
Route::get('/raciones/{racion}/agregaralimentos',["as"=>"racion.agregarAlimentos", "uses"=> 'RacionController@agregarAlimentos']);
Route::PUT('/raciones/{racion}/guardaralimentos', 'RacionController@guardarAlimentos');
Route::PUT('/raciones/{racion}/quitaralimento', 'RacionController@quitarAlimento');
Route::PUT('/raciones/{racion}/guardarhorario', 'RacionController@guardarHorario');
Route::PUT('/raciones/{racion}/quitarhorario', 'RacionController@quitarHorario');
Route::resource('/raciones-disponibles', 'RacionesDisponiblesController');
Route::get('/ver-raciones-disponibles', 'RacionesDisponiblesController@getRacionesDisponibles');
Route::get('/ver-raciones-disponibles-persona', 'RacionesDisponiblesController@getRacionesDisponiblesPersona');
Route::get('/raciones-disponibles/show/{id}',["as"=>"raciones-disponibles.show", "uses"=>'RacionesDisponiblesController@show']);
Route::DELETE('/raciones-disponibles/destroy/{id}','RacionesDisponiblesController@destroy');
Route::PUT('/raciones-disponibles/update/{id}','RacionesDisponiblesController@update');


Route::POST('/buscarAlimento', 'AlimentoController@buscar');
Route::get('/movimientos',["as"=>"movimientos.index", "uses"=>'MovimientoController@index']);
Route::get('/dietas',["as"=>"dietas.index", "uses"=>'DietaController@index']);

Route::get('/test/datepicker', function () {
    return view('datepicker');
});

Route::post('/test/save', ['as' => 'save-date',
'uses' => 'DateController@showDate',
 function () {
	 return '';
 }]);

 Route::get('/forms/select/{form}/{query}', 'FormsController@showSelect');
 Route::get('/forms/select/raciones/{horario}/{persona}', 'FormsController@showRaciones');
 Route::resource('/forms', 'FormsController');
