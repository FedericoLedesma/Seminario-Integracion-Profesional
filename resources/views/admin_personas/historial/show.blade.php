@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historiales</a></li>
		<li class="breadcrumb-item active">Ver historial</li>
@endsection
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
<style>
<!--
	.table-resposive{
		float:left;
	}

-->
</style>
	   @include('layouts.error')
	  	@if($historial)




	    <div class="table-responsive">
	    <h2>Historial de {{$historial->get_paciente_name()}} desde {{$historial->get_fecha_ingreso()}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID Historial </td>
				<td>{{$historial->get_id()}}</td>
			</tr>
			<tr>
				<td>Paciente </td>
				<td>{{$historial->get_paciente_name()}} {{$historial->get_apellido()}}</td>
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
            <a href="{{action('HistorialInternacionController@update_add_paciente', $historial->get_id())}}" class="btn btn-primary">Agregar uno</a>
          </td>
        @endif
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$historial->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$historial->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('historialInternacion.edit', $title = 'MODIFICAR', $parameters = [$historial],['class' => 'btn btn-warning'], $attributes = [])!!}
  {!!link_to_route('historialInternacion.alta', $title = 'ALTA', $parameters = [$historial],['class' => 'btn btn-info'], $attributes = [])!!}
  @if($historial->have_acompanante()==true)
    {!!link_to_route('historialInternacion.altaAcompanante', $title = 'Quitar acompañante', $parameters = [$historial],['class' => 'btn btn-info'], $attributes = [])!!}
  @endif
@endif
@endsection
