<?php

class VistaUsuarioController extends \BaseController{

	public function index($id = null){
		$Productos=Producto::select('Id','Nombre','Precio_Unitario','Descripcion','Categoria_Id')
						->paginate(12);
		if ($id!=null) {
			$categoria=Categoria::find($id);
			if ($categoria)
				$Productos=$categoria->Productos()->paginate(12);
			//array_push($this->breadcrumbs,array('name'=>'Categoria'));
			//$breadcrumbs=$this->breadcrumbs;
		}
		return View::make('VistasUsuario.index')
			->with(array('listaProductos'=>$Productos,'categorias'=>Categoria::all()));
	}

	public function search(){
		$search=Input::get('search');
		$Productos=Producto::where('Nombre','Like','%'.$search.'%')->paginate(12);

		return View::make('VistasUsuario.index')
			->with(array('listaProductos'=>$Productos,'categorias'=>Categoria::all()));		
	}

	public function show($id){
		$producto=Producto::find($id);
		return View::make('VistasUsuario.show',compact('producto'));
	}
}