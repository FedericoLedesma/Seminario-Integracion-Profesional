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


    {!!Form::open(['method'=>'get','action'=>'HistorialInternacionController@storeNewAcompanante'])!!}
    <div>
       <div>
            {!!	Form::label('historial', 'ID de historial')!!}
            <td><input id="historial_id" name="historial_id" value="{{$historial}}" size=3 readonly/></td>
      </div>
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
            {!!	Form::submit('Agregar acompañante',['class' => 'btn btn-success'])!!}
            {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
      </div>
   </div>
  {!! Form::close() !!}

@endsection
