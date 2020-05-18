@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('sectores.index') }}">Sectores</a></li>
		<li class="breadcrumb-item active">Crear Sector</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    {!!Form::open(['method'=>'post','action'=>'SectorController@store'])!!}
    <h1>Agregar Sector</h1>
     @include('layouts.error')
     <table>
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
             {!!	Form::submit('Guardar Sector',['class' => 'btn btn-success'])!!}
         </td>
         <td>
             {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
         </td>
       </tr>
    </table>
		{!! Form::close() !!}

@endsection
