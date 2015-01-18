<?php

class ClientesController extends \BaseController {

	/**
	 * Display a listing of clientes
	 *
	 * @return Response
	 */
	protected $breadcrumbs=array(array('name' => 'Clientes'));
	protected $_message="<div class='well'> No se econtraron clientes :( </div>";
	protected $condition="WHERE C.deleted_at IS NULL";
	public function index()
	{
		//$clientes = Cliente::all();

		$data= $this->dataIndex('');
		if($data['clientes']== array()){
			$data['title']=$this->_message;
		}	
		return View::make('clientes.index',$data);
	}

	protected function dataIndex($inicial){
		$title='';
		$iniciales = DB::select(DB::raw("SELECT
		 LEFT(Nombre,1) AS Inicial FROM Cliente AS C ".$this->condition."
		 GROUP BY Inicial 
		 ORDER BY Inicial"));
		if (strcmp($inicial,'')!=0){
			$inicial=preg_replace("/[^A-Za-z%]/u", "", $inicial);
			array_push($this->breadcrumbs,array('name'=>$inicial,'active'=>'disabled'));

			$title='"'.$inicial.'"';			
			$clientes = Cliente::select(DB::raw('count(Venta.Id) AS Compras, Cliente.*'))
					->leftJoin('Venta','Cliente.Id','=','Venta.Cliente_Id')
					->where('Cliente.Nombre','LIKE',$inicial.'%')
					->groupBy('Cliente.Id')
					->orderBy('Cliente.Nombre','asc')
					->paginate(12);

		}else{
			$title='Todos los clientes';
			$clientes = Cliente::select(DB::raw('count(Venta.Id) AS Compras, Cliente.*'))
					->leftJoin('Venta','Cliente.Id','=','Venta.Cliente_Id')
					->groupBy('Cliente.Id')
					->orderBy('Cliente.Nombre','asc')
					->paginate(12);

			/*DB::select(DB::raw("SELECT
				 COUNT(V.id) AS Compras, C.* FROM Cliente AS C 
				 INNER JOIN Venta as V 
				 ON C.Id=V.Cliente_Id 
				 ".$this->condition."
				 GROUP BY V.Cliente_Id 
				 ORDER BY Compras DESC LIMIT 6"));*/
		}
		return array('iniciales'=>$iniciales,'clientes'=>$clientes,'breadcrumbs'=>$this->breadcrumbs,'title'=>$title);
	}
	/**
	 * Show the form for creating a new cliente
	 *
	 * @return Response
	 */

	public function getPagina($inicial){
		$data=$this->dataIndex($inicial);
		if($data['clientes']== array()){
			$data['title']=$this->_message;
		}	
		return View::make('clientes.index',$data);
	}
	public function create()
	{
		array_push($this->breadcrumbs, array('name'=>'Crear'));
		$route='clientes.store';
		$breadcrumbs=$this->breadcrumbs;
		$cliente=null;
		return View::make('clientes.create',compact('breadcrumbs','route','cliente'));
	}

	/**
	 * Store a newly created cliente in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Cliente::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		if(isset($data['No_Identidad']) && !preg_match("/^[0-9]{13}$/", $data['No_Identidad'])){
			unset($data['No_Identidad']);
		}
		Cliente::create($data);
		return Redirect::action('ClientesController@index');
	}

	/**
	 * Display the specified cliente.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cliente = DB::table('Cliente')
			->leftJoin('Venta','Cliente.Id','=','Venta.Cliente_Id')
			->where('Cliente.Id','=',$id)
			->where('Cliente.deleted_at')
			->select(DB::raw('COUNT(Venta.Id) as Compras'),'Cliente.*')
			->groupBy('Cliente.Id')->get();
		if ($cliente!=array()){
			$cliente=$cliente[0];
		}else{
			return Redirect::action('ClientesController@index');
		}
		array_push($this->breadcrumbs,array('name'=>'Ver') );
		$breadcrumbs=$this->breadcrumbs;
		return View::make('clientes.show', compact('cliente','breadcrumbs'));
	}

	/**
	 * Show the form for editing the specified cliente.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		array_push($this->breadcrumbs, array('name'=>'Editar'));
		$route='clientes.update';
		$breadcrumbs=$this->breadcrumbs;
		$cliente = Cliente::find($id);

		return View::make('clientes.edit', compact('breadcrumbs','route','cliente'));
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
		$cliente = Cliente::findOrFail($id);
		$rules=str_replace(":Id", $id, Cliente::$rules);
		$validator = Validator::make($data = Input::all(), $rules);
		if(isset($data['No_Identidad']) && !preg_match("/^[0-9]{13}$/", $data['No_Identidad'])){
			unset($data['No_Identidad']);
			$cliente->update(array('No_Identidad' => NULL));
		}
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$cliente->update($data);

		return Redirect::action('ClientesController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Cliente::destroy($id);
		return Redirect::back();
	}

	public function deleted(){
		$clientes=Cliente::onlyTrashed()->get();
		array_push($this->breadcrumbs, array('name'=>'Desactivados'));
		return View::make('clientes.deleted',
			array('breadcrumbs'=>$this->breadcrumbs,'clientes'=>$clientes));
	}

	public function activar(){
		$cliente=Cliente::onlyTrashed()->where('Id',Input::get('id'))->restore();
		if(!Cliente::onlyTrashed()->count()){
			return Redirect::action('ClientesController@index');
		}else{
			return $this->deleted();
		}
	}

	public function search(){
		$search=Input::get('search');
		$clientes=Cliente::select(DB::raw('count(V.Id) as Compras, Cliente.*'))
						->leftJoin('Venta as V','Cliente.Id','=','V.Cliente_Id')
				  ->where('Cliente.Nombre', 'LIKE', '%'.$search.'%')
				//->orWhere(DB::raw("Cliente.Apellido LIKE CONCAT('%',?,'%')"),$search)
				//->orWhere(DB::raw("Cliente.E_mail LIKE CONCAT('%',?,'%')"),$search)
				//->orWhere(DB::raw("Cliente.Telefono_Personal LIKE CONCAT('%',?,'%')"),$search)
				//->orWhere(DB::raw("Cliente.Telefono_Trabajo LIKE CONCAT('%',?,'%')"),$search)
				  	->groupBy('Cliente.Id')
				  	->orderBy('Cliente.Nombre','asc')
					->paginate(1);

		/*DB::select(DB::raw("SELECT 
			COUNT(V.id) AS Compras, C.* FROM Cliente as C
			LEFT JOIN Venta as V 
		    ON C.Id=V.Cliente_Id
			".$this->condition." 
			AND (C.Nombre LIKE CONCAT('%',?,'%')
				OR C.Apellido LIKE CONCAT('%',?,'%')
				OR C.E_mail LIKE CONCAT('%',?,'%')
				OR C.Telefono_Personal LIKE CONCAT('%',?,'%')
				OR C.Telefono_Trabajo LIKE CONCAT('%',?,'%'))
				GROUP BY C.Id 
				ORDER BY C.Nombre
			"),array($search,$search,$search,$search,$search),true)->paginate(12);*/

		$data=$this->dataIndex('');
		$data['clientes']=$clientes;
		$data['title']='Resultado de la busqueda: "'.$search.'"';
		array_push($this->breadcrumbs, array('name'=>'Buscar'));
		$data['breadcrumbs']=$this->breadcrumbs;
		if($data['clientes']== array()){
			$data['title']=$this->_message;
		}
		$data['search']=$search;
		return View::make('clientes.index',$data);
	}
	

}