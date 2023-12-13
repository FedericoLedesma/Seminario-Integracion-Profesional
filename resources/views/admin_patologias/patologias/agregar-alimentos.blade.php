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
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Patologías</a></li>
		<li class="breadcrumb-item active">Editar Patologia</li>
@endsection
@section('titulo')
	Agregar alimentos prohibidos a Patología
@endsection
@section('content')

	 	 {!! Form::model($patologia, ['route' => ['patologias.update', $patologia->id], 'method'=> 'PUT'])!!}
	 	@if($patologia)
	    <h4>{{$patologia->name}}</h4>
	      @include('layouts.error')
				<div class="col-md-6 col-md-offset-6">
 	   	</div>
 	 		<div class="card card-default">
 	 			<div class="card-header">
 	 				<h3 class="card-title">Alimentos que aún no contiene como prohibidos</h3>

 	 				<div class="card-tools">
 	 					<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

 	 				</div>
 	 			</div>
 	 			<!-- /.card-header -->
 	 			<div class="card-body">
 	 				<div class="row">
 	 					<div class="col-12">
 	 						<div class="form-group">
 	 							<label>Seleccione los alimentos prohibidos</label>
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

 	 				<div><a href="" class="btn btn-success agregar" data-id="{{$patologia}}" >Guardar</a>
 	 					<a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">
 	 							 Crear Alimento
 	 					 </a>
 	 					 {!!link_to_route('patologias.show', $title = 'Volver', $parameters = [$patologia], $attributes = ['class'=>'btn btn-warning'])!!}
 	 			 </div>

@endif
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
@endsection
@section('script')
 <script src="{{asset('js/patologia-script.js')}}"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
 		 document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
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
