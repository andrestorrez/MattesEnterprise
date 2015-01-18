<div class="well"> 
	{{ Form::model($producto,array(
		'route' =>$route,
		'class'=>'form-horizontal',
		'files'=>true

	)) }}

		<fieldset>
		    @include('_messages.errors')
		    	@if ($producto==null)
		    	<?php $btnText="Crear"; ?>
		    		<legend>Nuevo producto</legend>
		    	@else
		    	<?php $btnText="Actualizar" ?>
		    		<legend>Editar producto</legend>
		    		{{Form::hidden('Id')}}
		    	@endif
		    
		    <div class="form-group">
		    {{Form::label('Nombre','Nombre:*')}}
		      <div class="col-md-7">
		         {{Form::text('Nombre',null,array('requirede','maxlength'=>45))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Cantidad','Cantidad:*')}}
		      <div class="col-md-7">
		         {{Form::input('number','Cantidad',null,array('requirede','min'=>0))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Costo_Unitario','Costo:*')}}
		      <div class="col-md-7">
		         {{Form::text('Costo_Unitario',null,array('requirede'))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Precio_Unitario','Precio:*')}}
		      <div class="col-md-7">
		         {{Form::text('Precio_Unitario',null,array('requirede'))}}
		      	</div>
		    </div>
		    
		    <div class="form-group">
		    {{Form::label('Descripcion','Descripcion:')}}
		      <div class="col-md-7">
		         {{Form::textarea('Descripcion',null,array('maxlength'=>140,'rows'=>2))}}
		    	</div>
		    </div>
		    <div class="form-group row">
		    <div>
		    {{Form::label('Categoria_Id','Categoria:')}}
		    </div>
		      <div class="col-md-7 col-xs-9">
		         {{Form::select('Categoria_Id',Categoria::lists('Nombre','Id'))}}
		         {{Form::text('Nombre_categoria',"",array('style'=>'display: none;'))}}
		      </div>
		      <div>
				<button id="addCategory" type="button"  class="btn btn-primary label-control">
					<i class="glyphicon glyphicon-edit"></i></button>
				</div>
		    </div>
				 <div class="form-group" id='image-lbl'>
				    	 {{Form::label('image-files','Photos:')}}
				    	<div id="image-files" class="col-md-3 col-sm-6">
					    	<button id="btn-add-image" type='button' class="btn btn-info form-control"><i class="glyphicon glyphicon-plus"></i> Agregar Imagen...</button>
					    	<input id="input-image-ch" type="file" style="display:none;" accept="image/*">
					    	<select id="image-list" size="6"></select>
					    </div>
					    <div class="col-sm-3">
							<button id="removeImageChooser" type="button" class="btn btn-danger">
								<i class='glyphicon glyphicon-minus'></i></button>
					    </div>
				    	<div id="hidden-files">
				    		
				    	</div>
						<div class="col-md-3">
							<h3 id="crop-status"></h3>
						</div>

						<div id="crop-area" style="display:none;">
							
							<div id="inner-crop-area" class='col-md-12 col-md-offset-2 col-xs-12'>
								<button id="btn-crop-accept" type="button" class="btn btn-sm btn-info">Aceptar</button>
							</div>
							
						</div>
						
				 </div>
				 

				 <br>
		     <div class="form-group">
			     <div class="col-md-7 col-md-offset-2">
			    	{{Form::button($btnText,array('class'=>'btn btn-success','type'=>'submit'))}}
			   		<a class="btn btn-default" href="{{{URL::previous()}}}">Cancelar</a>
			      </div>
		    </div>

		     
		  </fieldset>

	{{ Form::close() }}

@section('scripts')

<link rel="stylesheet" href="/jcrop/css/jquery.Jcrop.css" type="text/css" />
<script src="/jcrop/js/jquery.Jcrop.min.js"></script>
<script src="/jcrop/js/jquery.color.js"></script>
<script type="text/javascript">
	
	
	var idSelected,file,api;
	$(document).ready(function(){
		$('label').addClass('col-md-2 control-label');
		$('input').addClass('form-control');
		$('textarea').addClass('form-control');
		$('select').addClass('form-control');
		$('[name="Nombre_categoria"]').val('');
		$('label[for=image-files]').css('padding-bottom',0);
		

		$('#btn-add-image').on('click',function(){
			$('#input-image-ch').click();
		});

		$('#input-image-ch').on('change',function(){
			file=$(this)[0].files[0];
				var input=$(this);
				$('[id=image-crop]').remove();
				//console.log(file.size);
				formData=new FormData();
				formData.append('image',file);
				$.ajax({
				    url: "{{{URL::route('productos.image')}}}",
				    type: "post",
				    data: formData,
				    processData: false,
				    contentType: false,
				    beforeSend: function(){
				    	if (file.size>1572864){
				    		$('#crop-status').text('Archivo muy grande');
				    		return false;
				    	}
				    	$('#crop-status').text('Espere...');
				    	return true;
				    },
				    success: function (res) {
				    	if(res.image!=""){
					    	$('#crop-status').text('');
					      	showCropArea(res.image,input);
					     }else{
					     	$('#crop-status').text('No selecciono imagen');
					     }
				    },
				    error: function(xhr) {
				    	$('#crop-status').text('Error');
				     console.error("Este callback maneja los errores", xhr.responseText);
				   },
				  });
		});

		$('#addCategory').on('click',function(){
			var txt=$('[name="Nombre_categoria"]');
			var select=$('#Categoria_Id');
			if (txt.is(':visible')){
				txt.hide();
				txt.val('');
				select.fadeIn();
			}else{
				select.hide();
				txt.fadeIn();
				txt.focus();
				
			}
		});

		  function add_img_ch(){
		  	var lst=$('#image-list')[0];
		  	var imgInput=$('#input-image-ch')[0];
		  	var file=imgInput.files[0];
			var div=$('#hidden-files');
			var id=$('#image-files > div').length+1;
			if(id<6){
				name='img-ch-'+id;
				var innerdiv=$('<div>')
					.attr('id','div-image-chooser-'+id)
					.addClass('col-md-7 col-xs-9');				

				var input=$('<input>')
					.addClass('form-control')
					.attr({
						id:name,
						name:name,
						type:'file',
						accept:'image/png,image/jpg',
						style:'display:none;'
					});
				
				innerdiv.append(input);
				var array=['x-','y-','w-','h-'];
				for (var i = 0; i < array.length; i++) {
					var hidden=$('<input>')
					.attr({
						id:array[i]+name,
						name:array[i]+name,
						type:'hidden'
					})
					innerdiv.append(hidden);
				};
				div.append(innerdiv);
				lst.appendChild($('<option value="img-ch-"'+imgInput.childNodes.length+'>'+file.name+'</option>')[0]);
			}
		}

		$('#removeImageChooser').on('click',function(){
			var index=$('image-list').selectedIndex();
			$('#crop-area').hide();
		});

		$("#btn-crop-accept").on('click',function(){
			$('#crop-area').fadeOut();
			add_img_ch();

		});

		function showCropArea(source,input){
			idSelected=input[0].id;
			console.log("id:"+idSelected);
			var div=$('<div>').attr('id','image-crop');
			var img=$('<img>').attr({
				src:source,
				id:'img-cropped'
			});
			div.append(img);

		    $('#inner-crop-area').prepend(div);
		   	$('#crop-area').fadeIn();

		   	img.Jcrop({
		      // start off with jcrop-light class
		      bgOpacity: 0.5,
		      bgColor: 'white',
		      addClass: 'jcrop-light',
		      aspectRatio: 4 / 3,
		      onSelect:updateCoords,
		    },function(){
		      api = this;
		      api.setSelect([0,0,130+350,65+285]);
		      api.setOptions({ bgFade: true });
		      api.ui.selection.addClass('jcrop-selection');
		    });
			
		}

		function updateCoords(c)
		{
		    $('#x-'+idSelected).val(c.x);
		    $('#y-'+idSelected).val(c.y);
		    $('#w-'+idSelected).val(c.w);
			$('#h-'+idSelected).val(c.h);
		};

		  function checkCoords()
		  {
		    if (parseInt($('#w-'+idSelected).val())) return true;
		    alert('No ha seleccionado un area de corte');
		    return false;
		  };

		  function sum_px(val,plus){
		  		return parseInt(val.replace('px',''))+parseInt(plus.replace('px',''));
		  }

	


  });

</script>

@stop