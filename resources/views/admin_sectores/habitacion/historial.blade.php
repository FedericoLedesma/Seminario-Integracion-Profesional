@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('habitaciones.index') }}">Habitaciones</a></li>
		<li class="breadcrumb-item active">Ver habicación</li>
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
	  	@if($habitacion)
	    <div class="table-responsive">
	    <h2>[Sector {{$habitacion->get_sector_name()}}] Habitacion:  {{$habitacion->name}}</h2>
	    <h4> Pacientes actuales </h4>
      <div class="container">
        <div class="row">
           <div class="col-md-3">
              <label> Nombre </label>
           </div>
           <div class="col-md-3">
             <label> Fecha ingreso </label>
           </div>
           <div class="col-md-3">
             <label> Dieta </label>
           </div>
           <div class="col-md-3">
             <label> Acciones </label>
           </div>
       </div>
       @foreach($pacientes as $paciente)
         <div class="row justify-content-md-center">
            <div class="col col-lg-3">
              {!!link_to_route('pacientes.historial', $title = $paciente->get_name(), $parameters = [$paciente->get_id()],['class' => 'btn btn-info'], $attributes = [])!!}
            </div>
            <div class="col-sm">
              <label> {{$paciente->get_habitacion_actual_fecha_ingreso()}} </label>
            </div>
            <div class="col-sm">
              <button class="btn btn-info" data-toggle="collapse" data-target="#dieta{{$paciente->get_id()}}">Ver dieta</button>
            </div>
            <div class="col-sm">
              {!!link_to_route('historialInternacion.alta', $title = 'ALTA', $parameters = [$paciente->get_historial_internacion_reciente()],['class' => 'btn btn-warning'], $attributes = [])!!}
            </div>
        </div>
        <div id="dieta{{$paciente->get_id()}}" class="collapse">
          @if(sizeof($paciente->get_historial_menues(null))>0)
            @foreach($paciente->get_historial_menues(null) as $menues)
              <div class="row">
                <div class="col-sm">
                  <label> {{$menues->get_fecha()}} </label>
                </div>
                <div class="col-sm">
                  <label> {{$menues->get_horario_name()}} </label>
                </div>
                <div class="col-sm">
                  <label> {{$menues->get_racion_name()}} </label>
                </div>
              </div>
            @endforeach
          @else
          <div class="row">
            <label>No ha consumido nada en los últimos 30 días</label>
          </div>
          @endif
        </div>
       @endforeach

     </div>
     <h4> Histórico </h4>
     <div class="container">
       <div class="row">
          <div class="col-md-3">
             <label> Nombre </label>
          </div>
          <div class="col-md-3">
            <label> Fecha ingreso </label>
          </div>
          <div class="col-md-3">
            <label> Fecha egreso </label>
          </div>
          <div class="col-md-3">
            <label> Dieta </label>
          </div>
      </div>
      @foreach($habitacion->get_historico_camas_paciente() as $pac_cama)
        <div class="row justify-content-md-center">
           <div class="col col-lg-3">
              <label> {{$pac_cama->get_name()}}</label>
           </div>
           <div class="col-sm">
             <label> {{$pac_cama->get_fecha_ingreso()}} </label>
           </div>
           <div class="col-sm">
              <label> {{$pac_cama->get_fecha_egreso()}} </label>
           </div>
           <div class="col-sm">
             <button class="btn btn-info" data-toggle="collapse" data-target="#dieta{{$pac_cama->get_paciente()->get_id()}}">Ver dieta</button>
           </div>
       </div>
       <div id="dieta{{$pac_cama->get_paciente()->get_id()}}" class="collapse">
         @if(sizeof($pac_cama->get_paciente()->get_historial_menues(null))>0)
           @foreach($pac_cama->get_paciente()->get_historial_menues(null) as $menues)
             <div class="row">
               <div class="col-sm">
                 <label> {{$menues->get_fecha()}} </label>
               </div>
               <div class="col-sm">
                 <label> {{$menues->get_horario_name()}} </label>
               </div>
               <div class="col-sm">
                 <label> {{$menues->get_racion_name()}} </label>
               </div>
             </div>
           @endforeach
         @else
         <div class="row">
           <label>No ha consumido nada en los últimos 30 días</label>
         </div>
         @endif
       </div>
      @endforeach

    </div>


@endif
@endsection
