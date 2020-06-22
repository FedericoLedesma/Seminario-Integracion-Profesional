@extends('layouts.layout')
@section('token')
<script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous">
</script>
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historial pacientes</a></li>
		<li class="breadcrumb-item active">Ingresar paciente</li>
@endsection
<style>
.center {
  margin: auto;
  width: 60%;
  padding: 10px;
}
</style>
@section('titulo')
  Ingresar paciente
@endsection
@section('content')
  @include('layouts.error')

	    {!!Form::open(['method'=>'post','action'=>'HistorialInternacionController@store'])!!}

	    <div>
        <div>
          <a href="{{action('HistorialInternacionController@createPaciente')}}" class="btn btn-primary">Ingresar a paciente nuevo</a>
        </div>
        <p>
        </p>
        <div class="table-responsive">
          <div class="col-md-auto col-md-offset-2">
      			 <div class="panel-heading">
      					{!!	Form::label('titulo_tabla', 'Personas registradas')!!}
                <div class="card-body">
        					<table id="example1" class="table table-bordered table-striped"><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
          					<thead >
        							<tr>
        								<th scope="col">ID</th>
        								<th scope="col">Nombre</th>
        								<th scope="col">Tipo de doc.</th>
        								<th scope="col">Numero de doc.</th>
        								<th scope="col">Sector</th>
        								<th scope="col">Habitación</th>
        								<th scope="col">Peso</th>
        								<th scope="col">Ingresar</th>

        							</tr>
        						</thead>

        						<tbody>
        						@if($personas_no_internadas)
        							@foreach($personas_no_internadas as $persona)
                      {!!Form::open(['route'=>'historialInternacion.storeExistente','method'=>'GET']) !!}
                      @include('layouts.error')
                      <tr>
        								<td>
                          <input id="persona_id" name="persona_id" value="{{$persona->get_id()}}" size=3 readonly/>
                        </td>
        								<td>{{$persona->get_name()}} {{$persona->get_apellido()}}</td>
        								<td>{{$persona->get_tipo_documento_name()}}</td>
        								<td>{{$persona->get_numero_doc()}}</td>
                        <td>
                          <select class="browser-default custom-select" id="sectores" name="sectores">
                            @if($sectores)
                              @foreach($sectores as $sector)
                                <option value= {{$sector->get_id()}}>{{$sector->get_name()}}</option>
                              @endforeach
                            @endif
                          <select/>
                        </td>
                        <td><div id='select_habitacion' name='select_habitacion'>
                          <select id="habitacion_id" name="habitacion_id">
                            @if($habitaciones)
                              @foreach($habitaciones as $habitacion)
                                <option value= {{$habitacion->get_id()}}>{{$habitacion->get_name()}}</option>
                              @endforeach
                            @endif
                          </select>
                        </td></div>
        								<td>
                          <input type="number" id="peso" name="peso" value="0"/>
                        </td>
        								<td>

          								{!!	Form::submit('Ingresar',['class' => 'btn btn-success'])!!}

                        </td>

        							</tr>
                      {!! Form::close() !!}
    								@endforeach
    							@endif
                </tbody>
        			</table>
        		</div>
        	</div>
        </div>
    	</div>
    </div>

		{!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
	$("document").ready(function(){


		$("#sectores").change(function(){
			var token = '{{csrf_token()}}';
			$.ajax({
				type:"get",
				url:	"/forms/habitaciones_disponibles/select/" + $('#sectores').val(),
				success:function(r){
					$('#select_habitacion').html(r);
				}
			});
		});
	});
</script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
 $(document).ready(function(){
    document.getElementById("nav-enfermeria").setAttribute("class", "nav-link active");
    document.getElementById("nav-internacion").setAttribute("class", "nav-link active");
   });
</script>
<script>
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
