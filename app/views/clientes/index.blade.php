@extends('layouts.main')

@section('content')
@include('layouts.breadcrumbs',array('breadcumnds'=>$breadcrumbs))


<ul class="pagination pagination-sm">
  <li class="disabled"><a href="#">&laquo;</a></li>

 @foreach ($iniciales as $inicial)
 	<?php $init=strtoupper($inicial->Inicial) ?>
 	 <li>

 	 <a href="{{{url('administracion/clientes/pagina',$init)}}}" class='pagina'>
 	 {{{$init}}}</a></li>

 @endforeach
  <li class="disabled"><a href="#">&raquo;</a></li>
</ul>
<?php if (!isset($search))$search="";  ?>

{{Form::open(array(
	'route'=>'clientes.search',
	'method'=>'get',
	'class'=>'form-inline form-horizontal',
	'id'=>'search'
))}}
	
	<div class='form-group'>
	<div class="col-sm-3">
		<a class="btn btn-sm btn-primary" href="{{{URL::action('ClientesController@create')}}}">
		<i class='glyphicon glyphicon-plus'></i> Agregar cliente</a>
	</div>
	<div class="col-sm-4">
		<a class="btn btn-sm btn-warning" href="{{{URL::action('ClientesController@deleted')}}}">
		<i class='glyphicon glyphicon-trash'></i> Clientes Desactivados</a>
	</div>
	
	<div class="col-sm-4 col-xs-9">
		<input required value="{{{$search}}}" name="search" id="search" type="search" placeholder="Buscar Nombre,Email,Telefono" class="form-control input-sm">
		
	</div>
	<button style="margin-left:1%;" class="btn btn-sm" type='submit'>
	<span class="glyphicon glyphicon-search"></span><font color="#ecf0f1">.</font></button>
	</div>
	{{Form::close()}}

<h2>{{$title}}</h2>
<br>
	<div class="row">
	@foreach ($clientes as $cliente)	
	  <div class="col-sm-6 col-md-4">
	  	<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{{$cliente->Nombre}}} {{{$cliente->Apellido}}}</h3>
		  </div>
		  <div class="panel-body table-responsive" style="word-wrap: break-word;" >
		    <?php $path='/users/'.$cliente->Id.'/profile-picture.jpg'; ?>
		     <div align="center" >
		       	@if (file_exists($path))
			      <img class="img-circle" src="{{{$path}}}" width="40%">
			    @else 
			    	<img class="img-circle" src="/img/Default-{{{$cliente->Sexo}}}.jpg" width="40%">
			    @endif		        
		     </div>
		      	<p>
			      	<i class="glyphicon glyphicon-shopping-cart"></i>
			      	<strong>Compras: </strong> {{{$cliente->Compras}}}</p>
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
		        	{{{substr($cliente->Telefono_Personal,-($strlen1/2),$strlen1/2)}}}
		        	</p>
		        <p>
		        <i class="glyphicon glyphicon-earphone"></i>
		        	<strong>Otro Telefono: </strong>
		        	{{{substr($cliente->Telefono_Trabajo,-$strlen2,$strlen2/2)}}}
		        	-
		        	{{{substr($cliente->Telefono_Trabajo,-($strlen2/2),$strlen2/2)}}}
		        	</p>
		        
		        <div class="">
		        

		        {{ Form::open(
		        	array(
		        	'method'=>'DELETE', 
		        	'route'=>array('clientes.delete',$cliente->Id),
		        	'class'=>'form-inline form-horizontal')) }}
			        {{Form::hidden('id',$cliente->Id)}}
			        <a href="{{{URL::route('clientes.show',$cliente->Id)}}}" class=" btn btn-info btn-sm" role="button">
			        <i class="glyphicon glyphicon-info-sign"></i> Info</a>
			        <a href="{{{URL::route('clientes.edit',$cliente->Id)}}}" class="btn btn-sm btn-success">
			        <i class="glyphicon glyphicon-edit"></i> Editar</a>
			        <button type='submit' class="btn btn-danger btn-sm" role="button">
			        <i class="glyphicon glyphicon-remove"></i> Desactivar</button>

		        {{Form::close()}}
		        
		        </div>
		        
		     
		  </div>
		</div>
		</div>
	  @endforeach
	</div>
	
@stop
@section('scripts')
 <script type="text/javascript">

 	$(document).ready(function(){

 	});

 </script>

@stop