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
		$breadcrumbs=$this->breadcrumbs;
		return View::make('productos.index', compact('categorias','breadcrumbs'));
	}

	public function search(){
		$categorias = Categoria::all();
		$word=Input::get('search');
		$breadcrumbs=$this->breadcrumbs;
		$listaProductos = Producto::where('Nombre','Like','%'.$word.'%')->paginate(12);
		return View::make('productos.index',compact('listaProductos','breadcrumbs','categorias'));
	}

	public function categoria($id){
		$categorias = Categoria::all();
		$categoria=$categorias->find($id);
		$listaProductos=$categoria->Productos()->get();
		array_push($this->breadcrumbs,array('name'=>'Categoria'));
		$breadcrumbs=$this->breadcrumbs;

		return View::make('productos.index',compact('listaProductos','breadcrumbs','categorias'));

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
		
		$rules=Producto::$rules;

		//return json_encode(Input::all());
		if (Input::get('Nombre_categoria')!=""){
			
			$validator = Validator::make($data = Input::all(), array('Nombre_categoria'=>'unique:Categoria,Nombre'));
			if ($validator->fails()){
				return Redirect::back()->withErrors($validator)->withInput();
			}else{
				$categoria= new Categoria;
				$categoria->Nombre=Input::get('Nombre_categoria');
				$categoria->save();
				$rules['Categoria_Id']="";
				$data['Categoria_Id']=$categoria->Id;
				Input::merge(array('Categoria_Id'=>$categoria->Id));
			}
			
		}
		$validator = Validator::make($data = Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$producto= Producto::create($data);
		
		File::makeDirectory($path=public_path().'/img/productos/'.$producto->Id);
		$this->saveImages($path);
		return $this->categoria($producto->Categoria_Id);
	}

	public function upload(){
		if (Input::hasFile('image')){
			$image=Image::make(Input::file('image')->getRealPath())->resize(320,240,true);
			$type = Input::file('image')->getClientOriginalExtension();
			return Response::json(array('image'=> 'data:image/' . $type . ';base64,' . base64_encode($image)));
		}else{
			return false;
		}
	}

	public function saveImages($path){
		$name='img-ch-';
		for ($i=1; Input::hasFile($name.$i); $i++) { 
					$file=Input::file($name.$i);
					$image=Image::make($file->getRealPath())
						->resize(320,240,true)
						->crop(Input::get('w-'.$name.$i),Input::get('h-'.$name.$i),Input::get('x-'.$name.$i),Input::get('y-'.$name.$i))
						->save($path.'/'.$i.'.jpg');
			}
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
		array_push($this->breadcrumbs, array('name'=>'Ver'));
		$breadcrumbs=$this->breadcrumbs;
		return View::make('productos.show', compact('producto','breadcrumbs'));
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
		array_push($this->breadcrumbs, array('name'=> 'Editar'));
		$breadcrumbs=$this->breadcrumbs;
		$route='productos.update';
		return View::make('productos.edit', compact('producto','breadcrumbs','route'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$id=Input::get('Id');
		$producto = Producto::findOrFail($id);
		$rules=str_replace(":Id", $id, Producto::$rules);
		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$producto->update($data);
		$path=public_path().'/img/productos/'.$id;
		$this->saveImages($path);
		return $this->categoria($producto->Categoria_Id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$producto=Producto::destroy($id);

		return Redirect::back();
	}

	public function deleted()
	{
		$productos=Producto::onlyTrashed()->get();
		array_push($this->breadcrumbs,array('name'=>'descontinuados'));
		$breadcrumbs=$this->breadcrumbs;
		return View::make('productos.deleted',compact('productos','breadcrumbs'));
	}

	public function activar(){
		$producto=Producto::onlyTrashed()->where('Id',Input::get('id'))->restore();
		if(!Producto::onlyTrashed()->count()){
			return Redirect::route('productos.index');
		}else{
			return $this->deleted();
		}
	}

}