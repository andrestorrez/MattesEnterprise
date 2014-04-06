<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	
	/*$user=new User();
	$user->username='melba';
	$user->password=Hash::make('melba1234');
	$user->save();*/
	return View::make('hello');
});

Route::group(array('prefix' => 'administracion','before'=>'auth'), function()
{
	Route::get('/',function(){
		return View::make('admin');
	});
	Route::group(array('prefix'=>'clientes'),function(){
		$Controller='ClientesController';
		Route::resource('/', $Controller.'');
    	Route::get('pagina/{inicial}',array('as'=>'clientes.pagina' ,'uses'=>$Controller.'@getPagina'));
    	Route::delete('desactivar/{id}',array('as'=>'clientes.delete' ,'uses'=>$Controller.'@destroy'));
    	Route::get('desactivados',array('as'=>'clientes.desactivados','uses'=>$Controller.'@deleted'));
		Route::get('buscar',array('as'=>'clientes.search','uses'=>$Controller.'@search'));
		Route::get('editar/{id}',array('as'=>'clientes.edit','uses'=>$Controller.'@edit'));
		Route::get('ver/{id}',array('as'=>'clientes.show','uses'=>$Controller.'@show'));
		Route::post('actualizar',array('as'=>'clientes.update','uses'=>$Controller.'@update'));
		Route::post('activar',array('as'=>'clientes.activar','uses'=>$Controller.'@activar'));
		Route::post('crear',array('as'=>'clientes.store','uses'=>$Controller.'@store'));
	});

	Route::group(array('prefix'=>'productos'),function(){
		$Controller="ProductosController";
		//Route::resource('/', 'ProductosController');
		Route::get('/',array('as'=>'productos.index','uses'=>$Controller.'@index'));
		Route::get('agregar',array('as'=>'productos.create','uses'=>$Controller.'@create'));
		Route::post('crear',array('as'=>'productos.store','uses'=>$Controller.'@store'));


	});
	
});


Route::resource('usuarios', 'UsuariosController');
Route::post('login',array('as'=>'login', 'uses'=>'LoginController@store'));
Route::get('logout',array('as'=>'logout',function(){
	Auth::logout();
	return Redirect::to('/');
}));