@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- Theme style -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('raciones.index') }}">Raciones</a></li>
		<li class="breadcrumb-item"><a href="/raciones/{{$racion->id}}/edit">Editar ración</a></li>
		<li class="breadcrumb-item active">Agregar alimentos</li>
@endsection
@section('titulo')
	Agregar alimentos a ración
@endsection
@section('content')


	 	@if($racion)
    	<h4>{{$racion->name}}</h4>
      @include('layouts.error')

    <div class="col-md-6 col-md-offset-6">
  	</div>
		<div class="card card-default">
			<div class="card-header">
				<h3 class="card-title">Alimentos que aún no contiene</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label>Seleccione los alimentos</label>
							<select class="duallistbox" id="option_multiple" multiple="multiple">
							@if($alimentos)
								@foreach($alimentos as $alimento)
									<option value="{{$alimento->id}}">{{$alimento->name}}</option>
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
		<!-- /.card -->
		<div class="alert alert-info" role="alert">
		 Presione "Agregar" para guardar los cambios y establecer cantidades.
	 </div>
				<div><a href="" class="btn btn-success agregar" data-id="{{$racion->id}}" >Agregar</a>
					<a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">
							 Crear Alimento
					 </a>
					 {!!link_to_route('raciones.show', $title = 'Volver', $parameters = [$racion], $attributes = ['class'=>'btn btn-warning'])!!}
			 </div>

		<div class="modal fade" id="create">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
								<h4>Crear Alimento</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>

	            </div>
	            <div class="modal-body">
								<table>
									<tr>
										<td>
												{!!	Form::label('name', 'Nombre')!!}
										</td>
										<td>
											<input type="text" id="nameAlimento" name="name">
										</td>
									</tr>
								</table>

	            </div>
	            <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                <a href="" class="btn btn-primary nuevoAlimento" >Guardar</a>
	            </div>
	        </div>
	  	</div>
		</div>
		@endif
@endsection
@section('script')

	<script src="{{asset('js/racion-script.js')}}"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
  		document.getElementById("nav-raciones").setAttribute("class","nav-link active");
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
