
<div>
	@if (isset($listaProductos) && $listaProductos->count())
	<?php $cat=$listaProductos[0]->Categoria()->get()[0]->Nombre; ?>
			<h2><font color="#149c82">{{ $cat==$listaProductos[sizeof($listaProductos)-1]->Categoria()->get()[0]->Nombre? $cat:"Todas"  }}</font></h2>
	<div class='row'>
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
				      	<i class="glyphicon glyphicon-shopping-cart"></i>
				      	<strong>Existencias: </strong> {{{$producto->Cantidad}}}</p>
				      <p>
				      	<i class="glyphicon glyphicon-usd"></i>
				      	<strong>Costo Unitario: L.</strong> {{{substr($producto->Costo_Unitario,0,5)}}}</p>
				      <p>
				      	<i class="glyphicon glyphicon-usd"></i>
				      	<strong>Precio Unitario: L.</strong> {{{ substr($producto->Precio_Unitario, 0,5)}}}</p>
				      <p>
				      	<i class="glyphicon glyphicon-list"></i>
				      	<strong>Descripcion: </strong> {{{$producto->Descripcion}}}</p>
				      <p>

				      {{ Form::open(
			        	array(
			        	'method'=>'DELETE', 
			        	'route'=>array('productos.delete',$producto->Id),
			        	'class'=>'form-inline form-horizontal')) }}
				        {{Form::hidden('id',$producto->Id)}}
				        <a href="{{{URL::route('productos.show',$producto->Id)}}}" class=" btn btn-info btn-md" role="button" data-toggle="modal" data-target="#myModal{{$producto->Id}}">
				        <i class="glyphicon glyphicon-info-sign"></i> </a>
				        <a href="{{{URL::route('productos.edit',$producto->Id)}}}" class="btn btn-md btn-success">
				        <i class="glyphicon glyphicon-edit"></i> </a>
				        <button type='submit' class="btn btn-danger btn-md" role="button">
				        <i class="glyphicon glyphicon-remove"></i> </button>

			        {{Form::close()}}
			        <!-- Modal -->
					<div class="modal fade" id="myModal{{$producto->Id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content"></div>
					  </div>
					</div>
				  </div>
				</div>
			</div>

		@endforeach
	</div>
	@else
		<h3 style="vertical-align:middle;">
		<font color="gray"> Seleccione una categoria para ver productos</font></h3>
	@endif
</div>
