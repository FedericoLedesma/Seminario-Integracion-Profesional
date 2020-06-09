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

	    <h2>[Historial] Paciente:  {{$paciente->get_name()}}, [ID:{{$paciente->get_id()}}]</h2>
  <div name="Historial">
      <button class="btn btn-info" data-toggle="collapse" data-target="#historial_actual">Internación actual</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#lista_historico">Histórico</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#lista_acompanhamiento">Acompañamiento</button>
      <div class="collapse" id="historial_actual">
    	  <h4> Historial actual </h4>
        @if($paciente->get_historial_internacion_activo()==null)
          No se haya internado
        @else
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
                  {!!link_to_route('habitaciones.historial', $title = $pac_cama->get_habitacion_name(), $parameters = [$pac_cama->get_habitacion()],['class' => 'btn btn-warning'], $attributes = [])!!}
                </div>
                <div class="col-md-3">
                  <label> {{$pac_cama->get_fecha_ingreso()}} </label>
                </div>
                <div class="col-md-3">
                  @if($pac_cama->get_fecha_egreso()==null)
                    {!!link_to_route('historialInternacion.edit', $title = 'Traslado', $parameters = [$pac_cama->get_paciente()->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
                    {!!link_to_route('historialInternacion.alta', $title = 'ALTA', $parameters = [$pac_cama->get_paciente()->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
                  @else
                    <label> {{$pac_cama->get_fecha_egreso()}} </label>
                  @endif
                </div>
             </div>
           @endforeach


         </div>


       <h3> Acompañantes </h3>
       @if($paciente->have_acompanante()==false)
        <a href="{{action('HistorialInternacionController@update_add_paciente', $paciente->get_acompanantes_historial_activo_id())}}" class="btn btn-primary">Agregar</a>
       @endif
       <div class="container">
          <div class="row">
              <div class="col-md-3">
                 <label> Nombre </label>
              </div>
              <div class="col-md-3">
                <label> Fecha ingreso </label>
              </div>
              <div class="col-md-3">
                <label> Acciones/Fecha egreso </label>
              </div>
            </div>
            @foreach($paciente->get_acompanantes_historial_activo() as $acompanante)
              <div class="row">
                 <div class="col-md-3">
                    <label> {{$acompanante->get_name()}} {{$acompanante->get_apellido()}} </label>
                 </div>
                 <div class="col-md-3">
                   <label> {{$acompanante->get_fecha()}} </label>
                 </div>
                 <div class="col-md-3">
                   @if($acompanante->get_fecha_egreso()==null)
                     {!!link_to_route('historialInternacion.altaAcompanante', $title = 'ALTA', $parameters = [$paciente->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
                   @else
                     <label> {{$acompanante->get_fecha_egreso()}} </label>
                   @endif
                 </div>
              </div>
            @endforeach

         </div>
      @endif
    </div><!-- Historial actual -->


      <div id="lista_historico" class="collapse">
        <h3> Histórico </h3>
        @foreach($paciente->get_historico_internacion() as $historial)
          <h4>Internación {{$historial->get_fecha_ingreso()}} hasta {{$historial->get_fecha_egreso()}}
            <button class="btn btn-info" data-toggle="collapse" data-target="#historial{{$historial->get_id()}}">Mostrar</button>
          </h4>
          <div class="collapse" id="historial{{$historial->get_id()}}">
            <h2> Traslados </h2>
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
               @foreach($historial->get_paciente_camas() as $pac_cama)
                 <div class="row">
                    <div class="col-md-3">
                       <label> {{$pac_cama->get_sector_name()}} </label>
                    </div>
                    <div class="col-md-3">
                      {!!link_to_route('habitaciones.historial', $title = $pac_cama->get_habitacion_name(), $parameters = [$pac_cama->get_habitacion()],['class' => 'btn btn-warning'], $attributes = [])!!}
                    </div>
                    <div class="col-md-3">
                      <label> {{$pac_cama->get_fecha_ingreso()}} </label>
                    </div>
                    <div class="col-md-3">
                        <label> {{$pac_cama->get_fecha_egreso()}} </label>
                    </div>
                 </div>
               @endforeach


             </div>
            <h2> Acompañantes </h2>
            <div class="container">
              <div class="row">
                 <div class="col-md-3">
                    <label> Nombre </label>
                 </div>
                 <div class="col-md-3">
                   <label> Fecha ingreso </label>
                 </div>
                 <div class="col-md-3">
                   <label> Acciones/Fecha egreso </label>
                 </div>
              </div>
             @foreach($historial->get_acompanantes() as $acompanante)
               <div class="row">
                  <div class="col-md-3">
                     <label> {{$acompanante->get_name()}} {{$acompanante->get_apellido()}} </label>
                  </div>
                  <div class="col-md-3">
                    <label> {{$acompanante->get_fecha()}} </label>
                  </div>
                  <div class="col-md-3">
                    @if($acompanante->get_fecha_egreso()==null)
                      {!!link_to_route('historialInternacion.altaAcompanante', $title = 'ALTA', $parameters = [$paciente->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
                    @else
                      <label> {{$acompanante->get_fecha_egreso()}} </label>
                    @endif
                  </div>
               </div>
             @endforeach


            </div>
          </div>
        @endforeach
      </div><!-- Lista históricos -->

      <div id="lista_acompanhamiento" class="collapse">
        <h3>Historial de acompañamiento</h3>
        @if($paciente->get_like_paciente_list()==null)
          No acompañó nunca a un paciente
        @else
          @foreach($paciente->get_like_paciente_list() as $acompanante)
          <div class="row">
             <div class="col-md-3">
                <label> {{$acompanante->get_name()}} {{$acompanante->get_apellido()}} </label>
             </div>
             <div class="col-md-3">
               <label> {{$acompanante->get_fecha()}} </label>
             </div>
             <div class="col-md-3">
               @if($acompanante->get_fecha_egreso()==null)
                 {!!link_to_route('historialInternacion.altaAcompanante', $title = 'ALTA', $parameters = [$paciente->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
               @else
                 <label> {{$acompanante->get_fecha_egreso()}} </label>
               @endif
             </div>
          </div>
          @endforeach
        @endif
      </div>
     </div><!-- Histórico -->

@endif
@endsection