
<div style="padding-bottom:5%;">
<?php if(!isset($search)) $search="";?>
	{{Form::open(array(
		'route'=>'productos.search',
		'method'=>'get',
		'class'=>'form-inline form-horizontal',
		'id'=>'search'
	))}}
	
		<div class='form-group'>
			<div class="col-sm-7">
				<a href="{{{URL::route('productos.create')}}}" class="btn btn-primary btn-sm">
				<i class="glyphicon glyphicon-plus"></i> Agregar Producto</a>
				<a href="{{{URL::route('productos.deleted')}}}" class="btn btn-warning btn-sm">
				<i class="glyphicon glyphicon-trash"></i> Descontinuados</a>
			</div>
			<div class="col-sm-3">
				
			</div>
			<div class="col-sm-4 col-xs-9">
				<input required value="{{{$search}}}" name="search" id="search" type="search" placeholder="Buscar Nombre" class="form-control input-sm">
				
			</div>
			<button style="margin-left:1%;" class="btn btn-sm" type='submit'>
			<span class="glyphicon glyphicon-search"></span><font color="#ecf0f1">.</font></button>
		</div>
	{{Form::close()}}

</div>