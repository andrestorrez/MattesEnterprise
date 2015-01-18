<?php

class VentasController extends \BaseController{
	protected $breadcrumbs=array(array('name' => 'Ventas'));

	public function index(){
		$Ventas = Venta::all();
		return View::make('ventas.index',compact('Ventas'));
	}

	public function create(){
		array_push($this->breadcrumbs, array('name'=>'Crear'));
		$route='ventas.store';
		$breadcrumbs=$this->breadcrumbs;
		$venta=null;
		//Cookie::forget('mycook');
		return Response::view('ventas.create',compact('breadcrumbs','route','venta'))->withCookie(Cookie::make('mycook',array(1,2,3),1));
	}

	public function store(){
		return Input::all();
	}
}