@extends('layouts.main')

@section('content')

<div class="row">

<div class="col-md-4 col-xs-4 table-responsive">
<ul class="nav nav-pills nav-stacked " style="max-width: 300px;">
  <li class="active" ><a href="{{{URL::action('ClientesController@index')}}}">Clientes</a></li>
  <li class=""><a href="{{{URL::action('ProductosController@index')}}}">Productos</a></li>
  <li class="disabled"><a href="#">--</a></li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      -- <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <li><a href="#">Action</a></li>
      <li><a href="#">Another action</a></li>
      <li><a href="#">Something else here</a></li>
      <li class="divider"></li>
      <li><a href="#">Separated link</a></li>
    </ul>
  </li>
</ul>
</div>
<div class="col-md-7 col-xs-8">
	<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"></h3>
  </div>
  <style type="text/css">

      @media (min-width: 700px){
          h4.title{
            
            font-size: 400%;
          }
        }

  </style>
  <div class="panel-body" align="center">
  <h4 class="title">Administracion</h4>
    <img src="/img/config.png" width="30%">

  </div>
</div>
</div>
</div>
@stop