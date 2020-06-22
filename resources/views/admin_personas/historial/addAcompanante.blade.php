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
