<!DOCTYPE html>

<html>
<?php $this->load->view('headers/header'); ?>
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="../../plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="../../plugins/fullcalendar/fullcalendar.print.css" media="print">

<!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->

<body class="skin-green sidebar-mini">
  <div class="wrapper">

    <?php $this -> load -> view('menus/menu_principal'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        Pacientes
        <small>Terapeuta</small>
      </h1>
      <br><br>
      <!-- breadcrums -->
        <ol class="breadcrumb">
          <li><a href="<?=base_url()?>principal"><i class="fa fa-home"></i> Inicio</a></li>
          <li><a href="<?=base_url()?>pacientes"></a>Pacientes</li>
        </ol>
        <!-- Fin breadcrum -->
      </section>

      <!-- Main content -->
      <section class="content">
        <?php $this->load->view('alertas/alerta_mensaje'); ?>
        <div class="row">
          <div class="col-md-3">
          <div class="box box-success">
              <div class="box-header">
                  <h3 class="box-title">Mis pacientes</h3>
              </div>
              <div class="box-body">
                <table id="tabla_pacientes" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">Nombre </th>
                            <th class="column-title" style="display: table-cell;"></th>   
                            </tr>
                    </thead>
    
                    <tbody>
                        <tr class="even pointer">
                            <td class=" ">Paciente 1</td>
                            <td class="pull-left" id="oculto">
                              <?php
                                $id_paciente = 1;
                                if($this->session->paciente['id']){
                                  if($this->session->paciente['id'] == $id_paciente){
                              ?>
                                  <a href="pacientesTerapeuta/noVerPaciente" ><i class="fa fa-eye-slash"></i></a> 
                              
                              <?php
                                  }else{
                              ?>
                                  <a href="pacientesTerapeuta/noVerPaciente" ><i class="fa fa-eye"></i></a> 
                              <?php 
                                  }
                                }else{
                              ?>
                                  <a href="pacientesTerapeuta/verPaciente/<?=$id_paciente?>" ><i class="fa fa-eye"></i></a>
                              <?php
                                }
                              ?>
                              &nbsp;&nbsp;<a href="/HotelGest/hoteles/eliminarHotel/?id_hotel=1"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <div class="col-md-9">
            <div class="box box-success">
            <div class="box-header">
              <i class="ion ion-ios-person"></i>

              <h3 class="box-title">Paciente</h3>
              
            </div>
            
            <?php
                if($this->session->paciente['id']){
            ?>
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#detalles" data-toggle="tab">Detalles</a></li>
                    <li><a href="#medicacion" data-toggle="tab">Medicación</a></li>
                    <li><a href="#citas" data-toggle="tab">Citas médicas</a></li>
                    <li><a href="#seguimiento" data-toggle="tab">Seguimiento</a></li>
                    
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="detalles">
                      <div class="box box-success collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Datos personales</h3>
                            <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                        <p><strong>Nombre: </strong>&nbsp;&nbsp;<?=$detalles['nombre'];?></p>
                        <p><strong>Apellidos: </strong>&nbsp;&nbsp;<?=$detalles['apellidos'];?></p>
                        <p><strong>Dni: </strong>&nbsp;&nbsp;<?=$detalles['dni'];?></p>
                        <p><strong>Genero: </strong>&nbsp;&nbsp;<?=$detalles['genero'];?></p>
                        <p><strong>Fecha de nacimiento: </strong>&nbsp;&nbsp;<?=$detalles['fecha_nacimiento'];?></p>
                        <p><strong>Fecha de admisión: </strong>&nbsp;&nbsp;<?=$detalles['fecha_admision'];?></p>
                        
                        </div>
                      </div>
                      <div class="box box-success collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Datos de contacto</h3>
                            <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                        <p><strong>Dirección: </strong>&nbsp;&nbsp;<?=$detalles['direccion'];?></p>
                        <p><strong>Email: </strong>&nbsp;&nbsp;<?=$detalles['email'];?></p>
                        <p><strong>Teléfono: </strong>&nbsp;&nbsp;<?=$detalles['telefono'];?></p>
                        </div>
                      </div>
                      <a href="#" class="btn btn-success btn-block"><i class="fa fa-edit">&nbsp;&nbsp;Editar paciente</i></a>
                    </div>
                    <!-- /.tab-pane -->
                    
                    
                    <div class="tab-pane" id="medicacion">
                      
                       <!-- Acordeón medicamentos-->
                        <div class="box-group" id="accordion">
                          <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                          <div class="panel box box-success">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#lunes" aria-expanded="false" class="collapsed">
                                  Lunes
                                </a>
                              </h4>
                            </div>
                            <div id="lunes" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                              <div class="box-body table-responsive">
                                <table id="tabla_lunes" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                                  <thead>
                                      <tr class="headings">
                                          <th class="column-title" style="display: table-cell;">Nombre </th>
                                          <th class="column-title" style="display: table-cell;">Dosis</th>
                                          <th class="column-title" style="display: table-cell;">Hora</th>
                                          <th class="column-title" style="display: table-cell;">Toma</th>
                                          <th class="column-title" style="display: table-cell;">Posología</th>
                                          <th class="column-title" style="display: table-cell;"></th>
                                          </tr>
                                  </thead>
                                  <tfoot>
                                    <th class="column-title" style="display: table-cell;">Nombre </th>
                                      <th class="column-title" style="display: table-cell;">Dosis</th>
                                      <th class="column-title" style="display: table-cell;">Hora</th>
                                      <th class="column-title" style="display: table-cell;">Toma</th>
                                      <th class="column-title" style="display: table-cell;">Posología</th>
                                      <th class="column-title" id="oculto"></th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    
                                      <?php 
                                        $medicamentos = array();
                                        foreach($medicacion as $medicamento){
                                          if($medicamento['dia'] == LUNES){
                                              array_push($medicamentos, $medicamento);
                                          }
                                        }
                                        foreach($medicamentos as $medicamento){
                                      ?>
                                      <tr class="even pointer">
                                      <?php
                                      
                                          echo '<td>' . $medicamento['nombre'] . '</td>';
                                          echo '<td>' . $medicamento['dosis'] . '</td>';
                                          echo '<td>' . $medicamento['hora'] . '</td>';
                                          echo '<td>' . $medicamento['toma'] . '</td>';
                                          echo '<td>' . $medicamento['posologia'] . '</td>';
                                          echo '<td><a href="pacientesTerapeuta/verModificarMedicacion/' . $medicamento['id_medicacion'] . '" ><i class="fa fa-pencil-square-o"></i></a>
                                          <a href="pacientesTerapeuta/borrarMedicacion" ><i class="fa fa-trash"></i></a>
                                          </td>';
                                      ?>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="panel box box-success">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#martes" class="collapsed" aria-expanded="false">
                                  Martes
                                </a>
                              </h4>
                            </div>
                            <div id="martes" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                              <div class="box-body table-responsive">
                                <table id="tabla_martes" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                                  <thead>
                                      <tr class="headings">
                                          <th class="column-title" style="display: table-cell;">Nombre </th>
                                          <th class="column-title" style="display: table-cell;">Dosis</th>
                                          <th class="column-title" style="display: table-cell;">Hora</th>
                                          <th class="column-title" style="display: table-cell;">Toma</th>
                                          <th class="column-title" style="display: table-cell;">Posología</th>
                                          <th class="column-title" style="display: table-cell;"></th>
                                          </tr>
                                  </thead>
                                  <tfoot>
                                    <th class="column-title" style="display: table-cell;">Nombre </th>
                                      <th class="column-title" style="display: table-cell;">Dosis</th>
                                      <th class="column-title" style="display: table-cell;">Hora</th>
                                      <th class="column-title" style="display: table-cell;">Toma</th>
                                      <th class="column-title" style="display: table-cell;">Posología</th>
                                      <th class="column-title" id="oculto"></th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    
                                      <?php 
                                        $medicamentos = array();
                                        foreach($medicacion as $medicamento){
                                          if($medicamento['dia'] == MARTES){
                                              array_push($medicamentos, $medicamento);
                                          }
                                        }
                                        foreach($medicamentos as $medicamento){
                                      ?>
                                      <tr class="even pointer">
                                      <?php
                                      
                                          echo '<td>' . $medicamento['nombre'] . '</td>';
                                          echo '<td>' . $medicamento['dosis'] . '</td>';
                                          echo '<td>' . $medicamento['hora'] . '</td>';
                                          echo '<td>' . $medicamento['toma'] . '</td>';
                                          echo '<td>' . $medicamento['posologia'] . '</td>';
                                          echo '<td><a href="pacientesTerapeuta/verModificarMedicacion/' . $medicamento['id_medicacion'] . '" ><i class="fa fa-pencil-square-o"></i></a>
                                          <a href="pacientesTerapeuta/borrarMedicacion" ><i class="fa fa-trash"></i></a>
                                          </td>';
                                      ?>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="panel box box-success">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#miercoles" class="collapsed" aria-expanded="false">
                                  Miércoles
                                </a>
                              </h4>
                            </div>
                            <div id="miercoles" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                              <div class="box-body table-responsive">
                                <table id="tabla_miercoles" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                                  <thead>
                                      <tr class="headings">
                                          <th class="column-title" style="display: table-cell;">Nombre </th>
                                          <th class="column-title" style="display: table-cell;">Dosis</th>
                                          <th class="column-title" style="display: table-cell;">Hora</th>
                                          <th class="column-title" style="display: table-cell;">Toma</th>
                                          <th class="column-title" style="display: table-cell;">Posología</th>
                                          <th class="column-title" style="display: table-cell;"></th>
                                          </tr>
                                  </thead>
                                  <tfoot>
                                    <th class="column-title" style="display: table-cell;">Nombre </th>
                                      <th class="column-title" style="display: table-cell;">Dosis</th>
                                      <th class="column-title" style="display: table-cell;">Hora</th>
                                      <th class="column-title" style="display: table-cell;">Toma</th>
                                      <th class="column-title" style="display: table-cell;">Posología</th>
                                      <th class="column-title" id="oculto"></th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    
                                      <?php 
                                        $medicamentos = array();
                                        foreach($medicacion as $medicamento){
                                          if($medicamento['dia'] == MIERCOLES){
                                              array_push($medicamentos, $medicamento);
                                          }
                                        }
                                        foreach($medicamentos as $medicamento){
                                      ?>
                                      <tr class="even pointer">
                                      <?php
                                      
                                          echo '<td>' . $medicamento['nombre'] . '</td>';
                                          echo '<td>' . $medicamento['dosis'] . '</td>';
                                          echo '<td>' . $medicamento['hora'] . '</td>';
                                          echo '<td>' . $medicamento['toma'] . '</td>';
                                          echo '<td>' . $medicamento['posologia'] . '</td>';
                                          echo '<td><a href="pacientesTerapeuta/verModificarMedicacion/' . $medicamento['id_medicacion'] . '" ><i class="fa fa-pencil-square-o"></i></a>
                                          <a href="pacientesTerapeuta/borrarMedicacion" ><i class="fa fa-trash"></i></a>
                                          </td>';
                                      ?>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="panel box box-success">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#jueves" class="collapsed" aria-expanded="false">
                                  Jueves
                                </a>
                              </h4>
                            </div>
                            <div id="jueves" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                              <div class="box-body table-responsive">
                                <table id="tabla_jueves" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                                  <thead>
                                      <tr class="headings">
                                          <th class="column-title" style="display: table-cell;">Nombre </th>
                                          <th class="column-title" style="display: table-cell;">Dosis</th>
                                          <th class="column-title" style="display: table-cell;">Hora</th>
                                          <th class="column-title" style="display: table-cell;">Toma</th>
                                          <th class="column-title" style="display: table-cell;">Posología</th>
                                          <th class="column-title" style="display: table-cell;"></th>
                                          </tr>
                                  </thead>
                                  <tfoot>
                                    <th class="column-title" style="display: table-cell;">Nombre </th>
                                      <th class="column-title" style="display: table-cell;">Dosis</th>
                                      <th class="column-title" style="display: table-cell;">Hora</th>
                                      <th class="column-title" style="display: table-cell;">Toma</th>
                                      <th class="column-title" style="display: table-cell;">Posología</th>
                                      <th class="column-title" id="oculto"></th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    
                                      <?php 
                                        $medicamentos = array();
                                        foreach($medicacion as $medicamento){
                                          if($medicamento['dia'] == JUEVES){
                                              array_push($medicamentos, $medicamento);
                                          }
                                        }
                                        foreach($medicamentos as $medicamento){
                                      ?>
                                      <tr class="even pointer">
                                      <?php
                                      
                                          echo '<td>' . $medicamento['nombre'] . '</td>';
                                          echo '<td>' . $medicamento['dosis'] . '</td>';
                                          echo '<td>' . $medicamento['hora'] . '</td>';
                                          echo '<td>' . $medicamento['toma'] . '</td>';
                                          echo '<td>' . $medicamento['posologia'] . '</td>';
                                          echo '<td><a href="pacientesTerapeuta/verModificarMedicacion/' . $medicamento['id_medicacion'] . '" ><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="pacientesTerapeuta/borrarMedicacion" ><i class="fa fa-trash"></i></a>
                                            </td>';
                                      ?>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="panel box box-success">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#viernes" class="collapsed" aria-expanded="false">
                                  Viernes
                                </a>
                              </h4>
                            </div>
                            <div id="viernes" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                              <div class="box-body table-responsive">
                                <table id="tabla_viernes" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                                  <thead>
                                      <tr class="headings">
                                          <th class="column-title" style="display: table-cell;">Nombre </th>
                                          <th class="column-title" style="display: table-cell;">Dosis</th>
                                          <th class="column-title" style="display: table-cell;">Hora</th>
                                          <th class="column-title" style="display: table-cell;">Toma</th>
                                          <th class="column-title" style="display: table-cell;">Posología</th>
                                          <th class="column-title" style="display: table-cell;"></th>
                                          </tr>
                                  </thead>
                                  <tfoot>
                                    <th class="column-title" style="display: table-cell;">Nombre </th>
                                      <th class="column-title" style="display: table-cell;">Dosis</th>
                                      <th class="column-title" style="display: table-cell;">Hora</th>
                                      <th class="column-title" style="display: table-cell;">Toma</th>
                                      <th class="column-title" style="display: table-cell;">Posología</th>
                                      <th class="column-title" id="oculto"></th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    
                                      <?php 
                                        $medicamentos = array();
                                        foreach($medicacion as $medicamento){
                                          if($medicamento['dia'] == VIERNES){
                                              array_push($medicamentos, $medicamento);
                                          }
                                        }
                                        foreach($medicamentos as $medicamento){
                                      ?>
                                      <tr class="even pointer">
                                      <?php
                                      
                                          echo '<td>' . $medicamento['nombre'] . '</td>';
                                          echo '<td>' . $medicamento['dosis'] . '</td>';
                                          echo '<td>' . $medicamento['hora'] . '</td>';
                                          echo '<td>' . $medicamento['toma'] . '</td>';
                                          echo '<td>' . $medicamento['posologia'] . '</td>';
                                          echo '<td><a href="pacientesTerapeuta/verModificarMedicacion/' . $medicamento['id_medicacion'] . '" ><i class="fa fa-pencil-square-o"></i></a>
                                          <a href="pacientesTerapeuta/borrarMedicacion" ><i class="fa fa-trash"></i></a>
                                          </td>';
                                      ?>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="panel box box-success">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#sabado" class="collapsed" aria-expanded="false">
                                  Sábado
                                </a>
                              </h4>
                            </div>
                            <div id="sabado" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                              <div class="box-body table-responsive">
                                <table id="tabla_sabado" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                                  <thead>
                                      <tr class="headings">
                                          <th class="column-title" style="display: table-cell;">Nombre </th>
                                          <th class="column-title" style="display: table-cell;">Dosis</th>
                                          <th class="column-title" style="display: table-cell;">Hora</th>
                                          <th class="column-title" style="display: table-cell;">Toma</th>
                                          <th class="column-title" style="display: table-cell;">Posología</th>
                                          <th class="column-title" style="display: table-cell;"></th>
                                          </tr>
                                  </thead>
                                  <tfoot>
                                    <th class="column-title" style="display: table-cell;">Nombre </th>
                                      <th class="column-title" style="display: table-cell;">Dosis</th>
                                      <th class="column-title" style="display: table-cell;">Hora</th>
                                      <th class="column-title" style="display: table-cell;">Toma</th>
                                      <th class="column-title" style="display: table-cell;">Posología</th>
                                      <th class="column-title" id="oculto"></th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    
                                      <?php 
                                        $medicamentos = array();
                                        foreach($medicacion as $medicamento){
                                          if($medicamento['dia'] == SABADO){
                                              array_push($medicamentos, $medicamento);
                                          }
                                        }
                                        foreach($medicamentos as $medicamento){
                                      ?>
                                      <tr class="even pointer">
                                      <?php
                                      
                                          echo '<td>' . $medicamento['nombre'] . '</td>';
                                          echo '<td>' . $medicamento['dosis'] . '</td>';
                                          echo '<td>' . $medicamento['hora'] . '</td>';
                                          echo '<td>' . $medicamento['toma'] . '</td>';
                                          echo '<td>' . $medicamento['posologia'] . '</td>';
                                          echo '<td><a href="pacientesTerapeuta/verModificarMedicacion/' . $medicamento['id_medicacion'] . '" ><i class="fa fa-pencil-square-o"></i></a>
                                          <a href="pacientesTerapeuta/borrarMedicacion" ><i class="fa fa-trash"></i></a>
                                          </td>';
                                      
                                      ?>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="panel box box-success">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#domingo" class="collapsed" aria-expanded="false">
                                  Domingo
                                </a>
                              </h4>
                            </div>
                            <div id="domingo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                              <div class="box-body table-responsive">
                               <table id="tabla_domingo" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                                  <thead>
                                      <tr class="headings">
                                          <th class="column-title" style="display: table-cell;">Nombre </th>
                                          <th class="column-title" style="display: table-cell;">Dosis</th>
                                          <th class="column-title" style="display: table-cell;">Hora</th>
                                          <th class="column-title" style="display: table-cell;">Toma</th>
                                          <th class="column-title" style="display: table-cell;">Posología</th>
                                          <th class="column-title" style="display: table-cell;"></th>
                                          </tr>
                                  </thead>
                                  <tfoot>
                                    <th class="column-title" style="display: table-cell;">Nombre </th>
                                      <th class="column-title" style="display: table-cell;">Dosis</th>
                                      <th class="column-title" style="display: table-cell;">Hora</th>
                                      <th class="column-title" style="display: table-cell;">Toma</th>
                                      <th class="column-title" style="display: table-cell;">Posología</th>
                                      <th class="column-title" id="oculto"></th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                    
                                      <?php 
                                        $medicamentos = array();
                                        foreach($medicacion as $medicamento){
                                          if($medicamento['dia'] == DOMINGO){
                                              array_push($medicamentos, $medicamento);
                                          }
                                        }
                                        foreach($medicamentos as $medicamento){
                                      ?>
                                      <tr class="even pointer">
                                      <?php
                                      
                                          echo '<td>' . $medicamento['nombre'] . '</td>';
                                          echo '<td>' . $medicamento['dosis'] . '</td>';
                                          echo '<td>' . $medicamento['hora'] . '</td>';
                                          echo '<td>' . $medicamento['toma'] . '</td>';
                                          echo '<td>' . $medicamento['posologia'] . '</td>';
                                          echo '<td><a href="pacientesTerapeuta/verModificarMedicacion/' . $medicamento['id_medicacion'] . '" ><i class="fa fa-pencil-square-o"></i></a>
                                          <a href="pacientesTerapeuta/borrarMedicacion" ><i class="fa fa-trash"></i></a>
                                          </td>';
                                      ?>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                      <?php $this->session->unset_userdata('mensajeMedicacion');
                                        $this->session->unset_userdata('mensaje'); 
                                        $this->session->unset_userdata('reEnvioMedicacion');?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a href="pacientesTerapeuta/verNuevaMedicacion" class="btn btn-success btn-block"><i class="fa fa-plus-square">&nbsp;&nbsp;Nueva medicación</i></a>
                        <!-- Fin acordeón medicamentos-->
                    </div>
                    <!-- /.tab-pane -->
                    
                    
                    <div class="tab-pane" id="citas">
                      
                      <section class="content">
                        <div class="row">
                          <!-- /.col -->
                          <div class="col-md-12">
                            <div class="box box-success">
                              <div class="box-body no-padding">
                                
                                <!-- CALENDARIO -->
                                <div id="calendar"></div>
                              </div>
                              <br><br>

                              <a href="pacientesTerapeuta/verNuevoEvento" class="btn btn-success btn-block"><i class="fa fa-plus-square">&nbsp;&nbsp;Nueva cita médica</i></a>
                              <!-- Quitamos de la session cualquier evento almacenado -->
                              <?php 
                                if($this->session->evento){
                                  $this->session->unset_userdata('evento');
                                }
                              ?>
                              <!-- /.box-body -->
                            </div>
                            <!-- /. box -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </section>
                      
                    </div>
                    <!-- /.tab-pane -->
                    
                    
                    <div class="tab-pane" id="seguimiento">
                      seguimiento
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
            <?php
              }else{
            ?>
            
            <div class="col-md-offset-1 col-md-9">
              <br><br>
              <div class="callout callout-info" style="margin-bottom: 0!important;">
                <h4><i class="fa fa-info"></i> Información:</h4>
                No hay ningun paciente seleccionado, para ver un paciente pulse sobre el icono del ojo al lado de su nombre.
              </div>
              </div>
            <?php
              }
            ?>
            </div>
            
        </div>
        </div>
      </section>
       
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('footers/footer'); ?>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../plugins/fullcalendar/fullcalendar.min.js"></script>
    <?php $this->load->view('scripts/calendario'); ?>
    <?php $this->load->view('scripts/datatables_pacientes'); ?>
</body>

</html>
  