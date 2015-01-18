<div class="modal-body">
@if ($producto!=array())
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h2 class="panel-title">{{{$producto->Nombre}}} {{{$producto->Apellido}}}</h2>
	  </div>
	  <div class="panel-body row" style="word-wrap: break-word;">
	    <?php $path='/img/productos/'.$producto->Id.'/'; ?>
		     <div class="col-md-12" align="center">
		       	<?php $files = scandir(public_path().$path);?>
		       	@if ($files!=array())
			       		@foreach ($files as $file)
			       			@if (preg_match("/^.\\.jpg/", $file))
			       			<div class="image{{$producto->Id}}">
			       				<img class="img-thumbnail img-responsive" src="{{{$path.$file}}}" whidth="20%">
			       			</div>
			       			@endif
			       		@endforeach
			    @else 
			    	<img class="img-thumbnail img-responsive" src="/img/background.png" whidth="20%">
			    @endif	        
		     </div>
		     <div class="col-md-12">
		     	<button id="control-prev{{$producto->Id}}" value="{{$producto->Id}}" class="btn btn-sm">
		     	Ant.</button>
		     	<button id="control-next{{$producto->Id}}" value="{{$producto->Id}}" class="btn btn-sm">
		     	Sig.</button>
		     </div>
		     <div class="col-md-12">	
		     	<p>
		        	<i class="glyphicon glyphicon-asterisk"></i>
		        	<strong>Nombre: </strong>
		        	{{{$producto->Nombre}}}</p>
		     	
		        <p>
		        	<i class="glyphicon glyphicon-envelope"></i>
		        	<strong>Existencia: </strong>{{{$producto->Cantidad}}}</p>

		        <p>
		        	<i class="glyphicon glyphicon-phone"></i>
		        	<strong>Costo Unitario: </strong>
		        	{{{$producto->Costo_Unitario}}}</p>

		        <p>
		        <i class="glyphicon glyphicon-earphone"></i>
		        	<strong>Precio Unitario: </strong>
		        	{{{$producto->Precio_Unitario}}}
		        	</p>

			    <p>
		        	<i class="glyphicon glyphicon-globe	"></i>
		        	<strong>Descripcion: </strong>{{{$producto->Descripcion}}}</p>
			    {{ Form::open(
		        	array(
		        	'method'=>'DELETE', 
		        	'route'=>array('productos.delete',$producto->Id),
		        	'class'=>'form-inline form-horizontal')) }}
			        {{Form::hidden('id',$producto->Id)}}
			        <a href="{{{URL::route('productos.edit',$producto->Id)}}}" class="btn btn-md btn-success">
			        <i class="glyphicon glyphicon-edit"></i> </a>
			        <button type='submit' class="btn btn-danger btn-md" role="button">
			        <i class="glyphicon glyphicon-remove"></i> </button>

		        {{Form::close()}}
		    </div>
	  </div>
	</div>

@else

	<div class='well'>
		<h2>No se encontro el producto que buscabas :(</h2>
	</div>
@endif
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
</div>

<script type="text/javascript">
	pointer{{$producto->Id}}=0;
	images{{$producto->Id}} = $(".image{{$producto->Id}}");
	images{{$producto->Id}}.hide();
	$(images{{$producto->Id}}[0]).fadeIn();
	$("#control-prev{{$producto->Id}}")[0].disabled=true;
	if(images{{$producto->Id}}.length<2)
		$("#control-next{{$producto->Id}}")[0].disabled=true;
	$("#control-prev{{$producto->Id}}").on('click',function(){
		$(images{{$producto->Id}}[pointer{{$producto->Id}}]).hide();
		pointer{{$producto->Id}}--;
		$(images{{$producto->Id}}[pointer{{$producto->Id}}]).fadeIn();
		if(pointer{{$producto->Id}}==0)
			this.disabled=true;
		$("#control-next{{$producto->Id}}")[0].disabled=false;
	});
	$("#control-next{{$producto->Id}}").on('click',function(){
		$(images{{$producto->Id}}[pointer{{$producto->Id}}]).hide();
		pointer{{$producto->Id}}++;
		$(images{{$producto->Id}}[pointer{{$producto->Id}}]).fadeIn();
		if(pointer{{$producto->Id}}==images{{$producto->Id}}.length-1)
			this.disabled=true;
		$("#control-prev{{$producto->Id}}")[0].disabled=false;
	});
</script>
