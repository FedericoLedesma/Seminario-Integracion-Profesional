@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historial pacientes</a></li>
		<li class="breadcrumb-item active">Ingresar paciente</li>
@endsection
@section('titulo')
Agregar acompañante a un paciente
@endsection
@section('content')

<h4>Paciente {{$historial->get_paciente_name()}}</h4>
  @include('layouts.error')
	<div id="alert" class="alert alert-danger"></div>
<div>
  <div>
    <a href="{{action('HistorialInternacionController@sucess')}}" class="btn btn-primary">No agregar ningún acompañante</a>
    <a href="{{action('HistorialInternacionController@createAcompanante', $historial->get_id())}}" class="btn btn-primary">Ingresar nueva persona como acompañante</a>
    <a href="" data-toggle="modal" data-target="#modal" class="btn btn-primary">Ingresar a nuevo </a>
  </div>
  <div class="container">
      <!--  <div class="row">-->
      <div class="table-responsive">
           <div class="col-md-auto col-md-offset-2">
               <!--<div class="panel panel-default">-->
           <div class="panel-heading">
          <!-- {!!Form::open(['route'=>'historialInternacion.index','method'=>'GET']) !!}
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
            {!! Form::close() !!}-->
            {!!	Form::label('titulo_tabla', 'Personas registradas')!!}
            <div class="card-body">
          		<table id="example1" class="table table-bordered table-striped">
              <thead >
                <tr>
                  <th scope="col">Apellido</th>
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
                  <td>{{$persona->get_apellido()}}</td>
                  <td>{{$persona->get_name()}} </td>
                  <td>{{$persona->get_tipo_documento_name()}}</td>
                  <td>{{$persona->get_numero_doc()}}</td>
                  <td>

                  <!--  {!!	Form::submit('Ingresar',['class' => 'btn btn-success'])!!}-->
                    <a href="#" class="btn btn-success pull-right ingresar" data-id="{{$persona}}" data-historial_id="{{$historial->get_id()}}">
        							Ingresar
        						</a>

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

<div class="modal fade" id="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="modal-movimiento-header">
        <h4>Registrar nuevo acompañante</h4>
        <button type="button" class="close" data-dismiss="modal">
          <span>×</span>
        </button>
      </div>
      {!!Form::open(['method'=>'get','action'=>'HistorialInternacionController@storeNewAcompanante'])!!}
      <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Número de documento</label>
                  <input id="numero_doc"  class="form-control" name="numero_doc" type="number" min="1000000" max="999999999" required></input>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tipo de doc.</label>
                  @if($tipos_documentos)
                    <select name="tipo_documento_id" id="tipo_documento_id" class="browser-default custom-select">
                      @foreach ($tipos_documentos as $tipos_documento)
                      <option value="{{$tipos_documento->id}}" >{{$tipos_documento->name}}</option>
                      @endforeach
                   </select>
                 @endIf
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellidos ...">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nombres</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Nombres ...">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="Email (opcional) ...">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Domicilio</label>
                  <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Domicilio ...">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Localidad</label>
                  <input type="text" name="localidad" id="localidad" class="form-control" placeholder="Localidad ...">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Provincia</label>
                  <input type="text" name="provincia" id="provincia" class="form-control" placeholder="Provincia ...">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Sexo</label>
                  <input type="text" name="sexo" id="sexo" class="form-control" placeholder="Sexo ...">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Fecha de Nacimiento</label>
                  <input id="fecha_nac" class="form-control" name="fecha_nac" type="date" required value="{{\Carbon\Carbon::now()->toDateString()}}"></input>
                </div>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-success" id="registrar" data-historial_id="{{$historial->get_id()}}">
          registrar
        </a>
         {!!	Form::submit('Guardar Persona',['class' => 'btn btn-success'])!!}
        {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection
@section('script')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(document).ready(function(){
   $('#alert').hide();
 });
  $('#registrar').click(function(e){
    var numero_doc=$('#numero_doc').val();
    var tipo_documento_id=$('#tipo_documento_id').val();
    var apellido=$('#apellido').val();
    var name=$('#name').val();
    var email=$('#email').val();
    var direccion=$('#direccion').val();
    var localidad=$('#localidad').val();
    var provincia=$('#provincia').val();
    var sexo=$('#sexo').val();
    var fecha_nac=$('#fecha_nac').val();
    var historial_id=$(this).data("historial_id");
    console.log(historial_id);
    $.ajax({
      type: 'get',
      url: '/historialInternacion/store_new_acompanante',
      dataType: 'json',
      data:{numero_doc,tipo_documento_id,apellido,name,email,direccion,localidad,
              provincia,sexo,fecha_nac,historial_id},
        success: function (data) {
          console.log(data);
          if(data.estado=='true'){
            console.log(data);
            window.location="/historialInternacion/"+historial_id;
          }else{
             console.log(data);
             $('#alert').show();
             $('#alert').html(data.success);
          }
        },
        error: function (data) {
          console.log('Error:', data);
          $('#alert').show();
          $('#alert').html(data);
        }
    });
  });


	$('#example1 tbody').on( 'click', '[class*=ingresar]', function (e) {
   e.preventDefault();
   var persona = $(this).data("id");
   var persona_id=persona.id;
   var historial_id=$(this).data("historial_id");
   var url="/historialInternacion/ingresar_acompanante";
   var horario_id=$('#horario_id').val();
   var modal=document.getElementById("create");
   $.ajax({
     type: 'get',
     url: url,
     dataType: 'json',
       data:{persona_id,historial_id},
       success: function (data) {
         console.log(data);
         if(data.estado=='true'){
           console.log(data);
           window.location="/historialInternacion/"+historial_id;
         }else{
            console.log(data);
            $('#alert').show();
            $('#alert').html(data.success);
         }
       },
       error: function (data) {
         console.log('Error:', data);
         $('#alert').show();
         $('#alert').html(data);
       }
   });

 });
 $(function () {
   $("#example1").DataTable({
     "responsive": true,
     "autoWidth": false,
   });
   $('#example2').DataTable({
     "paging": true,
     "lengthChange": false,
     "searching": false,
     "ordering": true,
     "info": true,
     "autoWidth": false,
     "responsive": true,
   });
 });
 </script>
@endsection
