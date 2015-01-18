    <div class="modal-body">  
			  	<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">{{{$producto->Nombre}}}</h3>
				  </div>
				  <div class="panel-body table-responsive" style="word-wrap: break-word;" >
					   <?php $path='/img/productos/'.$producto->Id.'/'; ?>
					   <div class="row">
					     <div class="col-md-12" align="center" >
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
					     <div class="col-md-12" align="center">
					     	<button id="control-prev{{$producto->Id}}" value="{{$producto->Id}}" class="btn btn-sm">
					     	Ant.</button>
					     	<button id="control-next{{$producto->Id}}" value="{{$producto->Id}}" class="btn btn-sm">
					     	Sig.</button>
					     </div>
				  	  
				  	  <div class="col-md-12">
					      <p>
					      	<i class="glyphicon glyphicon-usd"></i>
					      	<strong>Precio Unitario: L.</strong> {{{ substr($producto->Precio_Unitario, 0,5)}}}</p>
					      <p>
					      	<i class="glyphicon glyphicon-list"></i>
					      	<strong>Descripcion: </strong> {{{$producto->Descripcion}}}</p>
					  </div>	
					  </div>
				  </div>
				</div>
	</div>
	<div class="modal-footer">
	    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
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

	