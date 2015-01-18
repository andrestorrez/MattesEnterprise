<?php

class Cliente extends \Eloquent {

	// Add your validation rules here
	protected $softDelete = true;
	public static $rules = array(
		'No_Identidad' => 'digits:13|unique:Cliente,No_Identidad,:Id',
		'Nombre'=> 'alpha_spaces|required|max:45',
		'Apellido'=>'alpha_spaces|required|max:45',
		'Telefono_Personal'=>'numeric',
		'Telefono_Trabajo'=>'numeric',
		'Direccion'=>'max:255',
		'E_mail'=>'email|required|max:45|unique:Cliente,E_mail,:Id',
		'Sexo'=>'regex:/^[01]$/'
	);

	//Don't forget to fill this array
	protected $fillable = array('No_Identidad','Nombre','Apellido','Telefono_Personal',
		'Telefono_Trabajo','Direccion','E_mail','Sexo');
	protected $table = 'Cliente';
	protected $primaryKey= 'Id';

}