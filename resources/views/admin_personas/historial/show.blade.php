@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historiales</a></li>
		<li class="breadcrumb-item active">Ver historial</li>
@endsection
@section('titulo')
Historial de paciente
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($historial)




	    <div class="table-responsive">
        <div class="col-md-auto col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
      <tr>
				<td>Paciente </td>
				<td>{{$historial->get_paciente_name()}} {{$historial->get_apellido()}}</td>
			</tr>
			<tr>
				<td>Internación desde </td>
				<td>{{date("d/m/Y",strtotime($historial->get_fecha_ingreso()))}}</td>
			</tr>
			<tr>
				<td>Sector </td>
				<td>{{$historial->get_sector_actual_name()}}</td>
			</tr>
			<tr>
				<td>Habitación </td>
				<td>{{$historial->get_habitacion_actual_name()}}</td>
			</tr>
			<tr>
				<td>Acompañante </td>
        @if($historial->have_acompanante()==true)
				    <td>
              {{$historial->get_acompanante_name()}}
            </td>
        @else
          <td>
            <a href="{{action('HistorialInternacionController@update_add_paciente', $historial->get_id())}}" class="btn btn-primary">Agregar</a>
          </td>
        @endif
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{date("d/m/Y h:i:s", strtotime($historial->created_at))}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{date("d/m/Y h:i:s", strtotime($historial->updated_at))}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
    <div class="mb-2">
      {!!link_to_route('pacientes.historial', $title ='Historial detallado', $parameters = [$historial->get_paciente()->get_id()],['class' => 'btn btn-info'], $attributes = [])!!}

    </div>
	{!!link_to_route('historialInternacion.edit', $title = 'Cambiar de habitación', $parameters = [$historial],['class' => 'btn btn-warning mb-2'], $attributes = [])!!}
  {!!link_to_route('personas.edit', $title = 'Modificar datos de paciente', $parameters = [$historial->get_paciente_persona()],['class' => 'btn btn-warning mb-2'], $attributes = [])!!}
  {!!link_to_route('historialInternacion.alta', $title = 'ALTA', $parameters = [$historial],['class' => 'btn btn-info mb-2'], $attributes = [])!!}
  @if($historial->have_acompanante()==true)
    {!!link_to_route('personas.edit', $title = 'Modificar datos de acompañante', $parameters = [$historial->get_acompanante_persona()],['class' => 'btn btn-warning mb-2'], $attributes = [])!!}
    {!!link_to_route('historialInternacion.altaAcompanante', $title = 'Quitar acompañante', $parameters = [$historial],['class' => 'btn btn-info mb-2'], $attributes = [])!!}
  @endif
@endif
@endsection
