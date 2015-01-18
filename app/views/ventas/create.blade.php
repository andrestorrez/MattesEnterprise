@extends('layouts.main')

@section('content')
@if (Cookie::has('mycook'))
	<p>Cookie :D</p>
	{{json_encode(Cookie::get('mycook'))}}
@else 
	<p>No cookie :(</p>
@endif

@include('layouts.breadcrumbs',array('breadcumnds'=>$breadcrumbs))

@include('ventas._form',compact($route,$venta))
@stop
