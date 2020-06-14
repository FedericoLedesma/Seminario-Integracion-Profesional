@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('alimentos.index') }}">Alimentos</a></li>
		<li class="breadcrumb-item active">Ver Alimento</li>
@endsection
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
<style>
<!--
	.table-resposive{
		float:left;
	}

-->
</style>
	   @include('layouts.error')
	  	@if($alimento)
	    <div class="table-responsive">
	    <h2>Alimento:  {{$alimento->name}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$alimento->id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$alimento->name}}</td>
			</tr>
      <tr>
				<td>CREADO </td>
				<td>{{$alimento->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$alimento->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('alimentos.edit', $title = 'MODIFICAR', $parameters = [$alimento],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
@section('script')
  <script type="text/javascript">
  	$(document).ready(function(){
  		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
  		document.getElementById("nav-alimentos").setAttribute("class","nav-link active");
  		});
  </script>
@endsection
