<!DOCTYPE html>

<html>
<?php $this->load->view('headers/header'); ?>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/select2.min.css">
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
        Evento
        <small>Terapeuta</small>
        
      </h1>
      <!-- breadcrums -->
        <ol class="breadcrumb">
          <li><a href="<?=base_url()?>principalTerapeuta"><i class="fa fa-home"></i> Inicio</a></li>
          
        </ol>
        <!-- Fin breadcrum -->
      </section>
      <br><br>
      
      <!-- Main content -->
        <section class="col-md-12">
                
          <?php $this->load->view('alertas/alerta_mensaje'); ?>
          <div class="box box-success">
              <div class="box-header">
                <i class="fa fa-calendar"></i>
                  <h3 class="box-title">Evento</h3>
              </div>

              <!-- body para nuevo evento -->
              <div class="box-body">
                <div class="col-md-offset-3 col-md-6">
                  <?php
                  if(isset($evento)){
                    echo form_open('eventosTerapeuta/modificarEvento');
                  }else{
                    echo form_open('eventosTerapeuta/nuevoEvento');
                  }
                  ?>
                  
                  <!-- Nombre -->
                <div class="form-group <?php 
                if($this->session->mensajeEvento){
                  if($this->session->mensajeEvento['error']){
                    if($this->session->mensajeEvento['msgNombre']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                  <?=form_label('Nombre ', 'input_nombre')?>
                  <select class="form-control nombre"  name="nombre" placeholder = 'Nombre'>
                    <option></option>
                      <?php 
                        foreach($nombres_tratamientos as $nombre_tratamiento){
                          echo "<option value=" . $nombre_tratamiento['id'] . " ";
                          if($this->session->reEnvioEvento['nombre'] == $nombre_tratamiento['id']){ 
                            echo "selected";
                          }elseif(isset($evento)){
                            if($evento['nombre'] == $nombre_tratamiento['id']){
                              echo "selected";
                            }
                          }
                          echo ">" . $nombre_tratamiento['nombre'] ."</option>";
                        }
                      ?>
                    </select> 
                <?php
                  if($this->session->mensajeEvento['msgNombre']){
                    echo '<span class="help-block">' . $this->session->mensajeEvento['msgNombre'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin nombre -->
                
                <!-- Fecha -->
                <div class="form-group <?php 
                if($this->session->mensajeEvento){
                  if($this->session->mensajeEvento['error']){
                    if($this->session->mensajeEvento['msgFecha']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                  <?=form_label('Fecha ', 'input_fecha')?>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="fecha" class="form-control" id="fecha" <?php if($this->session->reEnvioEvento['fecha']){ echo "value=" . $this->session->reEnvioEvento['fecha'];}elseif(isset($evento)){echo "value=" . $evento['fecha'];} ?>>
                  </div>
                <?php
                  if($this->session->mensajeEvento['msgFecha']){
                    echo '<span class="help-block">' . $this->session->mensajeEvento['msgFecha'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin fecha -->
                
                <!-- Hora inicio -->
                <div class="form-group <?php 
                if($this->session->mensajeEvento){
                  if($this->session->mensajeEvento['error']){
                    if($this->session->mensajeEvento['msgHoraInicio']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                  <?=form_label('Hora inicio ', 'input_hora_inicio')?>
                  <div class="input-group bootstrap-timepicker timepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" name="horaInicio" class="form-control" id="hora_inicio" <?php if($this->session->reEnvioEvento['horaInicio']){ echo "value=" . $this->session->reEnvioEvento['horaInicio'];}elseif(isset($evento)){echo "value=" . $evento['horaInicio'];}?>>
                  </div>
                <?php
                  if($this->session->mensajeEvento['msgHoraInicio']){
                    echo '<span class="help-block">' . $this->session->mensajeEvento['msgHoraInicio'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin hora inicio -->
                
                <!-- Color -->
                <div class="form-group <?php 
                if($this->session->mensajeEvento){
                  if($this->session->mensajeEvento['error']){
                    if($this->session->mensajeEvento['msgColor']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                  <?=form_label('Color ', 'input_color')?>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-tint"></i>
                    </div>
                  <select class="form-control color"  name="color" placeholder = 'Color'>
                    
                    <option></option>
                      <?php 
                        foreach($nombres_colores as $nombre_color){
                          echo "<option value=" . $nombre_color['id'] . " ";
                          if($this->session->reEnvioEvento['color'] == $nombre_color['id']){ 
                            echo "selected";
                          }elseif(isset($evento)){
                            if($evento['color'] == $nombre_color['id']){
                            echo "selected";
                            }
                          }
                          echo ">" . $nombre_color['nombre'] ."</option>";
                        }
                      ?>
                    </select> 
                    </div>
                <?php
                  if($this->session->mensajeEvento['msgColor']){
                    echo '<span class="help-block">' . $this->session->mensajeEvento['msgColor'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin color -->
                
                <!-- Observaciones -->
                <div class="form-group <?php 
                if($this->session->mensajeEvento){
                  if($this->session->mensajeEvento['error']){
                    if($this->session->mensajeEvento['msgObservaciones']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                  <?=form_label('Observaciones ', 'input_observaciones')?>
                  <textarea type="text" id="input_observaciones" name="observaciones" style="resize:vertical ;" class="form-control" autocomplete="off" <?php if(!$this->session->reEnvioEvento){ echo "placeholder= 'Observaciones'";} ?>><?php if($this->session->reEnvioEvento){echo $this->session->reEnvioEvento['observaciones'];}elseif(isset($evento)){echo $evento['observaciones'];} ?></textarea>
                <?php
                  if($this->session->mensajeEvento['msgObservaciones']){
                    echo '<span class="help-block">' . $this->session->mensajeEvento['msgObservaciones'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin observaciones -->
               
                </div>
                </div>
                <!-- Fin body para nuevo evento -->

                <div class="box-footer clearfix no-border">
              <?php 
              $attributes = array(
                'class' => 'btn btn-success pull-left'
              );
              ?>
              <?php
                if(isset($evento)){
                  echo form_submit('modificarEvento', 'Modificar cita médica', $attributes);
                }else{
                  echo form_submit('nuevoEvento', 'Nueva cita médica', $attributes); 
                }
              
              ?>
              <?=form_close()?>
            </div>
          

          <?php $this->session->unset_userdata('mensajeEvento');
                $this->session->unset_userdata('mensaje'); 
                $this->session->unset_userdata('reEnvioEvento');?>
            <!-- Fin nuevo evento -->

        </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('footers/footer'); ?>
    <!-- bootstrap datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script>
    $(function () {
      //Date picker
      $('#fecha').datepicker({
        autoclose: true,
        startDate: '+1d'
      });
      //Timepicker
      $('#hora_inicio').timepicker({
        showMeridian: false
      });
      //select2
      $(".nombre").select2({
        placeholder: "Selecciona un tratamiento"
      });
      //select2
      $(".color").select2({
        placeholder: "Selecciona un color"
      });
    });
    </script>
</body>

</html>
  