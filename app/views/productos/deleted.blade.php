@extends('layouts.main')

@section('content')
@include('layouts.breadcrumbs',array('breadcumnds'=>$breadcrumbs))



<h2>Productos Desactivados</h2>
@if ($productos->count())
<div class="table-responsive">
<table class="table table-striped table-hover table-condensed">
  <thead >
    <tr class="info">
      <th>Nombre</th>
      <th>Existencias</th>
      <th>Costo Unitario</th>
      <th>Precio Unitario</th>
      <th>Accion<th>
    </tr>
  </thead>
  <tbody>
  @foreach ($productos as $producto)
    <tr>
      <td>{{{ $producto->Nombre }}}</td>
      <td>{{{ $producto->Cantidad}}}</td>
      <td>{{{ $producto->Costo_Unitario}}}</td>
      <td>{{{ $producto->Precio_Unitario}}}</td>
      <td>	
      {{Form::open(array('route'=>'productos.activar'))}}
      {{Form::hidden('id',$producto->Id)}}
      	<button class="btn btn-sm btn-primary" type='submit'>Activar</button></td>
      {{Form::close()}}
      <td><a href=""><button class="btn btn-sm btn-warning" href="/"> Editar</button></a></td>
    </tr>
  @endforeach
  </tbody>
</table> 
</div>
@else
	<div class="well">
		<h3>No se econtraron productos desactivados!  :(</h3>
	</div>

@endif


@stop
