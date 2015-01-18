	{{Form::open(array(
		'route'=>'clientes.search',
		'method'=>'get',
		'class'=>'form-inline form-horizontal',
		'id'=>'search'
	))}}
	
		<div class='form-group'>
		<div class="col-sm-3">
			<a class="btn btn-sm btn-primary" href="{{{URL::action('ClientesController@create')}}}">
			<i class='glyphicon glyphicon-plus'></i> Agregar cliente</a>
		</div>
		<div class="col-sm-4">
			<a class="btn btn-sm btn-warning" href="{{{URL::action('ClientesController@deleted')}}}">
			<i class='glyphicon glyphicon-trash'></i> Clientes Desactivados</a>
		</div>
		
		<div class="col-sm-4 col-xs-9">
			<input required value="{{{$search}}}" name="search" id="search" type="search" placeholder="Buscar Nombre,Email,Telefono" class="form-control input-sm">
			
		</div>
		<button style="margin-left:1%;" class="btn btn-sm" type='submit'>
		<span class="glyphicon glyphicon-search"></span><font color="#ecf0f1">.</font></button>
		</div>
	{{Form::close()}}