@extends('layouts.layout_pdf')
@section('content')


    <div><h1>Informe de Menús</h1>
      <h2>Solicitado : {{$creado}} </h2>
      <p>Por el usuario : Apellido: {{$user->personal->persona->apellido}} Nombre: {{$user->personal->persona->name}} </p>
      <p>Numero de documento {{$user->personal->persona->numero_doc}} - ID: {{$user->personal->persona->id}}</p>
      <p>
        Menus por : {{$busqueda_por}}  {{$query}} <br>
        Cantidad encontrada= {{$menus_total}}

      </p>
        <table>
          <thead >
            <tr>
              <th scope="col">Persona</th>
              <th scope="col">Sector </th>
              <th scope="col">Habitación</th>
              <th scope="col">Cama</th>
              <th scope="col">Horario</th>
              <th scope="col">Ración</th>
              <th scope="col">Fecha</th>
              <th scope="col">Entregado</th>

            </tr>
          </thead>

          <tbody>
          @if($menus)
            @foreach($menus as $menu_persona)
            <tr>
              {{Log::debug(' Persona id: '.$menu_persona)}}
              <td>{{$menu_persona->get_persona_nombre_completo()}}</td>
              @if($menu_persona->persona->sectorFecha($menu_persona->racionDisponible->fecha))
                <td>{{$menu_persona->persona->sectorFecha($menu_persona->racionDisponible->fecha)->name}}</td>
              @else
                <td>-</td>
              @endif
              @if($menu_persona->persona->habitacionFecha($menu_persona->racionDisponible->fecha))
                <td>{{$menu_persona->persona->habitacionFecha($menu_persona->racionDisponible->fecha)->name}}</td>
              @else
                <td>-</td>
              @endif
              @if($menu_persona->persona->camaFecha($menu_persona->racionDisponible->fecha))
                <td>{{$menu_persona->persona->camaFecha($menu_persona->racionDisponible->fecha)->id}}</td>
              @else
                <td>-</td>
              @endif
              <td>{{$menu_persona->get_horario_name()}}</td>
              <td>{{$menu_persona->get_racion_name()}}</td>
              <td>{{$menu_persona->racionDisponible->fecha()}}</td>
              <td>{{$menu_persona->isRealizado_str()}}</td>
            </tr>
            @endforeach
          @endif
        </table>
    </div>


@endsection
