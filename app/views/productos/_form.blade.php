<div class="well"> 
	{{ Form::model($producto,array(
		'route' =>$route,
		'class'=>'form-horizontal'

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
		         {{Form::text('Nombre',null,array('required','maxlength'=>45))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Cantidad','Cantidad:*')}}
		      <div class="col-md-7">
		         {{Form::input('number','Cantidad',null,array('required','min'=>0))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Costo_Unitario','Costo:*')}}
		      <div class="col-md-7">
		         {{Form::text('Costo_Unitario',null,array('required'))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Precio_Unitario','Precio:*')}}
		      <div class="col-md-7">
		         {{Form::text('Precio_Unitario',null,array('required'))}}
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
		      <div class="col-md-7 col-xs-10">
		         {{Form::select('Categoria_Id',Categoria::lists('Nombre','Id'))}}
		         {{Form::text('NewCategory',null,array('style'=>'display: none;'))}}
		      </div>
		      <div>
				<button id="addCategory" type="button"  class="btn btn-primary label-control">
					<i class="glyphicon glyphicon-plus"></i></button>
				</div>
		    </div>
		    <div class="form-group">
		    	 {{Form::label('image','Photos:')}}
		    	<div class="col-md-7">
		    		<input name="image" type="file" id="image" class="form-control" multiple accept="image/*">
		    	</div>

		    </div>

		     <div class="form-group">
		     <div class="col-md-7 col-md-offset-2">
		    	{{Form::button($btnText,array('class'=>'btn btn-success','type'=>'submit'))}}
		   		<a class="btn btn-default" href="{{{URL::action('ProductosController@index')}}}">Cancelar</a>
		      </div>
		    </div>

		     
		  </fieldset>

	{{ Form::close() }}


<form enctype="multipart/form-data" method="post" action="upload.php">
    <div class="row">
      <label for="fileToUpload">Select Files to Upload</label><br />
      <input type="file" name="filesToUpload[]" id="filesToUpload" multiple="multiple" />
      <output id="filesInfo"></output>
    </div>
    <div class="row">
      <input class="btn btn-success" type="submit" value="Upload" />
    </div>
</form>

<div id="dropTarget" style="width: 100%; height: 100px; border: 1px #ccc solid; padding: 10px;">Drop some files here</div>
<output id="filesInfo"></output>
</div>


@section('scripts')
<script type="text/javascript">
	
	$(document).ready(function(){
		$('label').addClass('col-md-2 control-label');
		$('input').addClass('form-control');
		$('textarea').addClass('form-control');
		$('select').addClass('form-control');

		$('#addCategory').on('click',function(){
			var txt=$('[name="NewCategory"]');
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


function fileSelect(evt) {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var files = evt.target.files;
        var result = '';
        var file;
    for (var i = 0; file = files[i]; i++) {
        result += '<li>' + file.name + ' ' + file.size + ' bytes</li>';
        }
    document.getElementById('filesInfo').innerHTML = '<ul>' + result + '</ul>';
    } else {
    alert('The File APIs are not fully supported in this browser.');
    }
}
document.getElementById('filesToUpload').addEventListener('change', fileSelect, false);


	});
</script>

@stop