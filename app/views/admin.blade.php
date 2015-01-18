@extends('layouts.main')

@section('content')

<div class="clearfix">

  <div align="center">  
      <div class="col-md-3"></div>
    <div class="well col-md-6 ">
          <h1><i class="glyphicon glyphicon-cog"></i> Administración</h1>
      <br>

     <a class="btn btn-lg btn-primary btn-block" href="{{{URL::route('clientes.index')}}}">
     <i class="glyphicon glyphicon-user"></i> Clientes</a>
     <a class="btn btn-lg btn-primary btn-block" href="{{{URL::route('productos.index')}}}">
     <i class="glyphicon glyphicon-th"></i> Productos</a>
     <a class="btn btn-lg btn-primary btn-block" href="{{{URL::route('ventas.index')}}}">
     <i class="glyphicon glyphicon-usd"></i> Ventas</a>
     <a class="btn btn-lg btn-primary btn-block" href="{{{URL::route('ventas.index')}}}">
     <i class="glyphicon glyphicon-th-list"></i> Reportes</a>
  
    </div>
    <div class="col-md-3"></div>
  </div>
 </div>
@stop