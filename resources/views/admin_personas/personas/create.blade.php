@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personas.index') }}">PErsonas</a></li>
		<li class="breadcrumb-item active">Crear Persona</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    {!!Form::open(['method'=>'post','action'=>'PersonaController@store'])!!}
    <h1>Agregar Persona</h1>
     @include('layouts.error')
     <table>
        <tr>
         <td>
             {!!	Form::label('numero_doc', 'Numero Doc.')!!}
         </td>
         <td>
             {!!	Form::text('numero_doc')!!}
         </td>
       </tr>
        <tr>
         <td>
             {!!	Form::label('tipo_documento_id', 'Tipo de Documento')!!}
         </td>
         <td>
             @if($tipos_documentos)
               <select class="browser-default custom-select" name="tipo_documento_id">
               <!--	<option selected>Seleccione el Rol</option>validar-->
             @foreach ($tipos_documentos as $tipos_documento)
             <!-- Opciones de la lista -->
               <option value="{{$tipos_documento->id}}" >{{$tipos_documento->name}}</option> <!-- Opci�n por defecto -->

             @endforeach
              </select>
            @endIf
         </td>
       </tr>
       <tr>
         <td>
             {!!	Form::label('name', 'Nombre')!!}
         </td>
         <td>
             {!!	Form::text('name')!!}
         </td>
       </tr>
        <tr>
         <td>
             {!!	Form::label('apellido', 'Apellido')!!}
         </td>
         <td>
             {!!	Form::text('apellido')!!}
         </td>
       </tr>
        <tr>
         <td>
             {!!	Form::label('direccion', 'Direccion')!!}
         </td>
         <td>
             {!!	Form::text('direccion')!!}
         </td>
       </tr>
        <tr>
         <td>
             {!!	Form::label('email', 'EMail')!!}
         </td>
         <td>
             {!!	Form::text('email')!!}
         </td>
       </tr>
        <tr>
         <td>
             {!!	Form::label('provincia', 'Provincia')!!}
         </td>
         <td>
             {!!	Form::text('provincia')!!}
         </td>
       </tr>
        <tr>
         <td>
             {!!	Form::label('localidad', 'Localidad')!!}
         </td>
         <td>
             {!!	Form::text('localidad')!!}
         </td>
       </tr>
        <tr>
         <td>
             {!!	Form::label('sexo', 'Sexo')!!}
         </td>
         <td>
             {!!	Form::text('sexo')!!}
         </td>
       </tr>
        <tr>
         <td>
             {!!	Form::label('fecha_nac', 'Fecha Nacimiento')!!}
         </td>
         <td>
            {!!Form::date('fecha_nac', \Carbon\Carbon::now()) !!}
         </td>
       </tr>
       <tr>
         <td>
             {!!	Form::submit('Guardar Persona',['class' => 'btn btn-success'])!!}
         </td>
         <td>
             {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
         </td>
       </tr>
    </table>
		{!! Form::close() !!}

@endsection
