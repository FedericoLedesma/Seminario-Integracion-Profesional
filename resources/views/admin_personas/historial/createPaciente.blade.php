<head>
  <script
          src="https://code.jquery.com/jquery-3.5.1.js"
          integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
          crossorigin="anonymous">
  </script>
</head>


@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historial pacientes</a></li>
		<li class="breadcrumb-item active">Ingresar paciente</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    <h1>Ingresar nueva persona</h1>


    {!!Form::open(['method'=>'get','action'=>'HistorialInternacionController@ingresarNuevo'])!!}
    <div>
       <div>
            {!!	Form::label('numero_doc', 'Numero Doc.')!!}
            {!!	Form::text('numero_doc')!!}
      </div>
       <div>
            {!!	Form::label('tipo_documento_id', 'Tipo de Documento')!!}
            @if($tipos_documentos)
              <select name="tipo_documento_id">
              <!--	<option selected>Seleccione el Rol</option>validar-->
            @foreach ($tipos_documentos as $tipos_documento)
            <!-- Opciones de la lista -->
              <option value="{{$tipos_documento->id}}" >{{$tipos_documento->name}}</option> <!-- Opci�n por defecto -->

            @endforeach
             </select>
           @endIf
      </div>
      <div>
            {!!	Form::label('name', 'Nombre')!!}
            {!!	Form::text('name')!!}
      </div>
       <div>
            {!!	Form::label('apellido', 'Apellido')!!}
            {!!	Form::text('apellido')!!}
      </div>
       <div>
            {!!	Form::label('peso', 'Peso')!!}
            {!!	Form::text('peso')!!}
      </div>
       <div>
            {!!	Form::label('sector_id', 'Sector')!!}
            @if($sectores)
              <select name="sectores" id='sectores'>
              <!--	<option selected>Seleccione el Rol</option>validar-->
            @foreach ($sectores as $sector)
            <!-- Opciones de la lista -->
              <option value="{{$sector->id}}" >{{$sector->name}}</option> <!-- Opci�n por defecto -->

            @endforeach
             </select>
           @endIf
      </div>
       <div id='select_habitacion' name='select_habitacion'>
            {!!	Form::label('habitacion', 'Habitacion')!!}
            @if($habitaciones)
              <select name="habitacion_id">
              <!--	<option selected>Seleccione el Rol</option>validar-->
            @foreach ($habitaciones as $habitacion)
            <!-- Opciones de la lista -->
              <option value="{{$habitacion->id}}" >{{$habitacion->name}}</option> <!-- Opci�n por defecto -->

            @endforeach
             </select>
           @endIf
      </div>
       <div>
            {!!	Form::label('direccion', 'Direccion')!!}
            {!!	Form::text('direccion')!!}
      </div>
       <div>
            {!!	Form::label('email', 'EMail')!!}
            {!!	Form::text('email')!!}
      </div>
       <div>
            {!!	Form::label('provincia', 'Provincia')!!}
            {!!	Form::text('provincia')!!}
      </div>
       <div>
            {!!	Form::label('localidad', 'Localidad')!!}
            {!!	Form::text('localidad')!!}
      </div>
       <div>
            {!!	Form::label('sexo', 'Sexo')!!}
            {!!	Form::text('sexo')!!}
      </div>
       <div>
            {!!	Form::label('fecha_nac', 'Fecha Nacimiento')!!}
            {!!Form::date('fecha_nac', \Carbon\Carbon::now()) !!}
      </div>
      <div>
            {!!	Form::submit('Guardar Persona',['class' => 'btn btn-success'])!!}
            {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
      </div>
   </div>
  {!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
	$("document").ready(function(){


		$("#sectores").change(function(){
			var token = '{{csrf_token()}}';
			$.ajax({
				type:"get",
				url:	"/forms/habitaciones_disponibles/select/" + $('#sectores').val(),
				success:function(r){
					$('#select_habitacion').html(r);
				}
			});
		});
	});
</script>
@endsection
