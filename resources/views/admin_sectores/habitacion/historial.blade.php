<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/div_table.css') }}" >
</head>

@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('habitaciones.index') }}">Habitaciones</a></li>
		<li class="breadcrumb-item active">Ver habitación</li>
@endsection
@section('titulo')
  Historial de habitación
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($habitacion)
	    <h4>Habitación:  {{$habitacion->name}}. Sector:{{$habitacion->get_sector_name()}}</h4>
	    <h5> Pacientes actuales </h5>
      <div class="divTable greyGridTable">
        <div class="divTableHeading">
          <div class="divTableRow">
             <div class="divTableHead">
                <label> Nombre </label>
             </div>
             <div class="divTableHead">
               <label> Fecha que ingresó a habitación</label>
             </div>
             <div class="divTableHead">
               <label> Información del paciente </label>
             </div>
             <div class="divTableHead">
               <label> Acciones </label>
             </div>
         </div>
       </div>
       <div class="divTableBody">
           @foreach($pacientes as $paciente)
             <div class="divTableRow">
                <div class="divTableCell">
                  {!!link_to_route('pacientes.historial', $title = $paciente->get_name(), $parameters = [$paciente->get_id()],['class' => 'btn btn-info'], $attributes = [])!!}
                </div>
                <div class="divTableCell">
                  <label> {{date("d/m/Y", strtotime($paciente->get_habitacion_actual_fecha_ingreso()))}} </label>
                </div>
                <div class="divTableCell">
                  <button class="btn btn-info" data-toggle="collapse" data-target="#dieta{{$paciente->get_id()}}">Ver resumen dieta</button>
                </div>
                <div class="divTableCell">
                  {!!link_to_route('historialInternacion.alta', $title = 'ALTA', $parameters = [$paciente->get_historial_internacion_activo()],['class' => 'btn btn-warning'], $attributes = [])!!}
                </div>
            </div>

           @endforeach
       </div>

   </div>

    @foreach($pacientes as $paciente)
      <div id="dieta{{$paciente->get_id()}}" class="collapse">
            @if(sizeof($paciente->get_historial_menues(null))>0)
              <h4>Resumen de la dieta de {{$paciente->get_name()}} {{$paciente->get_apellido()}}</h4>
              <div class="divTable greyGridTable">
                  <div class="divTableHeading">
                    <div class="divTableRow">
                      <div class="divTableHead">
                         <label> Fecha </label>
                      </div>
                      <div class="divTableHead">
                        <label> Horario</label>
                      </div>
                      <div class="divTableHead">
                        <label> Ración</label>
                      </div>
                      <div class="divTableHead">
                        <label> Acciones </label>
                      </div>
                    </div>
                 </div>
              <div class="divTableBody">
                @foreach($paciente->get_historial_menues(null) as $menues)
                  <div class="divTableRow">
                    <div class="divTableCell">
                      <label> {{$menues->get_fecha()}} </label>
                    </div>
                    <div class="divTableCell">
                      <label> {{$menues->get_horario_name()}} </label>
                    </div>
                    <div class="divTableCell">
                      <label> {{$menues->get_racion_name()}} </label>
                    </div>
                    <div class="divTableCell">
                      <label> - </label>
                    </div>
                  </div>
                  @endforeach
              </div>
            </div>
            @else
            <h4>Resumen de la dieta de {{$paciente->get_name()}} {{$paciente->get_apellido()}}</h4>
            <div class="divTableRow">
              <label>No ha consumido nada en los últimos 30 días</label>
            </div>
            @endif
       </div>
     @endforeach

     <h4> Histórico </h4>
     <div class="divTable greyGridTable">
       <div class="divTableHeading">
         <div class="divTableRow">
            <div class="divTableHead">
               <label> Nombre </label>
            </div>
            <div class="divTableHead">
              <label> Fecha de ingreso </label>
            </div>
            <div class="divTableHead">
              <label> Fecha de egreso </label>
            </div>
            <div class="divTableHead">
              <label> Dieta </label>
            </div>
          </div>
      </div>
      <div class="divTableBody">
          @foreach($habitacion->get_historico_camas_paciente() as $pac_cama)
            <div class="divTableRow">
               <div class="divTableCell">
                  {!!link_to_route('pacientes.historial', $title = $pac_cama->get_name(), $parameters = [$pac_cama->get_paciente_id()],['class' => 'btn btn-info'], $attributes = [])!!}
               </div>
               <div class="divTableCell">
                 <label> {{$pac_cama->get_fecha_ingreso()}} </label>
               </div>
               <div class="divTableCell">
                  <label> {{$pac_cama->get_fecha_egreso()}} </label>
               </div>
               <div class="divTableCell">
                 <button class="btn btn-info" data-toggle="collapse" data-target="#historico_dieta{{$pac_cama->get_paciente()->get_id()}}">Ver resumen dieta</button>
               </div>
           </div>

          @endforeach
      </div>
    </div>
    @foreach($habitacion->get_historico_camas_paciente() as $pac_cama)
      <div id="historico_dieta{{$pac_cama->get_paciente()->get_id()}}" class="collapse">
        @if(sizeof($pac_cama->get_paciente()->get_historial_menues(null))>0)
            <h4>Resumen de la dieta de {{$pac_cama->get_paciente()->get_name()}} {{$pac_cama->get_paciente()->get_apellido()}}</h4>
            <div class="divTable greyGridTable">
                <div class="divTableHeading">
                  <div class="divTableRow">
                     <div class="divTableHead">
                        <label> Fecha </label>
                     </div>
                     <div class="divTableHead">
                       <label> Horario</label>
                     </div>
                     <div class="divTableHead">
                       <label> Ración</label>
                     </div>
                     <div class="divTableHead">
                       <label> Acciones </label>
                     </div>
                  </div>
               </div>
              <div class="divTableBody">
                @foreach($pac_cama->get_paciente()->get_historial_menues(null) as $menues)
                  <div class="divTableRow">
                    <div class="divTableCell">
                      <label> {{$menues->get_fecha()}} </label>
                    </div>
                    <div class="divTableCell">
                      <label> {{$menues->get_horario_name()}} </label>
                    </div>
                    <div class="divTableCell">
                      <label> {{$menues->get_racion_name()}} </label>
                    </div>
                    <div class="divTableCell">
                      <label> - </label>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
        @else
        <div class="divTableRow">
          <label>No ha consumido nada en los últimos 30 días</label>
        </div>
        @endif
      </div>
    @endforeach


@endif
@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
    document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
    document.getElementById("nav-administracion-habitaciones").setAttribute("class", "nav-link active");
   });
</script>
@endsection
