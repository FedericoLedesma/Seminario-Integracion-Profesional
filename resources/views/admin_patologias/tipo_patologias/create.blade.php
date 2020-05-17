@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('tipospatologias.index') }}">Tipos de Patologias</a></li>
		<li class="breadcrumb-item active">Crear Tipo Patologia</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    {!!Form::open(['method'=>'post','action'=>'TipoPatologiaController@store'])!!}
    <h1>Agregar Tipo de Patologia</h1>
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
             {!!	Form::label('observacion', 'Observacion')!!}
         </td>
         <td>
             {!!	Form::text('observacion')!!}
         </td>
       </tr>
       <tr>
         <td>
             {!!	Form::submit('Guardar',['class' => 'btn btn-success'])!!}
         </td>
         <td>
             {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
         </td>
       </tr>
    </table>
		{!! Form::close() !!}

@endsection
