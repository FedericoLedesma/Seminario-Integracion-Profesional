<head>
  <script
          src="https://code.jquery.com/jquery-3.5.1.js"
          integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
          crossorigin="anonymous">
  </script>
</head>


@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historiales</a></li>
		<li class="breadcrumb-item active">Traslado de paciente</li>
@endsection
@section('titulo')
  Trasladar de habitación
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($historial, ['route' => ['historialInternacion.update', $historial->get_id()], 'method'=> 'PUT'])!!}
	 	@if($historial)
	    <h4> Paciente {{$historial->get_paciente_name()}}</h4>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-6 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
          <tr>
            <td>
               {!!	Form::label('sector_id', 'Sector')!!}
            </td>
            <td>
               @if($sectores)
                 <select name="sectores" id='sectores'>
                 <!--	<option selected>Seleccione el Rol</option>validar-->
               @foreach ($sectores as $sector)
               <!-- Opciones de la lista -->
                 <option value="{{$sector->id}}" >{{$sector->name}}</option> <!-- Opci�n por defecto -->

               @endforeach
                </select>
              @endIf
            </td>
          </tr>

          <tr>
            <td>
               {!!	Form::label('habitacion', 'Habitación')!!}
            </td>
            <td id='select_habitacion' name='select_habitacion'>
               @if($habitaciones)
                 <select name="habitacion_id">
                   <!--	<option selected>Seleccione el Rol</option>validar-->
                   @foreach ($habitaciones as $habitacion)
                   <!-- Opciones de la lista -->
                     <option value={{$habitacion->get_id()}} > {{$habitacion->get_name()}}</option> <!-- Opci�n por defecto -->

                   @endforeach
                </select>
              @endIf
            </td>
          </tr>
		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		    </td>
		    <td>
		   	{!!link_to_route('historialInternacion.show', $title = 'CANCELAR', $parameters = [$historial], $attributes = ['class'=>'btn btn-primary'])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif
@endsection
@section('script')
<script type="text/javascript">
	$("document").ready(function(){


		$("#sectores").change(function(){
			var token = '{{csrf_token()}}';
			$.ajax({
				type:"get",
				url:	"/forms/habitaciones_disponibles/select/" + $('#sectores').val(),
				success:function(r){
					$('#select_habitacion').html(r);
				}
			});
		});
	});
</script>
@endsection
