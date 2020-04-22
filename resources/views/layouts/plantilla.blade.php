
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1" />
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<style>
.btn-logout {
  width: 100%;
  padding: 3px 20px !important;
  text-align: left !important;
}

nav.navbar {
    background-color: #EFF3F1;
}
body {
  background-color: #C1F5DF;
}
</style>

<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!--  <ul class="nav navbar-nav">-->
            <ul class="nav navbar-nav">
              <li class="active"><a href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
              </li>
              <li><a href="{{ route('users.index') }}">Usuarios</a>
              </li>
               <li><a href="{{ route('roles.index') }}">Roles</a>
              </li>
               <li><a href="{{ route('permisos.index') }}">Permisos</a>
              </li>
             
            </ul>
           
            
            <ul class="nav navbar-nav navbar-right">
            	<li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                	<ul class="dropdown-menu">
	               		 <li><a href="{{ route('user.perfil') }}">Perfil</a>
	                  	</li>
	                  	<li role="separator" class="divider"></li>
	                  	<li><a href="{{ route('user.config') }}">Configuracion</a>
	                  	</li>
	                  
                  		<li>
	                   		<a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 @csrf
			                </form>
                  		</li>
                	</ul>
             	</li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </div>
  </div>
</div>
<div class="contenedor">
            @yield('content')
</div>
</body>
</html>