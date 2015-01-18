<?php

class DetalleVenta extends \Eloquent {
	protected $fillable = array('Venta_Id','Producto_Id','Cantidad','Precio_Unitario');
	protected $table = 'Venta_has_Producto';
	protected $primaryKey = 'Venta_Id';
	public $timestamps =false;

	public function Productos(){
		return $this->hasMany('Producto');
	}
}