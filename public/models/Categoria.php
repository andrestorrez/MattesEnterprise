<?php

class Categoria extends \Eloquent {
	protected $fillable = array('Nombre');
	protected $table = 'Categoria';
	protected $primaryKey = 'Id';
	public $timestamps =false;

	public function Productos(){
		return $this->hasMany('Producto');
	}
}