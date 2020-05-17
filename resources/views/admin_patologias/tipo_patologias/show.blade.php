@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('tipospatologias.index') }}">Tipos de Patologias</a></li>
		<li class="breadcrumb-item active">Ver Tipo de Patologia</li>
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
	  	@if($tipoPatologia)
	    <div class="table-responsive">
	    <h2>Tipo de Patologia:  {{$tipoPatologia->name}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$tipoPatologia->id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$tipoPatologia->name}}</td>
			</tr>
      <tr>
				<td>Observacion </td>
				<td>{{$tipoPatologia->observacion}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$tipoPatologia->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$tipoPatologia->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
    {!!link_to_route('tipospatologias.edit', $title = 'MODIFICAR', $parameters = [$tipoPatologia],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
