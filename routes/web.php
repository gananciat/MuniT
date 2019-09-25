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

/*Route::get('/', function () {
    return view('home');
});*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::name('cambiar_contraseña')->post('users_change_password','Acceso\UserController@changePassword');

//=====================DEPARTAMENTOS DE GUATEMALA==========================//
Route::get('departamentosView', 'Configuracion\DepartamentoController@view')->name('departamentosView');
Route::resource('departamentos', 'Configuracion\DepartamentoController', ['except' => ['create', 'edit']]);
//=====================MUNICIPIOS DE GUATEMALA==========================//
Route::get('municipiosView', 'Configuracion\MunicipioController@view')->name('municipiosView');
Route::resource('municipios', 'Configuracion\MunicipioController', ['except' => ['create', 'edit']]);
//=====================TIPO DOCUMENTOS A ADJUNTAR==========================//
Route::get('tipoDocumentosView', 'Configuracion\TipoDocumentoController@view')->name('tipoDocumentosView');
Route::resource('tipoDocumentos', 'Configuracion\TipoDocumentoController', ['except' => ['create', 'edit']]);
//=====================ESTADO CIVILES DE EMPLEADOS==========================//
Route::get('estadoCivilsView', 'Configuracion\EstadoCivilController@view')->name('estadoCivilsView');
Route::resource('estadoCivils', 'Configuracion\EstadoCivilController', ['except' => ['create', 'edit']]);
//=====================DIAS LABORALES==========================//
Route::get('diasView', 'Configuracion\DiaController@view')->name('diasView');
Route::resource('dias', 'Configuracion\DiaController', ['except' => ['create', 'edit']]);

//=====================PRESTACIONES==========================//
Route::get('prestacionssView', 'Configuracion\PrestacionController@view')->name('prestacionssView');
Route::resource('prestacions', 'Configuracion\PrestacionController', ['except' => ['create', 'edit']]);

//=====================PRESTACIONES==========================//
Route::get('tipoContratosView', 'Configuracion\TipoContratoController@view')->name('tipoContratosView');
Route::resource('tipoContratos', 'Configuracion\TipoContratoController', ['except' => ['create', 'edit']]);

//=====================CARGOS==========================//
Route::get('cargosView', 'RecursosHumanos\CargoController@view')->name('cargosView');
Route::resource('cargos', 'RecursosHumanos\CargoController', ['except' => ['create', 'edit']]);

//=====================DEPARTAMENTOS UNIDADES==========================//
Route::get('unidadsView', 'RecursosHumanos\UnidadController@view')->name('unidadsView');
Route::resource('unidads', 'RecursosHumanos\UnidadController', ['except' => ['create', 'edit']]);
Route::resource('unidads.cargos', 'RecursosHumanos\UnidadUnidadCargoController', ['only' => ['index']]);
Route::resource('unidadCargos', 'RecursosHumanos\UnidadCargoController', ['except' => ['create', 'edit']]);

//=====================EMPLEADOS==========================//
Route::get('empleadosView', 'RecursosHumanos\EmpleadoController@view')->name('empleadosView');
Route::resource('empleados', 'RecursosHumanos\EmpleadoController', ['except' => ['create', 'edit']]);
Route::name('cambiar_estado')->put('empleados_cambiar_estado/{id}', 'RecursosHumanos\EmpleadoController@cambiarEstado');

//=====================CONTRATOS==========================//
Route::get('contratosView', 'RecursosHumanos\ContratoController@view')->name('contratosView');
Route::resource('contratos', 'RecursosHumanos\ContratoController', ['except' => ['create', 'edit']]);

//=====================TIPO DOCUMENTOS CONTRATO==========================//
Route::resource('documentoContratos', 'RecursosHumanos\DocumentoContratoController', ['except' => ['create', 'edit']]);
Route::name('contratos_docs')->get('contratos_docs/{id}', 'RecursosHumanos\ContratoController@getDocs');

//=====================TIPO USUARIOS==========================//
Route::get('tipoUsuariosView', 'Acceso\TipoUsuarioController@view')->name('tipoUsuariosView');
Route::resource('tipoUsuarios', 'Acceso\TipoUsuarioController', ['except' => ['create', 'edit']]);

//=====================USUARIOS==========================//
Route::get('usersView', 'Acceso\UserController@view')->name('usersView');
Route::get('perfil', 'RecursosHumanos\EmpleadoController@viewPerfil')->name('perfil');
Route::resource('users', 'Acceso\UserController', ['except' => ['create', 'edit']]);