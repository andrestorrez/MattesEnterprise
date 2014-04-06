@extends('layouts.main')

@section('content')
	@include('layouts.breadcrumbs',$breadcrumbs)

	<a href="{{{URL::route('productos.create')}}}" class="btn btn-primary btn-sm">
		<i class="glyphicon glyphicon-plus"></i>
		 Agregar Producto
	</a>
@stop
