@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personas.index') }}">Persona</a></li>
		<li class="breadcrumb-item active">Ver Persona</li>
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
	  	@if($persona)
	    <div class="table-responsive">
	    <h2>Persona:  {{$persona->name}}</h2>
        <div class="col-md-6 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$persona->id}}</td>
			</tr>
      <tr>
				<td>Tipo Doc </td>
				<td>{{$persona->tipoDocumento->name}}</td>
			</tr>
      <tr>
				<td>Numero_doc </td>
				<td>{{$persona->numero_doc}}</td>
			</tr>
			<tr>
				<td>Apellido </td>
				<td>{{$persona->apellido}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$persona->name}}</td>
			</tr>
      <tr>
				<td>Observacion </td>
				<td>{{$persona->observacion}}</td>
			</tr>
      <tr>
				<td>EMail </td>
				<td>{{$persona->email}}</td>
			</tr>
      <tr>
				<td>Provincia </td>
				<td>{{$persona->provincia}}</td>
			</tr>
      <tr>
				<td>Localidad </td>
				<td>{{$persona->localidad}}</td>
			</tr>
      <tr>
				<td>Sexo </td>
				<td>{{$persona->sexo}}</td>
			</tr>
      <tr>
				<td>Patologias </td>
				<td>
          @foreach($persona->patologias as $patologia)
            {{$patologia->name }}</br>
          @endforeach
        </td>
			</tr>
      <tr>
				<td>Fecha de Nacimiento </td>
				<td>{{$persona->fecha_nac}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$persona->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$persona->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('personas.edit', $title = 'MODIFICAR', $parameters = [$persona],['class' => 'btn btn-warning'], $attributes = [])!!}





@endif
@endsection
