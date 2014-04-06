@extends('layouts.main')

@section('content')
@include('layouts.breadcrumbs',$breadcrumbs)
	<br>
@if ($cliente!=array())
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h2 class="panel-title">{{{$cliente->Nombre}}} {{{$cliente->Apellido}}}</h2>
	  </div>
	  <div class="panel-body" style="word-wrap: break-word;">
	    <?php $path='/users/'.$cliente->Id.'/profile-picture.jpg'; ?>
		     <div align="center" >
		       	@if (file_exists($path))
			      <img class="img-circle" src="{{{$path}}}" width="20%">
			    @else 
			    	<img class="img-circle" src="/img/Default-{{{$cliente->Sexo}}}.jpg" width="20%">
			    @endif		        
		     </div>
		     	<p>
			      	<i class="glyphicon glyphicon-shopping-cart"></i>
			      	<strong>Compras: </strong> {{{$cliente->Compras}}}</p>
		     	<p>
		        	<i class="glyphicon glyphicon-asterisk"></i>
		        	<strong>No. Identidad: </strong>
		        	{{{substr($cliente->No_Identidad, -13,4)}}}
		        	-
		        	{{{substr($cliente->No_Identidad, -9,4)}}}
		        	-
		        	{{{substr($cliente->No_Identidad, -5,5)}}}</p>
		     	
		        <p>
		        	<i class="glyphicon glyphicon-envelope"></i>
		        	<strong>E-mail: </strong>{{{$cliente->E_mail}}}</p>

		        <?php 
		        	$strlen1=strlen($cliente->Telefono_Personal);
		         	$strlen2=strlen($cliente->Telefono_Trabajo);
		        ?>
		        <p>
		        	<i class="glyphicon glyphicon-phone"></i>
		        	<strong>Telefono Personal: </strong>
		        	{{{substr($cliente->Telefono_Personal,-$strlen1,$strlen1/2)}}}
		        	-
		        	{{{substr($cliente->Telefono_Personal,-($strlen1/2),$strlen1/2)}}}</p>

		        <p>
		        <i class="glyphicon glyphicon-earphone"></i>
		        	<strong>Otro Telefono: </strong>
		        	{{{substr($cliente->Telefono_Trabajo,-$strlen2,$strlen2/2)}}}
		        	-
		        	{{{substr($cliente->Telefono_Trabajo,-($strlen2/2),$strlen2/2)}}}
		        	</p>

			    <p>
		        	<i class="glyphicon glyphicon-globe	"></i>
		        	<strong>Direccion: </strong>{{{$cliente->Direccion}}}</p>
			    {{ Form::open(
		        	array(
		        	'method'=>'DELETE', 
		        	'route'=>array('clientes.delete',$cliente->Id),
		        	'class'=>'form-inline form-horizontal')) }}
			        {{Form::hidden('id',$cliente->Id)}}
			        <a href="{{{URL::route('clientes.edit',$cliente->Id)}}}" class="btn btn-sm btn-success">
			        <i class="glyphicon glyphicon-edit"></i> Editar</a>
			        <button type='submit' class="btn btn-danger btn-sm" role="button">
			        <i class="glyphicon glyphicon-remove"></i> Desactivar</button>

		        {{Form::close()}}

	  </div>
	</div>
@else

	<div class='well'>
		<h2>No se encontro el cliente que buscabas :(</h2>
	</div>
@endif
@stop
