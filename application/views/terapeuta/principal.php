<!DOCTYPE html>

<html>
<?php $this->load->view('headers/header'); ?>
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
        Inicio
        <small>Terapeuta</small>
      </h1>
      <!-- breadcrums -->
        <ol class="breadcrumb">
          <li><a href="<?=base_url()?>principalTerapeuta"><i class="fa fa-home"></i> Inicio</a></li>
          
        </ol>
        <!-- Fin breadcrum -->
      </section>

      <!-- Main content -->
      
      <section class="content">
        <div class="row">
          <!-- Panel pacientes -->
          <div class="col-md-2 col-sm-6 col-md-offset-2">
            <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$num_pacientes?></h3>

              <p>Pacientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a href="<?=base_url()?>pacientesTerapeuta" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          </div>
          <!-- Fin panel pacientes -->
          <!-- Panel Medicamentos -->
          <div class="col-md-2 col-sm-6">
            <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$num_medicamentos?></h3>

              <p>Medicamentos</p>
            </div>
            <div class="icon">
              <i class="ion-medkit"></i>
            </div>
            <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          </div>
          <!-- Fin panel curiosidades -->
          <!-- Panel Tratamientos -->
          <div class="col-md-2 col-sm-6">
            <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$num_tratamientos?></h3>

              <p>Tratamientos</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          </div>
          <!-- Fin panel tratamientos -->
          <!-- Panel sintomas -->
          <div class="col-md-2 col-sm-6">
            <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$num_sintomas?></h3>

              <p>Sintomas</p>
            </div>
            <div class="icon">
              <i class="ion-ios-list-outline"></i>
            </div>
            <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          </div>
          <!-- Fin panel sintomas -->
        </div>
        <?php $this->load->view('alertas/alerta_mensaje'); ?>
        <div class="row">
          <br><br><br><br>
          <!-- Columna derecha -->
          <section class="col-md-12">
            <!-- Nuevo medicamento -->
            <div class="box box-success <?php if(!$this->session->mensajeMedicamento['error']) echo 'collapsed-box'?>">
            <div class="box-header">
              <i class="ion ion-medkit"></i>

              <h3 class="box-title">Nuevo Medicamento</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="<?php if(!$this->session->mensajeMedicamento['error']){ echo 'fa fa-plus';}else{echo 'fa fa-minus';}?>"></i></button>
              </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-offset-3 col-md-6">
                
                <?=form_open('principalTerapeuta/nuevoMedicamento');?>
                
                <!-- Nombre -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicamento){
                  if($this->session->mensajeMedicamento['error']){
                    if($this->session->mensajeMedicamento['msgNombre']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Nombre ', 'input_nombre')?>  
                  
                    <input type="text" id="input_nombre" name="nombre" class="form-control" autocomplete="off" <?php if($this->session->reEnvioMedicamento){echo 'value=' . $this->session->reEnvioMedicamento['nombre'];}else{ echo "placeholder= 'Nombre'";} ?>>
                <?php
                  if($this->session->mensajeMedicamento['msgNombre']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicamento['msgNombre'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin nombre -->
                
                <!-- Dosis -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicamento){
                  if($this->session->mensajeMedicamento['error']){
                    if($this->session->mensajeMedicamento['msgDosis']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Dosis (mg)', 'input_dosis')?>  
                  
                    <input type="text" id="input_dosis" name="dosis" class="form-control" autocomplete="off" <?php if($this->session->reEnvioMedicamento){echo 'value=' . $this->session->reEnvioMedicamento['dosis'];}else{ echo "placeholder= 'Dosis'";} ?>>
                <?php
                  if($this->session->mensajeMedicamento['msgDosis']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicamento['msgDosis'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin dosis -->
                
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <?php 
              $attributes = array(
                'class' => 'btn btn-success pull-left'
              );
              ?>
              <?=form_submit('nuevoMedicamento', 'Añadir medicamento', $attributes)?>
              <?=form_close()?>
            </div>
          </div>
          <?php $this->session->unset_userdata('mensajeMedicamento');
                $this->session->unset_userdata('mensaje'); 
                $this->session->unset_userdata('reEnvioMedicamento');?>
            <!-- Fin nuevo medicamento -->
            </section>
            <section class="col-md-6">
            <!-- Nuevo tratamiento -->
            <div class="box box-success <?php if(!$this->session->mensajeTratamiento['error']) echo 'collapsed-box'?>">
              <div class="box-header">
                <i class="ion ion-medkit"></i>
  
                <h3 class="box-title">Nuevo tratamiento</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="<?php if(!$this->session->mensajeTratamiento['error']){ echo 'fa fa-plus';}else{echo 'fa fa-minus';}?>"></i></button>
                </div>
  
              </div>
              <!-- /.box-header -->
              <div class="box-body"><div class="col-md-offset-3 col-md-6">
                  <?=form_open('principalTerapeuta/nuevoTratamiento');?>
                  <div class="form-group <?php 
                  if($this->session->mensajeTratamiento){ 
                    if($this->session->mensajeTratamiento['error']){
                      if($this->session->mensajeTratamiento['msgNombre']){
                        echo 'has-error';
                      }else{
                        echo 'has-success';
                      }
                    }
                  }
                  ?>
                  ">
                      <?=form_label('Nombre ', 'input_nombre')?>
                    
                      <input type="text" id="input_nombre" name="nombre" class="form-control" autocomplete="off" <?php if($this->session->reEnvioTratamiento){echo 'value=' . $this->session->reEnvioTratamiento['nombre'];}else{ echo "placeholder= 'Nombre'";} ?>>
                   <?php
                    if($this->session->mensajeTratamiento['msgNombre']){
                      echo '<span class="help-block">' . $this->session->mensajeTratamiento['msgNombre'] . '</span>';
                    }
                  ?>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix no-border">
                <?php 
                $attributes = array(
                  'class' => 'btn btn-success pull-left'
                );
                ?>
                <?=form_submit('nuevoTratamiento', 'Añadir tratamiento', $attributes)?>
                <?=form_close()?>
                </div>
            </div>
          <?php $this->session->unset_userdata('mensajeTratamiento');
                $this->session->unset_userdata('mensaje'); 
                $this->session->unset_userdata('reEnvioTratamiento');?>
            <!-- Fin nuevo tratamiento -->
            </section>
            <section class="col-md-6">
                        <!-- Nuevo sintoma -->
            <div class="box box-success <?php if(!$this->session->mensajeSintoma['error']) echo 'collapsed-box'?>">
            <div class="box-header">
              <i class="ion ion-ios-list-outline"></i>

              <h3 class="box-title">Nuevo síntoma</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="<?php if(!$this->session->mensajeSintoma['error']){ echo 'fa fa-plus';}else{echo 'fa fa-minus';}?>"></i></button>
              </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body"><div class="col-md-offset-3 col-md-6">
                  <?=form_open('principalTerapeuta/nuevoSintoma');?>
                  <div class="form-group <?php 
                  if($this->session->mensajeSintoma){ 
                    if($this->session->mensajeSintoma['error']){
                      if($this->session->mensajeSintoma['msgNombre']){
                        echo 'has-error';
                      }else{
                        echo 'has-success';
                      }
                    }
                  }
                  ?>
                  ">
                      <?=form_label('Nombre ', 'input_nombre')?>
                    
                      <input type="text" id="input_nombre" name="nombre" class="form-control" autocomplete="off" <?php if($this->session->reEnvioSintoma){echo 'value=' . $this->session->reEnvioSintoma['nombre'];}else{ echo "placeholder= 'Nombre'";} ?>>
                   <?php
                    if($this->session->mensajeSintoma['msgNombre']){
                      echo '<span class="help-block">' . $this->session->mensajeSintoma['msgNombre'] . '</span>';
                    }
                  ?>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix no-border">
                <?php 
                $attributes = array(
                  'class' => 'btn btn-success pull-left'
                );
                ?>
                <?=form_submit('nuevoSintoma', 'Añadir Síntoma', $attributes)?>
                <?=form_close()?>
                </div>
            </div>
          <?php $this->session->unset_userdata('mensajeSintoma');
                $this->session->unset_userdata('mensaje'); 
                $this->session->unset_userdata('reEnvioSintoma');?>
            <!-- Fin nuevo sintoma -->
            
          </section>
          <!-- Fin columna  -->
        </div>
        
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('footers/footer'); ?>

</body>

</html>
  