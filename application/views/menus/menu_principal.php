<header class="main-header">

  <!-- Logo -->
  <a href="<?=base_url()?>principal" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><small>AECC</small></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Terapeuta</b> AECC</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs"><?=$this -> session -> nombre?> <?=$this -> session -> apellido1?> <?=$this -> session -> apellido2?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

              <p>
                <?=$this -> session -> nombre?>
                  <?=$this -> session -> apellido1?>
                    <?=$this -> session -> apellido2?>
                      <small>Terapeuta</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">

              <div class="pull-right">
                <a href="<?=base_url()?>login/cerrarSesion" class="btn btn-default btn-flat">Cerrar sesión</a>
              </div>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
      
    </div>

  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>
          <?=$this -> session -> nombre?>
            <?=$this -> session -> apellido1?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">NAVEGACIÓN PRINCIPAL</li>
      <li>
        <a href="<?=base_url()?>principalTerapeuta">
          <i class="fa fa-home"></i> <span>Inicio</span> </i>
        </a>
      </li>
      <li>
        <a href="<?=base_url()?>pacientesTerapeuta">
          <i class="fa fa-users"></i> <span>Pacientes</span> </i>
        </a>
      </li>
      <li>
        <a href="<?=base_url()?>sintomasTerapeuta">
          <i class="fa fa-list-alt"></i> <span>Sintomas</span> </i>
        </a>
      </li>
      <li>
        <a href="<?=base_url()?>medicamentosTerapeuta">
          <i class="fa fa-medkit"></i> <span>Medicamentos</span> </i>
        </a>
      </li>
      <li>
        <a href="<?=base_url()?>tratamientosTerapeuta">
          <i class="fa fa-stethoscope "></i> <span>Tratamientos</span> </i>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-smile-o"></i> <span>Motivaciones</span> </i>
        </a>
      </li>




    </ul>
  </section>
  <!-- /.sidebar -->
</aside>