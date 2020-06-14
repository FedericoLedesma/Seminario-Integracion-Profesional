@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Patologias</a></li>
		<li class="breadcrumb-item active">Crear Patologia</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    {!!Form::open(['method'=>'post','action'=>'PatologiaController@store'])!!}
    <h1>Agregar Patologia</h1>
     @include('layouts.error')
     <table>
        <tr>
         <td>
             {!!	Form::label('tipo_patologia_id', 'Tipo de Patologia')!!}
         </td>
         <td>
             @if($tipos_patologias)
               <select class="browser-default custom-select" name="tipo_patologia_id">
               <!--	<option selected>Seleccione el Rol</option>validar-->
             @foreach ($tipos_patologias as $tipo_patologia)
             <!-- Opciones de la lista -->
               <option value="{{$tipo_patologia->id}}" >{{$tipo_patologia->name}}</option> <!-- Opci�n por defecto -->

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
             {!!	Form::label('descripcion', 'Descripcion')!!}
         </td>
         <td>
             {!!	Form::text('descripcion')!!}
         </td>
       </tr>
       <tr>
         <td>
             {!!	Form::submit('Guardar Patologia',['class' => 'btn btn-success'])!!}
         </td>
         <td>
             {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
         </td>
       </tr>
    </table>
		{!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		 document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
		 document.getElementById("nav-patologias-create").setAttribute("class", "nav-link active");
		});
</script>
@endsection
