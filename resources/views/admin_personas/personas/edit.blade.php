@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personas.index') }}">Personas</a></li>
		<li class="breadcrumb-item active">Editar Persona</li>
@endsection
@section('titulo')
Editar Persona
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($persona, ['route' => ['personas.update', $persona->id], 'method'=> 'PUT'])!!}
	 	@if($persona)
	    <h3>Persona  {{$persona->name}}</h3>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-6 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$persona->id}}</td>
  			</tr>
        <tr>
  				<td>Tipo Doc </td>
  				<td>
          @if($tipos_documentos)
            <select name="tipo_documento_id">
              @foreach ($tipos_documentos as $tipo_documento)

              <!-- Opciones de la lista -->
                @if($tipo_documento->id==$persona->tipo_documento_id)
                <option value="{{$tipo_documento->id}}" selected >{{$tipo_documento->name}}</option>
                @else
                <option value="{{$tipo_documento->id}}" >{{$tipo_documento->name}}</option>  <!-- Opci�n por defecto -->
                @endif
              @endforeach
            </select>
          @endIf
        </td>


  			</tr>
        <tr>
  				<td>Numero_doc </td>
  				<td>	{!!	Form::text('numero_doc',$persona->numero_doc)!!}</td>
  			</tr>
  			<tr>
  				<td>Apellido </td>
  				<td>{!!	Form::text('apellido',$persona->apellido)!!}</td>
  			</tr>
        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$persona->name)!!}</td>
  			</tr>
        <tr>
  				<td>Observacion </td>
  				<td>{!!	Form::text('observacion',$persona->observacion)!!}</td>
  			</tr>
        <tr>
  				<td>Direccion </td>
  				<td>{!!	Form::text('direccion',$persona->direccion)!!}</td>
  			</tr>
        <tr>
  				<td>EMail </td>
  				<td>{!!	Form::text('email',$persona->email)!!}</td>
  			</tr>
        <tr>
  				<td>Provincia </td>
  				<td>{!!	Form::text('provincia',$persona->provincia)!!}</td>
  			</tr>
        <tr>
  				<td>Localidad </td>
  				<td>{!!	Form::text('localidad',$persona->localidad)!!}</td>
  			</tr>
        <tr>
  				<td>Sexo </td>
  				<td>{!!	Form::text('sexo',$persona->sexo)!!}</td>
  			</tr>
        <tr>
  				<td>Fecha de Nacimiento </td>
  				<td>{!!	Form::text('fecha_nac',$persona->fecha_nac)!!}</td>
  			</tr>
		 </table>
		 @endif

		</div>
    @if($persona->patologias)
    <h5>Patologías que tiene esta persona</h5>
     <table class="table table-bordered table-hover table-striped">
       <thead>
         <tr>
           <td>Nombre</td>
           <td>Descripción</td>
           <td>Quitar</td>
         </tr>
       </thead>
       <tbody>
         @foreach($persona->patologias as $patologia)
         <tr>
           <tr>
              <td>
                  {{$patologia->name}}
              </td>
              <td>
                  {{$patologia->descripcion}}
              </td>
             <td><a href="#" class="btn btn-danger quitarPatologia" data-token="{{ csrf_token() }}" data-patologia="{{ $patologia }}" data-persona="{{ $persona }}">X</a></td>
           </tr>
         </tr>
         @endforeach
       </tbody>
     </table>
   @endif
		</div>
    <div class="col-md-6 col-md-offset-6">
      {!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
      {!!link_to_route('personas.show', $title = 'CANCELAR', $parameters = [$persona], $attributes = ['class'=>'btn btn-warning'])!!}
      <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">
      Agregar patologias
      </a>
    </div>
  {!! Form::close() !!}


  <div class="modal fade" id="create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4>Agregar patologías a persona</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>

            </div>
            <div class="modal-body">
              <div class="card card-default">
         	 			<div class="card-header">
         	 				<h3 class="card-title">Patologías que no tiene esta persona</h3>

         	 				<div class="card-tools">
         	 					<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

         	 				</div>
         	 			</div>
         	 			<!-- /.card-header -->
         	 			<div class="card-body">
         	 				<div class="row">
         	 					<div class="col-12">
         	 						<div class="form-group">
         	 							<label>Seleccione las patologias a asignar</label>
         	 							<select class="duallistbox" id="option_multiple" multiple="multiple">
         	 							@if($patologias)
         	 								@foreach($patologias as $patologia)
         	 									<option value="{{$patologia->id}}">{{$patologia->name}}</option>
         	 								@endforeach
         	 							@endif
         	 							</select>
         	 						</div>
         	 						<!-- /.form-group -->
         	 					</div>
         	 					<!-- /.col -->
         	 				</div>
         	 				<!-- /.row -->
         	 			</div>
         	 			<!-- /.card-body -->
         	 		</div>
            </div>
            <div class="modal-footer">
                <a href="" data-id="{{$persona}}" class="btn btn-primary agregar_patologias" >Guardar</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
   $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
   document.getElementById("nav-personas").setAttribute("class", "nav-link active");
   });
</script>

<script type="text/javascript">
$('.agregar_patologias').on('click', function (e){
    e.preventDefault();
  $('#tablealimentosAgregados tr').remove();
    console.log( $(this).data("id"));
    var persona= $(this).data("id");
    var array=[];
    var id=persona.id;
    var a=document.getElementById("bootstrap-duallistbox-selected-list_");
    console.log(a);
    for (var i = 0; i < a.length; i++) {
      console.log(a[i].value);
      array.push(a[i].value);
      console.log(array);
  }

  var ruta="/personas/:id/agregarPatologias";
  ruta= ruta.replace(':id',id);
  $.ajax({
    type: 'PUT',
    url: ruta,
    dataType: 'json',
    data:{id,array},
      success: function (data) {
          console.log(data);
          location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }

      });

  });

  $('.quitarPatologia').click(function(e){

		e.preventDefault();//evita cargar la pagina

		if(!confirm("¿Esta seguro que desea quitarle la patologia?")){
			return false;
		}

		var row = $(this).parents('tr');
		var token = $(this).data("token");
		var patologia = $(this).data("patologia");
		var persona=$(this).data("persona");

		var url_quitar = "/personas/:id/quitarpatologia";
		url_quitar = url_quitar.replace(':id',patologia.id);
		console.log(patologia);
		console.log(url_quitar);
	$('#alert').show();
	    $.ajax({
	    	type: 'PUT',
	    	url: url_quitar,
	    	dataType: 'json',
				data:{data:[persona.id,patologia.id]},
		    	success: function (data) {
						if (data.estado=='true'){
						   		row.fadeOut();
	        			$('#alert').html(data.success);
							  	console.log(data.success);
								}else{
									$('#alert').html(data.success);
										console.log(data.success);
								}
                },
                error: function (data) {
                    console.log('Error:', data);
                }

	        });
	});


</script>

<script type="text/javascript">
$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })


  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  })

  //Bootstrap Duallistbox
  $('.duallistbox').bootstrapDualListbox()

  //Colorpicker
  $('.my-colorpicker1').colorpicker()
  //color picker with addon
  $('.my-colorpicker2').colorpicker()

  $('.my-colorpicker2').on('colorpickerChange', function(event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
  });

  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });

})
</script>
@endsection
