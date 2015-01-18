@extends('layouts.main')

@section('content')
	@include('layouts.breadcrumbs',array('breadcumnds'=>$breadcrumbs))
	@include('clientes._form',compact($route,$cliente))

@stop


