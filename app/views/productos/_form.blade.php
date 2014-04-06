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
		      </div>
		      <div>
				<button type="button"  class="btn btn-primary label-control">
					<i class="glyphicon glyphicon-plus"></i></button>
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
</div>


@section('scripts')
<script type="text/javascript">
	
	$(document).ready(function(){
		$('label').addClass('col-md-2 control-label');
		$('input').addClass('form-control');
		$('textarea').addClass('form-control');
		$('select').addClass('form-control');
	});
</script>

@stop