@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historial pacientes</a></li>
		<li class="breadcrumb-item active">Ingresar paciente</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
<h1>Agregar acompañante a {{$historial->get_paciente_name()}}</h1>
  @include('layouts.error')

<div>
  <div>
    <a href="{{action('HistorialInternacionController@sucess')}}" class="btn btn-primary">No agregar ningún acompañante</a>
    <a href="{{action('HistorialInternacionController@createAcompanante', $historial->get_id())}}" class="btn btn-primary">Ingresar nueva persona como acompañante</a>
  </div>
  <div class="container">
      <!--  <div class="row">-->
      <div class="table-responsive">
           <div class="col-md-8 col-md-offset-2">
               <!--<div class="panel panel-default">-->
           <div class="panel-heading">
           {!!Form::open(['route'=>'historialInternacion.index','method'=>'GET']) !!}
             <div class="input-group mb-3">

             <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
               <option value="busqueda_nombre_persona" >Nombre y/o apellido</option>
               <option value="busqueda_dni" > Número DNI </option>
               <option value="busqueda_nombre_sector" > Sector </option>
             </select>

               {!!	Form::text('roleid',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
               <div class="input-group-append">
                {!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
               </div>
             </div>
            {!! Form::close() !!}
            {!!	Form::label('titulo_tabla', 'Pacientes activos')!!}
            <table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
              <thead >
                <tr>
                  <th scope="col">ID Internacion</th>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Tipo de doc.</th>
                  <th scope="col">Numero de doc.</th>
                  <th scope="col">Agregar</th>

                </tr>
              </thead>

              <tbody>
              @if($personas_no_internadas)
                @foreach($personas_no_internadas as $persona)
                {!!Form::open(['route'=>'historialInternacion.addAcompanante','method'=>'GET']) !!}
                @include('layouts.error')
                <tr>
                  <td><input id="historial_id" name="historial_id" value="{{$historial->get_id()}}" size=3 readonly/></td>
                  <td><input id="persona_id" name="persona_id" value="{{$persona->get_id()}}" size=3 readonly/></td>
                  <td>{{$persona->get_name()}} {{$persona->get_apellido()}}</td>
                  <td>{{$persona->get_tipo_documento_name()}}</td>
                  <td>{{$persona->get_numero_doc()}}</td>
                  <td>

                    {!!	Form::submit('Ingresar',['class' => 'btn btn-success'])!!}

                  </td>

                </tr>
                {!! Form::close() !!}
              @endforeach
            @endif

            </table>
          </div>
          </div>
          </div>
    </div>
  </div>
</div>

@endsection
