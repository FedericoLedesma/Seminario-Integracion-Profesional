<head>
  <script
          src="https://code.jquery.com/jquery-3.5.1.js"
          integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
          crossorigin="anonymous">
  </script>
</head>


@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personal.index') }}">Personal</a></li>
		<li class="breadcrumb-item active">Ingresar personal</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
    <h1>Ingresar nueva persona</h1>


    {!!Form::open(['method'=>'get','action'=>'PersonalController@ingresarNuevo'])!!}
    <div class="container">
       <div class="row justify-content-md-center">
          <div class="col col-lg-3">
              {!!	Form::label('numero_doc', 'Numero Doc.')!!}
          </div>
          <div class="col-sm">
              <input id="numero_doc" name="numero_doc" type="number" min="20000000" max="99999999" required></input>
          </div>
      </div>
       <div class="row">
          <div class="col col-lg-3">
              {!!	Form::label('tipo_documento_id', 'Tipo de Documento')!!}
          </div>
          <div class="col-sm">
              @if($tipos_documentos)
                <select name="tipo_documento_id">
                <!--	<option selected>Seleccione el Rol</option>validar-->
              @foreach ($tipos_documentos as $tipos_documento)
              <!-- Opciones de la lista -->
                <option value="{{$tipos_documento->id}}" >{{$tipos_documento->name}}</option> <!-- Opci�n por defecto -->

              @endforeach
               </select>
             @endIf
          </div>
      </div>
        <div class="row">
            <div class="col-sm col-lg-3">
                {!!	Form::label('name', 'Nombre')!!}
            </div>
            <div class="col-sm">
                <input id="name" name="name" type="text" required></input>
            </div>
        </div>
       <div class="row">
        <div class="col-sm col-lg-3">
            {!!	Form::label('apellido', 'Apellido')!!}
        </div>
        <div class="col-sm">
            <input id="apellido" name="apellido" type="text" required></input>
        </div>
      </div>
       <div class="row">
        <div class="col-sm col-lg-3">
            {!!	Form::label('sector_id', 'Sector')!!}
        </div>
        <div class="col-sm">
            @if($sectores)
              <select name="sectores" id='sectores'>
              <!--	<option selected>Seleccione el Rol</option>validar-->
            @foreach ($sectores as $sector)
            <!-- Opciones de la lista -->
              <option value="{{$sector->id}}" >{{$sector->name}}</option> <!-- Opci�n por defecto -->

            @endforeach
             </select>
           @endIf
        </div>
      </div>
       <div class="row">
        <div class="col-sm col-lg-3">
            {!!	Form::label('direccion', 'Direccion')!!}
        </div>
        <div class="col-sm">
            <input id="direccion" name="direccion" type="text" required></input>
        </div>
      </div>
       <div class="row">
        <div class="col-sm col-lg-3">
            {!!	Form::label('email', 'EMail')!!}
        </div>
        <div class="col-sm">
            <input id="email" name="email" type="email" required></input>
        </div>
      </div>
       <div class="row">
        <div class="col-sm col-lg-3">
            {!!	Form::label('provincia', 'Provincia')!!}
        </div>
        <div class="col-sm">
            <input id="provincia" name="provincia" type="text" required></input>
        </div>
      </div>
       <div class="row">
         <div class="col-sm col-lg-3">
            {!!	Form::label('localidad', 'Localidad')!!}
         </div>
         <div class="col-sm">
             <input id="localidad" name="localidad" type="text" required></input>
         </div>
      </div>
       <div class="row">
        <div class="col-sm col-lg-3">
            {!!	Form::label('sexo', 'Sexo')!!}
        </div>
        <div class="col-sm">
            <input id="sexo" name="sexo" type="text" required></input>
        </div>
      </div>
       <div class="row">
        <div class="col-sm col-lg-3">
            {!!	Form::label('fecha_nac', 'Fecha Nacimiento')!!}
        </div>
        <div class="col-sm">
            <input id="fecha_nac" name="fecha_nac" type="date" required value="{{\Carbon\Carbon::now()->toDateString()}}"></input>
        </div>
      </div>
      <div class="row">
       <div class="col-sm col-lg-3">
            {!!	Form::submit('Guardar Persona',['class' => 'btn btn-success'])!!}
       </div>
       <div class="col-sm">
            {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
       </div>
      </div>
   </div>
  {!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
    document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
    document.getElementById("nav-administracion-personal").setAttribute("class", "nav-link active");
   });
</script>
@endsection
