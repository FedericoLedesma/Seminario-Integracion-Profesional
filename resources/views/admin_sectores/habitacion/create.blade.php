@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('habitaciones.index') }}">Habitaciones</a></li>
		<li class="breadcrumb-item active">Crear habitación</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    {!!Form::open(['method'=>'post','action'=>'HabitacionController@store'])!!}
    <h1>Agregar habitación</h1>
     @include('layouts.error')
     <table>
       <tr>
         <td>
             {!!	Form::label('sector_id', 'Sector')!!}
         </td>
         <td>
             <select class="browser-default custom-select" id='sector_id' name='sector_id'>
                @foreach($sectores as $sector)
                    <option value= {{$sector->get_id()}}> {{$sector->get_name()}}</option>
                @endforeach
             </select>
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
             {!!	Form::submit('Guardar Sector',['class' => 'btn btn-success'])!!}
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
    document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
    document.getElementById("nav-administracion-habitaciones").setAttribute("class", "nav-link active");
   });
</script>
@endsection
