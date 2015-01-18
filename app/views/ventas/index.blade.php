@extends('layouts.main')

@section('content')
	<a class="btn btn-sm btn-primary" href="{{URL::route('ventas.create')}}">
		Crear Venta
	</a>

	@if ($Ventas->count()) 
		
	@endif

@stop