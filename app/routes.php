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
		Route::get('/',array('as'=>'clientes.index','uses'=>$Controller.'@index'));
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
		Route::get('categoria/{id}',array('as'=>'productos.categoria','uses'=>$Controller.'@categoria'));
		Route::delete('descontinuar/{id}',array('as'=>'productos.delete','uses'=>$Controller.'@destroy'));
		Route::get('descontinuados',array('as'=>'productos.deleted','uses'=>$Controller.'@deleted'));
		Route::get('editar/{id}',array('as'=>'productos.edit','uses'=>$Controller.'@edit'));
		Route::get('ver/{id}',array('as'=>'productos.show','uses'=>$Controller.'@show'));
		Route::get('buscar',array('as'=>'productos.search','uses'=>$Controller.'@search'));

		Route::post('crear',array('as'=>'productos.store','uses'=>$Controller.'@store'));
		Route::post('subir/imagen',array('as'=>'productos.image','uses'=>$Controller.'@upload'));
		Route::post('activar',array('as'=>'productos.activar','uses'=>$Controller.'@activar'));
		Route::post('actualizar',array('as'=>'productos.update','uses'=>$Controller.'@update'));

	});

	Route::group(array('prefix'=>'ventas'),function(){
		$Controller="VentasController";
		Route::get('/',array('as'=>'ventas.index','uses'=>$Controller.'@index'));
		Route::get('crear',array('as'=>'ventas.create','uses'=>$Controller.'@create'));

		Route::post('crear',array('as'=>'ventas.store','uses'=>$Controller.'@store'));
	});
	
});

Route::get('images',function(){

	return View::make('test');
});

Route::post('images',function(){

	$img=Image::make(Input::file('image')->getRealPath())->resize(320,240,true)->save(public_path().'/img.jpg');
	$token=Input::get('_token');
	
	return 'itworks: ';
});

Route::resource('usuarios', 'UsuariosController');
Route::post('login',array('as'=>'login', 'uses'=>'LoginController@store'));
Route::get('logout',array('as'=>'logout',function(){
	Auth::logout();
	return Redirect::to('/');
}));

//Route::get('productos',array('as'=>'user.productos','uses'=>'VistaUsuarioController@index'));
Route::any('productos/{id?}',array('as'=>'user.productos','uses'=>'VistaUsuarioController@index'));
Route::get('productos/ver/{id}',array('as'=>'user.productos.show','uses'=>'VistaUsuarioController@show'));
Route::get('productos/search',array('as'=>'user.productos.search','uses'=>'VistaUsuarioController@search'));



