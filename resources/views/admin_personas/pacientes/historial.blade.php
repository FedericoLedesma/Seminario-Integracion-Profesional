@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historiales de pacientes</a></li>
		<li class="breadcrumb-item active">Detalles historial de paciente</li>
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
	  	@if($paciente)
	    <div class="table-responsive">
	    <h2>[Historial] Paciente:  {{$paciente->get_name()}}</h2>
	    <h4> Historial actual </h4>
      <h3> Traslados </h3>
      <div class="container">
        <div class="row">
           <div class="col-md-3">
              <label> Sector </label>
           </div>
           <div class="col-md-3">
             <label> Habitación </label>
           </div>
           <div class="col-md-3">
             <label> Fecha ingreso </label>
           </div>
           <div class="col-md-3">
             <label> Acciones/Fecha egreso </label>
           </div>
        </div>
       @foreach($paciente->get_historiales_paciente_cama_activos() as $pac_cama)
         <div class="row">
            <div class="col-md-3">
               <label> {{$pac_cama->get_sector_name()}} </label>
            </div>
            <div class="col-md-3">
              <label> {{$pac_cama->get_habitacion_name()}} </label>
            </div>
            <div class="col-md-3">
              <label> {{$pac_cama->get_fecha_ingreso()}} </label>
            </div>
            <div class="col-md-3">
              @if($pac_cama->get_fecha_egreso()==null)
                {!!link_to_route('historialInternacion.edit', $title = 'Traslado', $parameters = [$pac_cama->get_paciente()->get_historial_internacion_reciente()],['class' => 'btn btn-warning'], $attributes = [])!!}
                {!!link_to_route('historialInternacion.alta', $title = 'ALTA', $parameters = [$pac_cama->get_paciente()->get_historial_internacion_reciente()],['class' => 'btn btn-warning'], $attributes = [])!!}
              @else
                <label> {{$pac_cama->get_fecha_egreso()}} </label>
              @endif
            </div>
         </div>
       @endforeach


     </div>



@endif
@endsection
