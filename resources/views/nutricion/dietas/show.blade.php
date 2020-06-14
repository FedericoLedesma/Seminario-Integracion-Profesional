@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    div.blueTable {
    border: 1px solid #1C6EA4;
    background-color: #EEEEEE;
    width: 100%;
    text-align: left;
    border-collapse: collapse;
  }
.divTable.blueTable .divTableCell, .divTable.blueTable .divTableHead {
    border: 1px solid #AAAAAA;
    padding: 3px 2px;
  }
.divTable.blueTable .divTableBody .divTableCell {
    font-size: 13px;
  }
.divTable.blueTable .divTableRow:nth-child(even) {
    background: #CBCFD5;
  }
  .divTable.blueTable .divTableHeading {
    background: #1C6EA4;
    background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    border-bottom: 2px solid #444444;
  }
  .divTable.blueTable .divTableHeading .divTableHead {
    font-size: 15px;
    font-weight: bold;
    color: #FFFFFF;
    border-left: 2px solid #D0E4F5;
  }
  .divTable.blueTable .divTableHeading .divTableHead:first-child {
    border-left: none;
  }

  .blueTable .tableFootStyle {
    font-size: 14px;
    font-weight: bold;
    color: #FFFFFF;
    background: #D0E4F5;
    background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    border-top: 2px solid #444444;
  }
  .blueTable .tableFootStyle {
    font-size: 14px;
  }
  .blueTable .tableFootStyle .links {
    text-align: right;
  }
  .blueTable .tableFootStyle .links a{
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 8px;
    border-radius: 5px;
  }
  .blueTable.outerTableFooter {
		float:left;
	}
  .divTable{ display: table; }
  .divTableRow { display: table-row; }
  .divTableHeading { display: table-header-group;}
  .divTableCell, .divTableHead { display: table-cell;}
  .divTableHeading { display: table-header-group;}
  .divTableFoot { display: table-footer-group;}
  .divTableBody { display: table-row-group;}
</style>
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('dietas.index') }}">Dietas</a></li>
		<li class="breadcrumb-item active">Ver dieta</li>
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($dieta)

	    <h2>Dieta:  {{$dieta->id}}</h2>
      <div class="col-md-5 col-md-offset-1">
      	<div class="panel-heading">
         	<div class="divTable blueTable">

    	    	<div class="divTableRow">
    	    		<div class="divTableCell">ID </div>
      				<div class="divTableCell">{{$dieta->id}}</div>
            </div>
            <div class="divTableRow">
      				<div class="divTableCell">Observacion </div>
      				<div class="divTableCell">{{$dieta->observacion}}</div>
            </div>
            <div class="divTableRow">
      				<div class="divTableCell">Patología </div>
      				<div class="divTableCell">{{$dieta->patologia->name}}</div>
            </div>
          </div>
        </div>
		</div>
		<h3>Dietas Activas asociadas</h2>
		<div class="col-md-5 col-md-offset-1">
			<div class="panel-heading">

				<div class="divTable blueTable">
					<div class="divTableHeading">
						<div class="divTableHead">ID</div>
						<div class="divTableHead">Fecha desde</div>
						<div class="divTableHead">Fecha final</div>
					</div>
					<div class="divTableBody">
						@foreach($dieta->dietaActiva as $d_a)
						<div class="divTableRow">
							<div class="divTableCell">{{$d_a->id}}</div>
							<div class="divTableCell">{{$d_a->fecha}}</div>
							<div class="divTableCell">{{$d_a->fecha_final}}</div>
							<div class="divTableCell">
								<a href="#" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-{{$d_a->id}}">
									Raciones asociadas
								</a>
							</div>
						</div>
						@if($d_a->raciones)
						<div class="modal fade" id="modal-{{$d_a->id}}">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header" id="modal-header">
										<h4>Raciones asociadas a la dieta activa {{$d_a->id}} </br>
											Entre las fecha {{$d_a->fecha}} / {{$d_a->fecha_final}} </h4>
										<button type="button" class="close" data-dismiss="modal">
											<span>×</span>
										</button>
									</div>
									<div class="modal-movimiento-body">
										<div id="p_body">
											<table class="table table-striped table-hover ">
												<thead >
													<tr>
														<th scope="col">Racion</th>
													</tr>
												</thead>
												<tbody>
												@foreach($d_a->raciones as $racion)
													<tr>
														<td>{{$racion->name}}</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif
						@endforeach
				</div>
			</div>
		</div>
	</div>
@endif

@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
		document.getElementById("nav-dietas").setAttribute("class","nav-link active");
		});
</script>
@endsection
