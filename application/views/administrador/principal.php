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

    <?php $this -> load -> view('menus/menu_principal_admin'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        Inicio
        <small>Administrador</small>
      </h1>
      <!-- breadcrums -->
        <ol class="breadcrumb">
          <li><a href="<?=base_url()?>principalTerapeuta"><i class="fa fa-home"></i> Inicio</a></li>
          
        </ol>
        <!-- Fin breadcrum -->
      </section>

      <!-- Main content -->
      
      <section class="content">
        
        <?php $this->load->view('alertas/alerta_mensaje'); ?>
        <div class="row">
          <br><br><br><br>
          <!-- Columna derecha -->
          <section class="col-md-12">
            <!-- Nuevo paciente -->
            <div class="box box-success <?php if(!$this->session->mensajePaciente['error']) echo 'collapsed-box'?>">
            <div class="box-header">
              <i class="ion ion-person"></i>

              <h3 class="box-title">Nuevo Paciente</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="<?php if(!$this->session->mensajePaciente['error']){ echo 'fa fa-plus';}else{echo 'fa fa-minus';}?>"></i></button>
              </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body"><div class="col-md-offset-3 col-md-6">
                
                <?=form_open('principalAdministrador/nuevoPaciente');?>
                
                <!-- Nombre -->
                <div class="form-group <?php 
                if($this->session->mensajePaciente){
                  if($this->session->mensajePaciente['error']){
                    if($this->session->mensajePaciente['msgNombre']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Nombre ', 'input_nombre')?>  
                  
                    <input type="text" id="input_nombre" name="nombre" class="form-control" autocomplete="off" <?php if($this->session->reEnvioPaciente){echo 'value=' . $this->session->reEnvioPaciente['nombre'];}else{ echo "placeholder= 'Nombre'";} ?>>
                <?php
                  if($this->session->mensajePaciente['msgNombre']){
                    echo '<span class="help-block">' . $this->session->mensajePaciente['msgNombre'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin nombre -->
                <!-- Apellido1 -->
                
                <div class="form-group <?php 
                if($this->session->mensajePaciente){ 
                  if($this->session->mensajePaciente['error']){
                    if($this->session->mensajePaciente['msgApellido1']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Primer apellido ', 'input_apellido1')?>  
                  
                    <input type="text" id="input_apellido1" name="apellido1" class="form-control" autocomplete="off" <?php if($this->session->reEnvioPaciente){echo 'value=' . $this->session->reEnvioPaciente['apellido1'];}else{ echo "placeholder= 'Primer Apellido'";} ?>> 
                    <?php
                  if($this->session->mensajePaciente['msgApellido1']){
                    echo '<span class="help-block">' . $this->session->mensajePaciente['msgApellido1'] . '</span>';
                  }
                ?>
              
                </div>
                
                <!-- Fin apellido1 -->
                <!-- Apellido2 -->
                <div class="form-group <?php 
                if($this->session->mensajePaciente){ 
                  if($this->session->mensajePaciente['error']){
                    if($this->session->mensajePaciente['msgApellido2']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                    <?=form_label('Segundo apellido ', 'input_apellido2')?>  
                  
                    <input type="text" id="input_apellido2" name="apellido2" class="form-control" autocomplete="off" <?php if($this->session->reEnvioPaciente){echo 'value=' . $this->session->reEnvioPaciente['apellido2'];}else{ echo "placeholder= 'Segundo apellido'";} ?>>  
                    
                    <?php
                  if($this->session->mensajePaciente['msgApellido2']){
                    echo '<span class="help-block">' . $this->session->mensajePaciente['msgApellido2'] . '</span>';
                  }
                ?>
                 
                </div>
                <!-- Fin apellido2 -->
                <!-- Nombre usuario -->
                <div class="form-group <?php 
                if($this->session->mensajePaciente){ 
                  if($this->session->mensajePaciente['error']){
                    if($this->session->mensajePaciente['msgNombreUsuario']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                    <?=form_label('Nombre de usuario ', 'input_nombre_usuario')?>  
                  
                    <input type="text" id="input_nombre_usuario" name="nombre_usuario" class="form-control" autocomplete="off" <?php if($this->session->reEnvioPaciente){echo 'value=' . $this->session->reEnvioPaciente['nombre_usuario'];}else{ echo "placeholder= 'Nombre de usuario'";} ?>>
                    <?php
                  if($this->session->mensajePaciente['msgNombreUsuario']){
                    echo '<span class="help-block">' . $this->session->mensajePaciente['msgNombreUsuario'] . '</span>';
                  }
                ?>
                 
                </div>
                <!-- Fin nombre usuario -->
                <!-- Contraseña -->
                <?php 
                $atributos = array(
                  'class' => 'form-control',
                  'placeholder' => 'password',
                  'id' => 'input_password'
                  );
                ?>
                <div class="form-group <?php 
                if($this->session->mensajePaciente){ 
                  if($this->session->mensajePaciente['error']){
                    if($this->session->mensajePaciente['msgPassword']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                    <?=form_label('Contraseña ', 'input_password')?>  
                  
                    <?=form_password('password', '',$atributos)?>  
                 <?php
                  if($this->session->mensajePaciente['msgPassword']){
                    echo '<span class="help-block">' . $this->session->mensajePaciente['msgPassword'] . '</span>';
                  }
                ?>
                </div>
                <!-- Fin contraseña -->
                <!-- Repetir contraseña -->
                 <?php 
                $atributos = array(
                  'class' => 'form-control',
                  'placeholder' => 'repassword',
                  'id' => 'inputre_password'
                  );
                ?>
                <div class="form-group <?php 
                if($this->session->mensajePaciente){ 
                  if($this->session->mensajePaciente['error']){
                    if($this->session->mensajePaciente['msgRePassword']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                    <?=form_label('Repetir contraseña ', 'input_repassword')?>  
                  
                    <?=form_password('repassword', '',$atributos)?>  
                 <?php
                  if($this->session->mensajePaciente['msgRePassword']){
                    echo '<span class="help-block">' . $this->session->mensajePaciente['msgRePassword'] . '</span>';
                  }
                ?>
                </div>
                <!-- Fin repetir contraseña -->
                <!-- Correo electronico -->
                <div class="form-group <?php 
                  if($this->session->mensajePaciente){ 
                    if($this->session->mensajePaciente['error']){
                      if($this->session->mensajePaciente['msgEmail']){
                        echo 'has-error';
                      }else{
                        echo 'has-success';
                      }
                    }
                  }
                ?>
                ">
                    <?=form_label('Correo electronico ', 'input_email')?>  
                  
                    <input type="text" id="input_email" name="email" class="form-control" autocomplete="off" <?php if($this->session->reEnvioPaciente){echo 'value=' . $this->session->reEnvioPaciente['email'];}else{ echo "placeholder= 'Correo electrónico'";} ?>>
                 <?php
                  if($this->session->mensajePaciente['msgEmail']){
                    echo '<span class="help-block">' . $this->session->mensajePaciente['msgEmail'] . '</span>';
                  }
                ?>
                </div>
                <!-- Fin correo electronico -->
                <!-- Dni -->
                <div class="form-group <?php 
                if($this->session->mensajePaciente){ 
                  if($this->session->mensajePaciente['error']){
                    if($this->session->mensajePaciente['msgDni']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                    <?=form_label('Dni ', 'input_dni')?>  
                  
                    <input type="text" id="input_dni" name="dni" class="form-control" autocomplete="off" <?php if($this->session->reEnvioPaciente){echo 'value=' . $this->session->reEnvioPaciente['dni'];}else{ echo "placeholder= 'Dni'";} ?>>
                 <?php
                  if($this->session->mensajePaciente['msgDni']){
                    echo '<span class="help-block">' . $this->session->mensajePaciente['msgDni'] . '</span>';
                  }
                ?>
                </div>
                <!-- Fin dni -->
               </div>
                
                
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <?php 
              $attributes = array(
                'class' => 'btn btn-success pull-left'
              );
              ?>
              <?=form_submit('nuevoPaciente', 'Añadir Paciente', $attributes)?>
              <?=form_close()?>
            </div>
          </div>
          <?php $this->session->unset_userdata('mensajePaciente');
                $this->session->unset_userdata('mensaje'); 
                $this->session->unset_userdata('reEnvioPaciente');?>
            <!-- Fin nuevo paciente -->
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
  