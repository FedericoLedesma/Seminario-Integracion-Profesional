@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personas.index') }}">Personas</a></li>
		<li class="breadcrumb-item active">Editar Persona</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($persona, ['route' => ['personas.update', $persona->id], 'method'=> 'PUT'])!!}
	 	@if($persona)
	    <h1>Editar Persona  {{$persona->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$persona->id}}</td>
  			</tr>
        <tr>
  				<td>Tipo Doc </td>
  				<td>{{$persona->tipo_documento_id}}</td>
  			</tr>
        <tr>
  				<td>Numero_doc </td>
  				<td>	{!!	Form::text('numero_doc',$persona->numero_doc)!!}</td>
  			</tr>
  			<tr>
  				<td>Apellido </td>
  				<td>{!!	Form::text('apellido',$persona->apellido)!!}</td>
  			</tr>
        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$persona->name)!!}</td>
  			</tr>
        <tr>
  				<td>Observacion </td>
  				<td>{!!	Form::text('observacion',$persona->observacion)!!}</td>
  			</tr>
        <tr>
  				<td>EMail </td>
  				<td>{!!	Form::text('email',$persona->email)!!}</td>
  			</tr>
        <tr>
  				<td>Provincia </td>
  				<td>{!!	Form::text('provincia',$persona->provincia)!!}</td>
  			</tr>
        <tr>
  				<td>Localidad </td>
  				<td>{!!	Form::text('localidad',$persona->localidad)!!}</td>
  			</tr>
        <tr>
  				<td>Sexo </td>
  				<td>{!!	Form::text('sexo',$persona->sexo)!!}</td>
  			</tr>
        <tr>
  				<td>Fecha de Nacimiento </td>
  				<td>{!!	Form::text('fecha_nac',$persona->fecha_nac)!!}</td>
  			</tr>
		   	<tr>
	    	<td>
		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		    </td>
        </tr>
        <tr>
		    <td>
		   	{!!link_to_route('personas.show', $title = 'CANCELAR', $parameters = [$persona], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif

		</div>
		</div>
@endsection
