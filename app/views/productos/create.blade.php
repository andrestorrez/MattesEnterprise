@extends('layouts.main')

@section('content')
	@include('layouts.breadcrumbs', $breadcrumbs)
	@include('productos._form',compact($producto,$route))
@stop
