@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('profesion.index') }}">Profesiones</a></li>
		<li class="breadcrumb-item active">Crear profesión</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    {!!Form::open(['method'=>'post','action'=>'EspecialidadController@store'])!!}
    <h1>Agregar especialidad</h1>
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
             <label>Profesión </label>
           </td>
           <td>
            <select id='profesion_id' name='profesion_id'>
              @foreach($profesiones as $profesion)
                  <option value={{$profesion->get_id()}}>{{$profesion->get_name()}}</option>
              @endforeach
            </select>
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
@section('script')
  <script type="text/javascript">
   $(document).ready(function(){
      document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
      document.getElementById("nav-administracion-especialidad").setAttribute("class", "nav-link active");
     });
  </script>
@endsection
