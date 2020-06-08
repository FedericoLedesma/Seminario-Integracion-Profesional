@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('profesion.index') }}">Profesiones</a></li>
		<li class="breadcrumb-item active">Crear profesión</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    {!!Form::open(['method'=>'post','action'=>'ProfesionController@store'])!!}
    <h1>Agregar profesión</h1>
     @include('layouts.error')
     <table>
       <tr>
         <td>
             {!!	Form::label('name', 'Nombre')!!}
         </td>
         <td>
             <input id="name" name="name" type="text" required></input>
         </td>
       </tr>
       <tr>
         <td>
             {!!	Form::submit('Guardar profesión',['class' => 'btn btn-success'])!!}
         </td>
         <td>
             {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
         </td>
       </tr>
    </table>
		{!! Form::close() !!}

@endsection
