<?php

class Producto extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'Nombre' => 'required|alpha_spaces|unique:Producto,Nombre,:Id',
		'Cantidad'=> 'required|integer|min:0',
		'Costo_Unitario'=>'required|numeric|min:0',
		'Precio_Unitario'=>'required|numeric|min:0',
		'Categoria_Id'=>'required'

	];

	// Don't forget to fill this array
	protected $fillable = array('Nombre','Cantidad','Costo_Unitario','Precio_Unitario','Descripcion','Categoria_Id');
	protected $table = "Producto";
	protected $primaryKey = "Id";
	//protected $foreingKey ="Categoria_Id";

	public function Categoria(){
		return $this->belongsTo('Categoria');
	}
}
