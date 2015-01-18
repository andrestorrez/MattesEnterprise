<?php

class Venta extends \Eloquent {
	protected $fillable = array('Subtotal','ISV','Total','created_at','updated_at','Cliente_Id');
	protected $table = 'Venta';
	protected $primaryKey = 'Id';
	public $timestamps =true;

	public function DetalleVenta(){
		return $this->hasMany('DetalleVenta');
	}
}