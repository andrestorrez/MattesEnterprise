<style type="text/css">
	

  .table-responsiv {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: scroll;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #ddd;
  }
  .table-responsiv > .table {
    margin-bottom: 0;
  }
  .table-responsiv > .table > thead > tr > th,
  .table-responsiv > .table > tbody > tr > th,
  .table-responsiv > .table > tfoot > tr > th,
  .table-responsiv > .table > thead > tr > td,
  .table-responsiv > .table > tbody > tr > td,
  .table-responsiv > .table > tfoot > tr > td {
    white-space: nowrap;
  }
  .table-responsiv > .table-bordered {
    border: 0;
  }
  .table-responsiv > .table-bordered > thead > tr > th:first-child,
  .table-responsiv > .table-bordered > tbody > tr > th:first-child,
  .table-responsiv > .table-bordered > tfoot > tr > th:first-child,
  .table-responsiv > .table-bordered > thead > tr > td:first-child,
  .table-responsiv > .table-bordered > tbody > tr > td:first-child,
  .table-responsiv > .table-bordered > tfoot > tr > td:first-child {
    border-left: 0;
  }
  .table-responsiv > .table-bordered > thead > tr > th:last-child,
  .table-responsiv > .table-bordered > tbody > tr > th:last-child,
  .table-responsiv > .table-bordered > tfoot > tr > th:last-child,
  .table-responsiv > .table-bordered > thead > tr > td:last-child,
  .table-responsiv > .table-bordered > tbody > tr > td:last-child,
  .table-responsiv > .table-bordered > tfoot > tr > td:last-child {
    border-right: 0;
  }
  .table-responsiv > .table-bordered > tbody > tr:last-child > th,
  .table-responsiv > .table-bordered > tfoot > tr:last-child > th,
  .table-responsiv > .table-bordered > tbody > tr:last-child > td,
  .table-responsiv > .table-bordered > tfoot > tr:last-child > td {
    border-bottom: 0;
  }



</style>


<div class="well"> 
	{{ Form::model($venta,array(
		'route' =>$route,
		'class'=>'form-horizontal'

	)) }}

		<fieldset>
		<div class="row" style="background-color:white; border-radius:3px;">
			<div class="col-md-2">
				<br>
				<button type="button" class="btn btn-primary"> Agregar Producto</button>
			</div>

			<div class="col-md-10">
				<br>
				<div class="table-responsiv" >
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Precio unitario</th>
								<th>Cantidad</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody >
							
							<tr>
								<td>hhhhhhhhhhhhhhhhhhhhhhhhhhh</td>
								<td>100</td>
								<td>1000</td>
								<td>10000</td>
							</tr>
						</tbody>

					</table>
				</div>
				
			</div>

		</div>
		<br>
			@include('_messages.errors')
		    <legend>Nueva Venta</legend>
		    

		    	<div class="row">
		    		<div class="form-group">
		    			{{Form::label('Subtotal','Sub-total: ')}}
		    			<div class="col-md-3">
		    				{{Form::text('Subtotal',null,array('disabled'=>''))}}
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			{{Form::label('ISV','Impuesto: ')}}
		    			<div class="col-md-3">
		    				{{Form::text('ISV',null,array('disabled'=>''))}}
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			{{Form::label('Total','Total: ')}}
		    			<div class="col-md-3">
		    				{{Form::text('Total',null,array('disabled'=>''))}}
		    			</div>
		    		</div>
		    	</div>
		    	<div class="col-md-3">
		    		{{Form::submit('Crear Venta',array('class'=>'btn btn-success'))}}
		    	</div>
		</fieldset>
	{{Form::close()}}
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