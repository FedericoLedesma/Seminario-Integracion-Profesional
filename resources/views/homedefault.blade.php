<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Nutricionista</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
    <body>
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Tablero</div>
	
	                <div class="panel-body">
	                    @if (session('status'))
	                        <div class="alert alert-success">
	                            {{ session('status') }}
	                        </div>
	                    @endif
	                    
	                    Esta conectado 
	                    <label>{{Auth::user()->name}}</label>
	                </div>
	             
	            </div>
	        </div>
	    </div>
	</div>     
	    
	    
    </body>
   
</html>