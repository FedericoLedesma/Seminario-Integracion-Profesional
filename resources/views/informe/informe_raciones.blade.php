@extends('layouts.layout_pdf')
@section('content')


    <div><h1>Informe de Raciones de menús</h1>
      <h2>Solicitado : {{$creado}} </h2>
      <p>Usuario que solicitó: Apellido: {{$user->personal->persona->apellido}}. Nombre: {{$user->personal->persona->name}} </p>
      <p>Número de documento {{$user->personal->persona->numero_doc}} - ID: {{$user->personal->persona->id}}</p>
      <p>
        Filtro : {{$busqueda_por}}  {{$query}} <br>
      </p>
      <h3>Raciones asiganadas a menús</h3>
        <table>
          <thead >
            <tr>
              <th scope="col">Racion</th>
              <th scope="col">Cantidad </th>
            </tr>
          </thead>

          <tbody>
          @if($raciones)
            @foreach($raciones as $racion)
            <tr>
              <td>{{$racion->name}}</td>
              <td>{{$cantidad_raciones[$racion->id]}}</td>
            </tr>
            @endforeach
          @endif
        </tbody>
      </table>
        <p>-----------------------------------------------------------------------------------------------------------------------------</p>
        <h3>Raciones que aún no se entregaron</h3>
        @if($raciones_a_preparar)
          @foreach($raciones_a_preparar as $racion)
          <p>Racion: {{$racion->name}}. Cantidad: {{$cantidad_raciones_a_preparar[$racion->id]}}</p>
          <div class="divTable blueTable">
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead">Alimentos de la racion {{$racion->name}}</div>
                <div class="divTableHead"></div>
              </div>
              <div class="divTableRow">
                <div class="divTableHead">Nombre</div>
                <div class="divTableHead">Cantidad</div>
              </div>
            </div>
            @foreach($racion->alimentos as $alimento)
            <div class="divTableBody">
              <div class="divTableRow">
                <div class="divTableCell">{{$alimento->name}}</div>
                <div class="divTableCell">{{$racion->getAlimento($alimento->id)->first()->pivot->cantidad}} gr.</div>
              </div>
            </div>
            @endforeach
          </div>
          <p>-----------------------------------------------------------------------------------------------------------------------------</p>
          @endforeach
        @endif
    </div>

@endsection
