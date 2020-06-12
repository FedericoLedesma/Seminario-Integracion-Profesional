<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/div_table.css') }}" >
</head>

@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personas.index') }}">Personas</a></li>
		<li class="breadcrumb-item active">Detalles historial de personas</li>
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
	  	@if($persona)

	    <h2>[Historial] {{$persona->get_name()}} {{$persona->get_apellido()}}, [ID:{{$persona->get_id()}}]</h2>
  <div name="Historial">
      <button class="btn btn-info" data-toggle="collapse" data-target="#historial_actual">Internación actual</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#lista_historico">Histórico</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#lista_acompanhamiento">Acompañamiento</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#resumen_dieta">Resumen dieta</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#resumen_dieta">Dieta</button>
      <div class="collapse" id="historial_actual">
    	  <h4> Historial actual </h4>
        @if($persona->get_historial_internacion_activo()==null)
          No se haya internado
        @else
          <h3> Traslados </h3>
          <div class="divTable greyGridTable">
            <div class="divTableHeading">
              <div class="divTableRow">
                 <div class="divTableHead">
                    <label> Sector </label>
                 </div>
                 <div class="divTableHead">
                   <label> Habitación </label>
                 </div>
                 <div class="divTableHead">
                   <label> Fecha ingreso </label>
                 </div>
                 <div class="divTableHead">
                   <label> Acciones/Fecha egreso </label>
                 </div>
              </div>
            </div>
            <div class="divTableBody">
               @foreach($persona->get_historiales_paciente_cama_activos() as $pac_cama)
                   <div class="divTableRow">
                      <div class="divTableCell">
                         <label> {{$pac_cama->get_sector_name()}} </label>
                      </div>
                      <div class="divTableCell">
                        {!!link_to_route('habitaciones.historial', $title = $pac_cama->get_habitacion_name(), $parameters = [$pac_cama->get_habitacion()],['class' => 'btn btn-warning'], $attributes = [])!!}
                      </div>
                      <div class="divTableCell">
                        <label> {{$pac_cama->get_fecha_ingreso()}} </label>
                      </div>
                      <div class="divTableCell">
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


         </div>


       <h3> Acompañantes </h3>
       @if($persona->have_acompanante()==false)
        <a href="{{action('HistorialInternacionController@update_add_paciente', $persona->get_acompanantes_historial_activo_id())}}" class="btn btn-primary">Agregar</a>
       @endif
       <div class="divTable greyGridTable">
          <div class="divTableHeading">
              <div class="divTableRow">
                  <div class="divTableHead">
                     <label> Nombre </label>
                  </div>
                  <div class="divTableHead">
                    <label> Fecha ingreso </label>
                  </div>
                  <div class="divTableHead">
                    <label> Acciones/Fecha egreso </label>
                  </div>
                </div>
            </div>
            <div class="divTableBody">
                @foreach($persona->get_acompanantes_historial_activo() as $acompanante)
                  <div class="divTableRow">
                     <div class="divTableCell">
                        <label> {{$acompanante->get_name()}} {{$acompanante->get_apellido()}} </label>
                     </div>
                     <div class="divTableCell">
                       <label> {{$acompanante->get_fecha()}} </label>
                     </div>
                     <div class="divTableCell">
                       @if($acompanante->get_fecha_egreso()==null)
                         {!!link_to_route('historialInternacion.altaAcompanante', $title = 'ALTA', $parameters = [$persona->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
                       @else
                         <label> {{$acompanante->get_fecha_egreso()}} </label>
                       @endif
                     </div>
                  </div>
                @endforeach
            </div>
         </div>
       </div>
    @endif
  </div><!-- Historial actual -->


      <div id="lista_historico" class="collapse">
        <h3> Histórico </h3
        @if ($persona->get_historico_internacion()==null)
          <div>
            Nunca estuvo internado.
          </div>
        @else
          @foreach($persona->get_historico_internacion() as $historial)
            <h4>Internación {{$historial->get_fecha_ingreso()}} hasta {{$historial->get_fecha_egreso()}}
              <button class="btn btn-info" data-toggle="collapse" data-target="#historial{{$historial->get_id()}}">Mostrar</button>
            </h4>
            <div class="collapse" id="historial{{$historial->get_id()}}">
              <h2> Traslados </h2>
                <div class="divTable greyGridTable">
                  <div class="divTableHeading">
                    <div class="divTableRow">
                       <div class="divTableHead">
                          <label> Sector </label>
                       </div>
                       <div class="divTableHead">
                         <label> Habitación </label>
                       </div>
                       <div class="divTableHead">
                         <label> Fecha ingreso </label>
                       </div>
                       <div class="divTableHead">
                         <label> Acciones/Fecha egreso </label>
                       </div>
                    </div>
                  </div>
                  <div class="divTableBody">
                     @foreach($historial->get_paciente_camas() as $pac_cama)
                       <div class="divTableRow">
                          <div class="divTableCell">
                             <label> {{$pac_cama->get_sector_name()}} </label>
                          </div>
                          <div class="divTableCell">
                            {!!link_to_route('habitaciones.historial', $title = $pac_cama->get_habitacion_name(), $parameters = [$pac_cama->get_habitacion()],['class' => 'btn btn-warning'], $attributes = [])!!}
                          </div>
                          <div class="divTableCell">
                            <label> {{$pac_cama->get_fecha_ingreso()}} </label>
                          </div>
                          <div class="divTableCell">
                              <label> {{$pac_cama->get_fecha_egreso()}} </label>
                          </div>
                       </div>
                     @endforeach
                 </div>

               </div>
              <h2> Acompañantes </h2>
              <div class="divTable greyGridTable">
                <div class="divTableHeading">
                  <div class="divTableRow">
                     <div class="divTableHead">
                        <label> Nombre </label>
                     </div>
                     <div class="divTableHead">
                       <label> Fecha ingreso </label>
                     </div>
                     <div class="divTableHead">
                       <label> Acciones/Fecha egreso </label>
                     </div>
                  </div>
                </div>
                <div class="divTableBody">
                   @foreach($historial->get_acompanantes() as $acompanante)
                     <div class="divTableRow">
                        <div class="divTableCell">
                           <label> {{$acompanante->get_name()}} {{$acompanante->get_apellido()}} </label>
                        </div>
                        <div class="divTableCell">
                          <label> {{$acompanante->get_fecha()}} </label>
                        </div>
                        <div class="divTableCell">
                          @if($acompanante->get_fecha_egreso()==null)
                            {!!link_to_route('historialInternacion.altaAcompanante', $title = 'ALTA', $parameters = [$persona->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
                          @else
                            <label> {{$acompanante->get_fecha_egreso()}} </label>
                          @endif
                        </div>
                     </div>
                   @endforeach
               </div>

              </div>
            </div>
          @endforeach
        @endif
      </div><!-- Lista históricos -->

      <div id="lista_acompanhamiento" class="collapse">
        <h3>Historial de acompañamiento</h3>
        @if($persona->get_like_paciente_list()==null)
          No acompañó nunca a un paciente
        @else
        <div class="divTable greyGridTable">
          <div class="divTableHeading">
            <div class="divTableRow">
               <div class="divTableHead">
                  <label> Nombre </label>
               </div>
               <div class="divTableHead">
                 <label> Fecha ingreso </label>
               </div>
               <div class="divTableHead">
                 <label> Acciones/Fecha egreso </label>
               </div>
            </div>
          </div>
          <div class="divTableBody">
              @foreach($persona->get_like_paciente_list() as $acompanante)
                <div class="divTableRow">
                   <div class="divTableCell">
                      <label> {{$acompanante->get_name()}} {{$acompanante->get_apellido()}} </label>
                   </div>
                   <div class="divTableCell">
                     <label> {{$acompanante->get_fecha()}} </label>
                   </div>
                   <div class="divTableCell">
                     @if($acompanante->get_fecha_egreso()==null)
                       {!!link_to_route('historialInternacion.altaAcompanante', $title = 'ALTA', $parameters = [$persona->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
                     @else
                       <label> {{$acompanante->get_fecha_egreso()}} </label>
                     @endif
                   </div>
                </div>
                @endforeach
            </div>
          </div>
        @endif
     </div><!-- Histórico -->

     <div class="collapse" id="resumen_dieta">
         <h3>Resumen dieta</h3>
         @if($persona->historial_activo_generar_informe()==null)
           No hay consumiciones en su internación actual.
         @else
            <div class="divTable greyGridTable">
              <div class="divTableHeading">
                <div class="divTableRow">
                    <div class="divTableHead">
                       <label> Ración </label>
                    </div>
                    <div class="divTableHead">
                      <label> Cantidad </label>
                    </div>
                    <div class="divTableHead">
                      <label> Estado </label>
                    </div>
                    <div class="divTableHead">
                      <label> Acciones disponibles </label>
                    </div>
                </div>
              </div>
              <div class="divTableBody">
                @foreach($persona->historial_activo_generar_informe_get_renglones() as $informe)
                <div class="divTableRow">
                    <div class="divTableCell">
                       <label> {{$informe->get_racion_name()}} </label>
                    </div>
                    <div class="divTableCell">
                      <label> {{$informe->get_cantidad()}} </label>
                    </div>
                    <div class="divTableCell">
                      @if($informe->is_realizado()==true)
                        <label> Finalizado </label>
                      @else
                        <label> No finalizado </label>
                      @endif
                    </div>
                    <div class="divTableCell">
                      <label> - </label>
                    </div>
                </div><!--  Título-->
                @endforeach
              </div>
            </div>
        @endif
     </div> <!-- Resumen dieta-->

@endif
@endsection
