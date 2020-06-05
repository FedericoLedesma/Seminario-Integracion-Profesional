@extends('layouts.layout_informe')
@section('content')
<h1>Informe de Menus</h1>

    <div>
      <h2>Creado : {{$creado}} </h2>
      <p>Solicitado por el usuario : Apellido: {{$user->personal->persona->apellido}} Nombre: {{$user->personal->persona->name}} </p>
      <p>Numero de documento {{$user->personal->persona->numero_doc}} ID: {{$user->personal->persona->id}}</p>
      <p>
        Menus por : {{$busqueda_por}}  {{$query}} <br>
        Cantidad encontrada= {{$menus_total}}

      </p>
        <table>
          <thead >
            <tr>
              <th scope="col">Persona</th>
              <th scope="col">Sector </th>
              <th scope="col">Habitacion</th>
              <th scope="col">Cama</th>
              <th scope="col">Horario</th>
              <th scope="col">Racion</th>
              <th scope="col">Fecha</th>
              <th scope="col">Realizado</th>              

            </tr>
          </thead>

          <tbody>
          @if($menus)
            @foreach($menus as $menu_persona)
            <tr>
              {{Log::debug(' Persona id: '.$menu_persona)}}
              <td>{{$menu_persona->get_persona_nombre_completo()}}</td>
              <td>{{$menu_persona->persona->sectorFecha($menu_persona->racionDisponible->fecha)->name}}</td>
              <td>{{$menu_persona->persona->habitacionFecha($menu_persona->racionDisponible->fecha)->name}}</td>
              <td>{{$menu_persona->persona->camaFecha($menu_persona->racionDisponible->fecha)->id}}</td>
              <td>{{$menu_persona->get_horario_name()}}</td>
              <td>{{$menu_persona->get_racion_name()}}</td>
              <td>{{$menu_persona->racionDisponible->fecha}}</td>
              <td>{{$menu_persona->isRealizado_str()}}</td>
            </tr>
            @endforeach
          @endif
        </table>
    </div>


@endsection
