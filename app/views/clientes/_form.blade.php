<div class="well"> 
	{{ Form::model($cliente,array(
		'route' =>$route,
		'class'=>'form-horizontal'

	)) }}

		<fieldset>
		    @include('_messages.errors')
		    	@if ($cliente==null)
		    	<?php $btnText="Crear"; ?>
		    		<legend>Nuevo Cliente</legend>
		    	@else
		    	<?php $btnText="Actualizar" ?>
		    		<legend>Editar Cliente</legend>
		    		{{Form::hidden('Id')}}
		    	@endif
		    
		    <div class="form-group">
		    {{Form::label('No_Identidad','No. Identidad:')}}
		      <div class="col-md-7">
		         {{Form::text('No_Identidad',null,array('maxlength'=>13,'placeholder'=>'#############'))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Nombre','Nombres:*')}}
		      <div class="col-md-7">
		         {{Form::text('Nombre',null,array('maxlength'=>45))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Apellido','Apellidos:*')}}
		      <div class="col-md-7">
		         {{Form::text('Apellido',null,array('maxlength'=>45))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Telefon_Personal','Telefono Personal:')}}
		      <div class="col-md-7">
		         {{Form::text('Telefono_Personal',null,array('maxlength'=>45,'placeholder'=>'########'))}}
		      </div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Telefono_Trabajo','Otro Telefono:')}}
		      <div class="col-md-7">
		         {{Form::text('Telefono_Trabajo',null,array('maxlength'=>45,'placeholder'=>'########'))}}
		      	</div>
		    </div>

		    <div class="form-group">
		    {{Form::label('E_mail','Email:*')}}
		   
		      <div class="col-md-7">
		         {{Form::email('E_mail',null,array('maxlength'=>45,'placeholder'=>'cliente@ejemplo.com'))}}
		    	</div>
		    </div>		    
		    <div class="form-group">
		    {{Form::label('Direccion','Direccion:')}}
		      <div class="col-md-7">
		         {{Form::textarea('Direccion',null,array('maxlength'=>255,'rows'=>3))}}
		    	</div>
		    </div>
		    <div class="form-group">
		    {{Form::label('Sexo','Sexo')}}
		      <div class="col-md-7">
		         {{Form::select('Sexo',array(0=>'Masculino',1=>'Femenino'))}}
		    	</div>
		    </div>

		     <div class="form-group">
		     <div class="col-md-7 col-md-offset-2">
		    	{{Form::button($btnText,array('class'=>'btn btn-success','type'=>'submit'))}}
		   		<a class="btn btn-default" href="{{{URL::action('ClientesController@index')}}}">Cancelar</a>
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