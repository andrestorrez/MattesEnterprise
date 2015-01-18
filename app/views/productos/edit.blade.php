@extends('layouts.main')

@section('content')
	@include('layouts.breadcrumbs',array('breadcumnds'=>$breadcrumbs))
	@include('productos._form',compact($route,$producto))

@stop
