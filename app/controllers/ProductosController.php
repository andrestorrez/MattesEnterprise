<?php

class ProductosController extends \BaseController {

	/**
	 * Display a listing of productos
	 *
	 * @return Response
	 */
	protected $breadcrumbs=array(array('name' => 'Productos'));
	public function index()
	{
		$categorias = Categoria::all();
		$listaProductos=array();

		$breadcrumbs=$this->breadcrumbs;
		foreach ($categorias as $categoria) {
			$list["".$categoria->Id]=$categoria->Productos()->get();
		}
		return View::make('productos.index', compact('listaProductos','breadcrumbs'));
	}

	/**
	 * Show the form for creating a new producto
	 *
	 * @return Response
	 */
	public function create()
	{
		array_push($this->breadcrumbs, array('name'=>'Crear'));
		$breadcrumbs=$this->breadcrumbs;
		$producto=null;
		$route='productos.store';
		return View::make('productos.create',compact('producto','route','breadcrumbs'));
	}

	/**
	 * Store a newly created producto in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Producto::$rules);
		if (Input::get('NewCategory')!=""){
			$categoria= new Categoria;
			$categoria->Nombre=Input::get('NewCategory');
			if (!$categoria->save()){
				return Redirect::back()->withErrors($validator)->withInput();
			}else{
				$data['Categoria_Id']=$categoria->Id;
			}
		}


		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Producto::create($data);

		return Redirect::route('productos.index');
	}

	/**
	 * Display the specified producto.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$producto = Producto::findOrFail($id);

		return View::make('productos.show', compact('producto'));
	}

	/**
	 * Show the form for editing the specified producto.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$producto = Producto::find($id);

		return View::make('productos.edit', compact('producto'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$producto = Producto::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Producto::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$producto->update($data);

		return Redirect::route('productos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Producto::destroy($id);

		return Redirect::route('productos.index');
	}

}