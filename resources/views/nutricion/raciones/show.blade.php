@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('raciones.index') }}">Raciones</a></li>
		<li class="breadcrumb-item active">Ver Racion</li>
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
	  	@if($racion)
	    <div class="table-responsive">
	    <h2>Racion:  {{$racion->name}}</h2>
        <div class="col-md-6 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$racion->id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$racion->name}}</td>
			</tr>
      <tr>
				<td>Observacion </td>
				<td>{{$racion->observacion}}</td>
			</tr>
      <tr>
				<td>Alimentos </td>
				<td>
          @foreach($racion->alimentos as $alimento)
            {{$alimento->name }}</br>
          @endforeach
        </td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$racion->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$racion->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('raciones.edit', $title = 'MODIFICAR', $parameters = [$racion],['class' => 'btn btn-warning'], $attributes = [])!!}





@endif
@endsection
