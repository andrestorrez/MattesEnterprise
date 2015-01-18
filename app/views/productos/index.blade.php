@extends('layouts.main')

@section('content')
	@include('layouts.breadcrumbs',$breadcrumbs)
	@include('productos._buttoms')
	<div align="center">
		
		<div class="col-md-2" style="padding-left:1%;">
			
			@if (isset($categorias) && $categorias->count())
				<h4>Categorias</h4>
				<div class="row form-group">
					@foreach ($categorias as $categoria)
						@if($categoria->Productos()->get()->count())
						<div class="col-md-12 col-sm-3 col-xs-4" style="padding: 1px 1px 1px 1px">
							<a class="btn btn-block btn-primary " href="{{{URL::route('productos.categoria',$categoria->Id)}}}"><i class="glyphicon glyphicon-th" ></i>
							{{{$categoria->Nombre}}}</a>		
						</div>
						@endif
					@endforeach
				</div>
			@endif
		</div>
		<div class="col-md-10">
			@if (isset($listaProductos))
				@include('productos._view',$listaProductos)
			@else
				@include('productos._view')
			@endif
		</div>
	</div>

@stop