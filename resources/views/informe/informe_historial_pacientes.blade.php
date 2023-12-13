@extends('layouts.layout_pdf')
@section('content')


<div>
  <h1>Informe</h1>
  <h2>Raciones consumidas por la persona {{$persona->get_apellido()}} {{$persona->get_name()}} </h2>
  <h3>Solicitado : {{$creado}} </h3>
  <p>Usuario que solicitó el informe: {{$user->personal->persona->apellido}}  {{$user->personal->persona->name}} </p>
  <p>Número de documento {{$user->personal->persona->numero_doc}} - ID: {{$user->personal->persona->id}}</p>
  <p>
    Filtro : {{$busqueda_por}} {{$query}} <br>
  </p> 
  <div class="container">
    <div class="table-responsive">
      <div class="col-md-11 col-md-offset-2">
        <div class="panel-heading">
          <div class="divTable blueTable">
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead">Horario</div>
                <div class="divTableHead">Ración</div>
                <div class="divTableHead">Fecha</div>
              </div>
            </div>
            <div class="divTableBody">
              @if($menus)
              @foreach($menus as $menu_persona)
              <div class="divTableRow">
                {{Log::debug(' Persona id: '.$menu_persona)}}
                <div class="divTableCell">{{$menu_persona->get_horario_name()}}</div>
                <div class="divTableCell">{{$menu_persona->get_racion_name()}}</div>
                <div class="divTableCell">{{$menu_persona->get_fecha()}}</div>
              </div>
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection