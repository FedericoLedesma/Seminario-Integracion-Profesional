<head>
  <script
          src="https://code.jquery.com/jquery-3.5.1.js"
          integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
          crossorigin="anonymous">
  </script>
</head>


@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personal.index') }}">Personal</a></li>
		<li class="breadcrumb-item active">Traslado de personal</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($personal, ['route' => ['personal.update', $personal->get_id()], 'method'=> 'PUT'])!!}
	 	@if($personal)
	    <h1>Trasladar de sector a {{$personal->get_name()}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
          <div>
               {!!	Form::label('sector_id', 'Sector')!!}
               @if($sectores)
                 <select name="sectores" id='sectores'>
                 <!--	<option selected>Seleccione el Rol</option>validar-->
               @foreach ($sectores as $sector)
               <!-- Opciones de la lista -->
                 <option value="{{$sector->id}}" >{{$sector->name}}</option> <!-- Opci�n por defecto -->

               @endforeach
                </select>
              @endIf
          </div>
		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		    </td>
		    <td>
		   	{!!link_to_route('historialInternacion.show', $title = 'CANCELAR', $parameters = [$personal], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif
@endsection
