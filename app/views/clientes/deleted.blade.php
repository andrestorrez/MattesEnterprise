@extends('layouts.main')

@section('content')
@include('layouts.breadcrumbs',array('breadcumnds'=>$breadcrumbs))



<h2>Clientes Desactivados</h2>
@if ($clientes->count())
<div class="table-responsive">
<table class="table table-striped table-hover table-condensed">
  <thead >
    <tr class="info">
      <th>Nombre Completo</th>
      <th>Email</th>
      <th>Telefono Personal</th>
      <th>Otro Telefono</th>
      <th>Accion<th>
    </tr>
  </thead>
  <tbody>
  @foreach ($clientes as $cliente)
    <tr>
      <td>{{{ $cliente->Nombre." ".$cliente->Apellido }}}</td>
      <td>{{{ $cliente->E_mail}}}</td>
      <td>{{{ $cliente->Telefono_Personal}}}</td>
      <td>{{{ $cliente->Telefono_Trabajo}}}</td>
      <td>	
      {{Form::open(array('route'=>'clientes.activar'))}}
      {{Form::hidden('id',$cliente->Id)}}
      	<button class="btn btn-sm btn-primary" type='submit'>Activar</button></td>
      {{Form::close()}}
      <td><a href="{{{URL::action('ClientesController@edit',$cliente->Id)}}}"><button class="btn btn-sm btn-warning" href="/"> Editar</button></a></td>
    </tr>
  @endforeach
  </tbody>
</table> 
</div>
@else
	<div class="well">
		<h3>No se econtraron clientes desactivados!  :(</h3>
	</div>

@endif


@stop
