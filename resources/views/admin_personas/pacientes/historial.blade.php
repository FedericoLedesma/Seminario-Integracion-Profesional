<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/div_table.css') }}" >
</head>

@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historiales de pacientes</a></li>
		<li class="breadcrumb-item active">Detalles historial de paciente</li>
@endsection
@section('content')


	   @include('layouts.error')
	  	@if($paciente)

	    <h2>[Historial] Paciente:  {{$paciente->get_name()}}, [ID:{{$paciente->get_id()}}]</h2>
  <div name="Historial">
      <button class="btn btn-info" data-toggle="collapse" data-target="#historial_actual">Internación actual</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#lista_historico">Histórico</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#lista_acompanhamiento">Acompañamiento</button>
      <button class="btn btn-info" data-toggle="collapse" data-target="#resumen_dieta">Resumen dieta</button>
      {!!Form::open(['route'=>'pacientes.historial.raciones','method'=>'POST','target'=>"_blank"]) !!}
      <table>
      	<thead>
      		<tr>
      			<td>
      					{!!	Form::label('fecha', 'Fecha Desde')!!}
      			</td>
      			<td>
      					{!!	Form::label('fecha_hasta', 'Fecha Hasta')!!}
      			</td>
      			<td>
      					{!!	Form::label('horario', 'Horario')!!}
      			</td>
      		</tr>
      	</thead>
      	<tbody>
      		<tr>
      			<td>
      					{!!Form::date('fecha_desde', \Carbon\Carbon::now(),['id'=>'fecha_desde']);!!}
      			</td>
      			<td>
      					{!!Form::date('fecha_hasta_', \Carbon\Carbon::now(),['id'=>'fecha_hasta_']);!!}
      			</td>
      			<td>
      			 <select class="browser-default custom-select" id="busqueda_horario_por" name="busqueda_horario_por">
      				 <option value="0" >Todos</option>
      				 @if($horarios)
      					 @foreach($horarios as $horario)
      						 <option value="{{$horario->id}}" >{{$horario->name}}</option>
      					 @endforeach
      				 @endif
      			 </select>
      			</td>
            <td>
              <div class='collapse'>
                <input id='persona_id' name='persona_id' value={{$paciente->get_id()}}></input>
              </div>
              	{!!	Form::submit('Buscar',['class'=>'btn btn-success'])!!}

            </td>
      		</tr>
      	</tbody>
      </table>
      <div class="collapse" id="historial_actual">
    	  <h4> Historial actual </h4>
        @if($paciente->get_historial_internacion_activo()==null)
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
               @foreach($paciente->get_historiales_paciente_cama_activos() as $pac_cama)
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
       @if($paciente->have_acompanante()==false)
        <a href="{{action('HistorialInternacionController@update_add_paciente', $paciente->get_acompanantes_historial_activo_id())}}" class="btn btn-primary">Agregar</a>
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
                @foreach($paciente->get_acompanantes_historial_activo() as $acompanante)
                  <div class="divTableRow">
                     <div class="divTableCell">
                        <label> {{$acompanante->get_name()}} {{$acompanante->get_apellido()}} </label>
                     </div>
                     <div class="divTableCell">
                       <label> {{$acompanante->get_fecha()}} </label>
                     </div>
                     <div class="divTableCell">
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
                          {!!link_to_route('historialInternacion.altaAcompanante', $title = 'ALTA', $parameters = [$paciente->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
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
      </div><!-- Lista históricos -->

      <div id="lista_acompanhamiento" class="collapse">
        <h3>Historial de acompañamiento</h3>
        @if($paciente->get_like_paciente_list()==null)
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
              @foreach($paciente->get_like_paciente_list() as $acompanante)
                <div class="divTableRow">
                   <div class="divTableCell">
                      <label> {{$acompanante->get_name()}} {{$acompanante->get_apellido()}} </label>
                   </div>
                   <div class="divTableCell">
                     <label> {{$acompanante->get_fecha()}} </label>
                   </div>
                   <div class="divTableCell">
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
        @endif
     </div><!-- Histórico -->

     <div class="collapse" id="resumen_dieta">
         @if($paciente->historial_activo_generar_informe()==null)
           No hay consumiciones en su internación actual.
         @else
            <h3>Resumen dieta</h3>
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
                @foreach($paciente->historial_activo_generar_informe_get_renglones() as $informe)
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
