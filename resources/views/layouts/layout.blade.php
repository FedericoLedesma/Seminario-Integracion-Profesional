<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	@yield('token')
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
 <!--  <link rel="stylesheet" href="dist/css/adminlte.min.css">-->
  <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <!-- Links del plugin del calendario -->
  <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
-->
<style>
.navbar-verde {
  background-color: #95EEE9;
}
</style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home') }}" class="nav-link">Home</a>
      </li>

    </ul>

    <!-- SEARCH FORM -->
   <!--   <form class="form-inline ml-1">
      <div class="input-group input-group-sm">
        <input id="buscar" class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Perfil Dropdown Menu -->

    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{ Auth::user()->name }}
          <i class="fa fa-sort-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu dropdown-menu-right">
          <a href="{{ route('user.perfil') }}" class="dropdown-item">

         	Perfil
			<i class="fas fa-angle-right"></i>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('user.config') }}" class="dropdown-item">

        	Configuración
        	<i class="fas fa-angle-right"></i>
          </a>

          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer"
          		onclick="event.preventDefault();
                	document.getElementById('logout-form').submit();">

	          Cerrar sesi&oacute;n
	          <i class="fas fa-sign-out-alt"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
		  </form>
        </div>
      </li>   <!-- Notifications Dropdown Menu -->



    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary navbar-verde elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home') }}" class="brand-link">
      <!--  <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">-->
      <span class="brand-text font-weight-light">Nutrición</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
          <a href="{{ route('user.perfil') }}" class="d-block">ROL:  {{ Auth::user()->getRol() }}  </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <!--              usuarios        -->

          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link" id="nav-usuarios">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link" id="nav-usuarios-todos">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('users.create') }}" class="nav-link" id="nav-usuarios-create">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Usuario</p>
                </a>
              </li>
            </ul>
          </li>
          <!--                      -->
           <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link" id="nav-roles">
              <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link" id="nav-roles-todos">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('roles.create') }}" class="nav-link" id="nav-roles-create">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Rol</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link" id="nav-permisos">
              <i class="nav-icon fa fa-unlock-alt"></i>
              <p>
                Permisos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('permisos.index') }}" class="nav-link" id="nav-permisos-todos">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('permisos.create') }}" class="nav-link" id="nav-permisos-create">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Permiso</p>
                </a>
              </li>
             </ul>
          </li>
          <!--              personas        -->
         <li class="nav-item has-treeview menu-close">
           <a href="#" class="nav-link" id="nav-personas">
             <i class="nav-icon fas fa-user-friends"> </i>
             <p>Personas
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{ route('personas.index') }}" class="nav-link" id="nav-personas-todas">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Ver todas</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="{{ route('personas.create') }}" class="nav-link" id="nav-personas-create">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Agregar Persona</p>
               </a>
             </li>
           </ul>
         </li>
         <!--           fin personas           -->
        <!--              patologias        -->
       <li class="nav-item has-treeview menu-close">
         <a href="#" class="nav-link" id="nav-patologias">
           <i class="nav-icon fas fa-notes-medical"></i>
           <p>
             Patologías
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('patologias.index') }}" class="nav-link" id="nav-patologias-todas">
               <i class="far fa-circle nav-icon"></i>
               <p>Ver todas</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('tipospatologias.index') }}" class="nav-link" id="nav-tipospatologias">
               <i class="far fa-circle nav-icon"></i>
               <p>Tipos de patologías</p>
             </a>
           </li>
         </ul>
       </li>
       <!--           fin patologias           -->
        <!--              nutricion        -->
       <li class="nav-item has-treeview menu-close">
         <a href="#" class="nav-link" id="nav-nutricion">
           <i class="nav-icon fas fa-apple-alt"></i>
           <p>
             Nutrición
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('menu_persona.index') }}" class="nav-link" id="nav-menus">
               <i class="far fa-circle nav-icon"></i>
               <p>Menús</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{route('dietas.index')}}" class="nav-link" id="nav-dietas">
               <i class="far fa-circle nav-icon"></i>
               <p>Dietas</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('raciones.index') }}" class="nav-link" id="nav-raciones">
               <i class="far fa-circle nav-icon"></i>
               <p>Raciones</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('raciones-disponibles.index') }}" class="nav-link" id="nav-disponibilidad">
               <i class="far fa-circle nav-icon"></i>
               <p>Disponibilidad de Raciones</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('alimentos.index') }}" class="nav-link" id="nav-alimentos">
               <i class="far fa-circle nav-icon"></i>
               <p>Alimentos</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('movimientos.index') }}" class="nav-link" id="nav-movimientos">
               <i class="far fa-circle nav-icon"></i>
               <p>Movimientos</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('informes.index') }}" class="nav-link" id="nav-movimientos">
               <i class="far fa-circle nav-icon"></i>
               <p>Informes</p>
             </a>
           </li>
         </ul>
       </li>
       <!--           fin persona           -->

       <!--              enfermería        -->
       <li class="nav-item has-treeview menu-close">
        <a href="#" class="nav-link" id="nav-enfermeria">
          <i class="nav-icon left fas fa-user-md"></i>
          <p>
                Enfermería
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('historialInternacion.index') }}" class="nav-link" id="nav-internacion">
              <i class="far fa-circle nav-icon"></i>
              <p>Historial de pacientes</p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{ route('pacientes.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Ficha de pacientes</p>
            </a>
          </li>-->

        </ul>
       </li>
       <!--           fin enfermería           -->
       <!--              Admin. general        -->
       <li class="nav-item has-treeview menu-close">
        <a href="#" class="nav-link" id="nav-administracion">
          <i class="nav-icon fas fa-cogs"></i>
          <p>
            Admin. general
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('sectores.index') }}" class="nav-link" id="nav-administracion-sectores">
              <i class="far fa-circle nav-icon"></i>
              <p class="text-dark">Sectores</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('habitaciones.index') }}" class="nav-link" id="nav-administracion-habitaciones">
              <i class="far fa-circle nav-icon"></i>
              <p>Habitaciones</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('personal.index') }}" class="nav-link" id="nav-administracion-personal">
              <i class="far fa-circle nav-icon"></i>
              <p>Personal</p>
            </a>
          </li>
        </li>
        <li class="nav-item">
          <a href="{{ route('profesion.index') }}" class="nav-link" id="nav-administracion-profesion">
            <i class="far fa-circle nav-icon"></i>
            <p>Profesión</p>
          </a>
        </li>

        </ul>
       </li>
       <!--           fin admin. general           -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('titulo')</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home') }}">Home</a></li>
              @yield('navegacion')

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
        <div class="content">
                <!-- Content Header (Page header) -->

                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                    @yield('content')
                    </div>
                </section>
                <!-- /.content -->
            </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <!--<footer class="main-footer">-->
    <!-- To the right -->
    <!--<div class="float-right d-none d-sm-inline">

    </div>-->
    <!-- Default to the left -->
    <!--<strong></strong>
  </footer>-->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('js/script.js')}}"></script>

@yield('script')



</body>
</html>
