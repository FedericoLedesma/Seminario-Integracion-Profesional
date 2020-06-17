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
    <li class="breadcrumb-item"><a href="{{route('habitaciones.index') }}">Habitaciones</a></li>
		<li class="breadcrumb-item active">Ver habicación</li>
@endsection
@section('titulo')
Ver habitación
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($habitacion)

	    <h4>Habitación:  {{$habitacion->name}}</h4>
        <div class="col-md-6 col-md-offset-1">
         <div class="panel-heading">
           <div class="divTable blueTable">

        	    	<div class="divTableRow">
        	    		<div class="divTableCell">ID </div>
          				<div class="divTableCell">{{$habitacion->id}}</div>
                </div>
                <div class="divTableRow">
          				<div class="divTableCell">Nombre </div>
          				<div class="divTableCell">{{$habitacion->name}}</div>
                </div>
                <div class="divTableRow">
          				<div class="divTableCell">Cantidad de camas </div>
          				<div class="divTableCell">{{$habitacion->get_cantidad_camas()}}</div>
                </div>
                <div class="divTableRow">
          				<div class="divTableCell">Cantidad de camas desocupadas </div>
          				<div class="divTableCell">{{$habitacion->get_cantidad_camas_desocupadas()}}</div>
                </div>
                <div class="divTableRow">
          				<div class="divTableCell">Descripcion </div>
          				<div class="divTableCell">{{$habitacion->descripcion}}</div>
                </div>
                <div class="divTableRow">
          				<div class="divTableCell">Sector </div>
          				<div class="divTableCell">{{$habitacion->get_sector_name()}}</div>
                </div>
                <div class="divTableRow">
          				<div class="divTableCell">Creado </div>
          				<div class="divTableCell">{{date("d/m/Y H:i:s", strtotime($habitacion->created_at))}}</div>
                </div>
          			<div class="divTableRow">
          				<div class="divTableCell">Modificado </div>
          				<div class="divTableCell">{{date("d/m/Y H:i:s", strtotime($habitacion->updated_at))}}</div>
          			</div>

            </div>
          </div>
		</div>
    <div class="divTableCell">{!!link_to_route('habitaciones.edit', $title = 'MODIFICAR', $parameters = [$habitacion->id],['class' => 'btn btn-warning'], $attributes = [])!!} </div>
    <div class="divTableCell"><a class="btn btn-info" href="/habitaciones/historial/{{$habitacion->id}}">Historial</a></div>







@endif
@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
    document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
    document.getElementById("nav-administracion-habitaciones").setAttribute("class", "nav-link active");
   });
</script>
@endsection
