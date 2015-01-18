@extends('layouts.main')

@section('content')
	{{--@include('layouts.breadcrumbs',$breadcrumbs)--}}
	@if ($listaProductos->count())
	<div class="col-md-2" style="padding-left:1%;">
			<h4>Categorias</h4>
			@if ($categorias->count())
				<div class="row form-group">
				<div class="col-md-12 col-sm-3 col-xs-4" style="padding: 1px 1px 1px 1px">
					<a class="btn btn-block btn-primary" href="{{{URL::route('user.productos')}}}"><i class="glyphicon glyphicon-th" ></i>
							Todas</a>

				</div>
					@foreach ($categorias as $categoria)
						@if($categoria->Productos()->get()->count())
						<div class="col-md-12 col-sm-3 col-xs-4" style="padding: 1px 1px 1px 1px">
							<a class="btn btn-block btn-primary" href="{{{URL::route('user.productos',$categoria->Id)}}}"><i class="glyphicon glyphicon-th" ></i>
							{{{$categoria->Nombre}}}</a>		
						</div>
						@endif
					@endforeach
				</div>
			@endif
	</div>
	<div class="col-md-10">
	<div class='row'>
		<div align="center">
		<?php $cat=$listaProductos[0]->Categoria()->get()[0]->Nombre; ?>
			<h2><font color="#149c82">{{ $cat==$listaProductos[sizeof($listaProductos)-1]->Categoria()->get()[0]->Nombre? $cat:"Todas"  }}</font></h2>
		</div>
		<div align="right">
			<?php echo $listaProductos->links(); ?>
		</div>
		@foreach ($listaProductos as $producto)
			<div class="col-sm-6 col-md-4">
			  	<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">{{{$producto->Nombre}}}</h3>
				  </div>
				  <div class="panel-body table-responsive" style="word-wrap: break-word;" >
					  <div align="center">
					  	@if ($flag=file_exists(public_path()."/img/productos/".$producto->Id."/1.jpg"))
					  		<img class="img-thumbnail img-responsive" src="/img/productos/{{{$producto->Id}}}/1.jpg" width="70%">
					  	@endif
				  	  </div>
				  	  <br>
				      <p>
				      	<i class="glyphicon glyphicon-usd"></i>
				      	<strong>Precio Unitario: L.</strong> {{{ substr($producto->Precio_Unitario, 0,5)}}}</p>
				      <p>
				      	<i class="glyphicon glyphicon-list"></i>
				      	<strong>Descripcion: </strong> {{{$producto->Descripcion}}}</p>
				      <p>
				      	<!-- Button trigger modal -->
				        <a href="{{{URL::route('user.productos.show',$producto->Id)}}}" class="btn btn-info btn-sm" role="button" data-toggle="modal" data-target="#myModal{{$producto->Id}}">
				        <i class="glyphicon glyphicon-camera"></i> Ver mas...</a>
				        
				  </div>
				  <!-- Modal -->
					<div class="modal fade" id="myModal{{$producto->Id}}" tabindex="-1"  aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					    </div>
					  </div>
					</div>
				</div>
			</div>

		@endforeach
		</div>
		<div align="right">
			<?php echo $listaProductos->links(); ?>
		</div>
	</div>

	@endif

@stop