@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Patologias</a></li>
		<li class="breadcrumb-item active">Ver Patologia</li>
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
	  	@if($patologia)
	    <div class="table-responsive">
	    <h2>Patologia:  {{$patologia->name}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$patologia->id}}</td>
			</tr>
      <tr>
				<td>Tipo Patologia </td>
				<td>{{$patologia->tipo_patologia_id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$patologia->name}}</td>
			</tr>
      <tr>
				<td>Descripcion </td>
				<td>{{$patologia->descripcion}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$patologia->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$patologia->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('patologias.edit', $title = 'MODIFICAR', $parameters = [$patologia],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection
