@if(isset($breadcrumbs))
	<ol class="breadcrumb">
		<li><a href="{{{URL::to('administracion')}}}">Administracion</a></li>
	<?php $route='administracion/'; $lenght=count($breadcrumbs); $i=1;
	 foreach ($breadcrumbs as $breadcrumb): ?>	
	 	<?php $route=$route.strtolower($breadcrumb['name'])."/";  if ($i==$lenght){break;}else{$i++;} ?>
	  		<li><a href="{{{url($route)}}}">{{{$breadcrumb['name']}}}</a></li>
	 <?php endforeach ?>
	 <li class="active">{{{$breadcrumb['name']}}}</li>	
	</ol>
@endif