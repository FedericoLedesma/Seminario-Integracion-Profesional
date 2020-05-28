@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('camas.index') }}">Camas</a></li>
		<li class="breadcrumb-item active">Crear cama</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    {!!Form::open(['method'=>'post','action'=>'CamaController@store'])!!}
    <h1>Agregar cama</h1>
     @include('layouts.error')
     <table>
       <tr>
         <td>
             {!!	Form::label('habitacion_id', 'Habitación')!!}
         </td>
         <td>
             <select class="browser-default custom-select" id='habitacion_id' name='habitacion_id'>
                @foreach($habitaciones as $habitacion)
                    <option value= {{$habitacion->get_id()}}>-{{$habitacion->get_sector_name()}}- {{$habitacion->get_name()}}</option>
                @endforeach
             </select>
         </td>
       </tr>
       <tr>
         <td>
             {!!	Form::submit('Guardar cama',['class' => 'btn btn-success'])!!}
         </td>
         <td>
             {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
         </td>
       </tr>
    </table>
		{!! Form::close() !!}

@endsection
