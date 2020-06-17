@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personas.index') }}">Personas</a></li>
		<li class="breadcrumb-item active">Crear Persona</li>
@endsection
@section('titulo')
  Agregar persona
@endsection
@section('content')
    {!!Form::open(['method'=>'post','action'=>'PersonaController@store'])!!}
     @include('layouts.error')
     <div class="col-md-8 col-md-offset-2">
     <table class="table-responsive">
        <tr>
         <td>
             {!!	Form::label('numero_doc', 'Número Doc.')!!}
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
             {!!	Form::label('direccion', 'Dirección')!!}
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
             {!!	Form::email('email')!!}
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
             {!!	Form::label('fecha_nac', 'Fecha de nacimiento')!!}
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
  </div>
		{!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
    document.getElementById("nav-personas").setAttribute("class", "nav-link active");
    document.getElementById("nav-personas-create").setAttribute("class", "nav-link active");
   });
</script>
@endsection
