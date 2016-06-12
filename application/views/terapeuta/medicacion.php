<!DOCTYPE html>

<html>
<?php $this->load->view('headers/header'); ?>
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
    <?php $tomas = array(false, false, false, false);?>
    <?php $dias = array(false, false, false, false, false, false, false);?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        <?php if(isset($medicacion)) echo 'Modificar '; else echo 'Nueva '?>
        Medicacion
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
                <i class="fa fa-medkit"></i>
                  <h3 class="box-title">Medicación</h3>
              </div>
              
              <?php 
                if(isset($medicacion)){
              ?>
              <!-- body para modificar medicacion -->
              <div class="box-body">
                <div class="col-md-offset-3 col-md-6">
                  <?=form_open('medicacionTerapeuta/modificarMedicacion');?>
                  <!-- Nombre -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgNombre']){
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
                        foreach($nombres_medicamentos as $nombre_medicamento){
                          echo "<option value=" . $nombre_medicamento['id'] . " ";
                          if($this->session->reEnvioMedicacion['nombre'] == $nombre_medicamento['id']){ 
                            echo "selected";
                          }elseif($medicacion['nombre'] == $nombre_medicamento['id']){
                            echo "selected";
                          }
                          echo ">" . $nombre_medicamento['nombre'] ."</option>";
                        }
                      ?>
                    </select> 
                <?php
                  if($this->session->mensajeMedicacion['msgNombre']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgNombre'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin nombre -->
                <!-- Dosis -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgDosis']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Dosis (mg)', 'input_dosis')?>  
                  
                    <input type="text" id="input_dosis" name="dosis" class="form-control" autocomplete="off" <?php if($this->session->reEnvioMedicacion){echo 'value=' . $this->session->reEnvioMedicacion['dosis'];}else{ echo 'value=' . $medicacion['dosis'];} ?>>
                <?php
                  if($this->session->mensajeMedicacion['msgDosis']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgDosis'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin dosis -->
                
                
                <!-- Toma -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgToma']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                  if($this->session->reEnvioMedicacion['toma']){
                          switch ($this->session->reEnvioMedicacion['toma']) {
                            case MANANA:
                              $tomas[MANANA] = true;
                              break;
                            case MEDIODIA:
                              $tomas[MEDIODIA] = true;
                              break;
                            case TARDE:
                              $tomas[TARDE] = true;
                              break;
                            case NOCHE:
                              $tomas[NOCHE] = true;
                              break;
                          }
                        
                      }
                }else{
                  switch ($medicacion['toma']) {
                            case MANANA:
                              $tomas[MANANA] = true;
                              break;
                            case MEDIODIA:
                              $tomas[MEDIODIA] = true;
                              break;
                            case TARDE:
                              $tomas[TARDE] = true;
                              break;
                            case NOCHE:
                              $tomas[NOCHE] = true;
                              break;
                          }
                }
                ?>
                ">
                  
                    <?=form_label('Toma ', 'input_toma')?>  
                    
                    <select class="form-control tomas"  name="toma">
                      <option <?php if($tomas[MANANA]){echo "selected";}?> value=<?=MANANA?>>Mañana</option>
                      <option <?php if($tomas[MEDIODIA]){echo "selected";}?> value=<?=MEDIODIA?>>Mediodia</option>
                      <option <?php if($tomas[TARDE]){echo "selected";}?> value=<?=TARDE?>>Tarde</option>
                      <option <?php if($tomas[NOCHE]){echo "selected";}?> value=<?=NOCHE?>>Noche</option>
                    </select> 
                    
                <?php
                  if($this->session->mensajeMedicacion['msgToma']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgToma'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin toma -->
                
                <!-- Día -->
                
                
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgDia']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                  if($this->session->reEnvioMedicacion){
                          echo 'siiii---------------------';
                          switch ($this->session->reEnvioMedicacion['dia']) {
                            case DOMINGO:
                              $dias[DOMINGO] = true;
                              break;
                            case LUNES:
                              $dias[LUNES] = true;
                              break;
                            case MARTES:
                              $dias[MARTES] = true;
                              break;
                            case MIERCOLES:
                              $dias[MIERCOLES] = true;
                              break;
                            case JUEVES:
                              $dias[JUEVES] = true;
                              break;
                            case VIERNES:
                              $dias[VIERNES] = true;
                              break;
                            case SABADO:
                              $dias[SABADO] = true;
                              break;
                          }
                      }
                }else{
                  switch ($medicacion['dia']) {
                            case DOMINGO:
                              $dias[DOMINGO] = true;
                              break;
                            case LUNES:
                              $dias[LUNES] = true;
                              break;
                            case MARTES:
                              $dias[MARTES] = true;
                              break;
                            case MIERCOLES:
                              $dias[MIERCOLES] = true;
                              break;
                            case JUEVES:
                              $dias[JUEVES] = true;
                              break;
                            case VIERNES:
                              $dias[VIERNES] = true;
                              break;
                            case SABADO:
                              $dias[SABADO] = true;
                              break;
                          }
                }
                ?>
                ">
                  
                    <?=form_label('Día ', 'input_dia')?>  
                    <select class="form-control dias" name="dia">

                      <option <?php if($dias[LUNES]){echo "selected";}?> value=<?=LUNES?>>Lunes</option>
                      <option <?php if($dias[MARTES]){echo "selected";}?> value=<?=MARTES?>>Martes</option>
                      <option <?php if($dias[MIERCOLES]){echo "selected";}?> value=<?=MIERCOLES?>>Miércoles</option>
                      <option <?php if($dias[JUEVES]){echo "selected";}?> value=<?=JUEVES?>>Jueves</option>
                      <option <?php if($dias[VIERNES]){echo "selected";}?> value=<?=VIERNES?>>Viernes</option>
                      <option <?php if($dias[SABADO]){echo "selected";}?> value=<?=SABADO?>>Sábado</option>
                      <option <?php if($dias[DOMINGO]){echo "selected";}?> value=<?=DOMINGO?>>Domingo</option>
                    </select> 
                    
                <?php
                  if($this->session->mensajeMedicacion['msgDia']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgDia'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin día -->
                
                <!-- Posologia -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgPosologia']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                      
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Posología ', 'input_posologia')?>  
                    <textarea type="text" id="input_posologia" name="posologia" style="resize:vertical ;" class="form-control" autocomplete="off" <?php if(!$this->session->reEnvioMedicacion){ echo "placeholder= 'Posologia'";} ?>><?php if($this->session->reEnvioMedicacion){echo $this->session->reEnvioMedicacion['posologia'];}else{echo $medicacion['posologia'];} ?></textarea>
                <?php
                  if($this->session->mensajeMedicacion['msgPosologia']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgPosologia'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin posologia -->
                </div>
                </div>
                <!-- Fin body para modificar medicacion -->
              <?php
                } else {
              ?>
              
              <!-- body para nueva medicacion -->
              <div class="box-body">
                <div class="col-md-offset-3 col-md-6">
                  <?=form_open('medicacionTerapeuta/nuevaMedicacion');?>
                  <!-- Nombre -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgNombre']){
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
                        foreach($nombres_medicamentos as $nombre_medicamento){
                          echo "<option value=" . $nombre_medicamento['id'] . " ";
                          if($this->session->reEnvioMedicacion['nombre'] == $nombre_medicamento['id']) echo "selected";
                          echo ">" . $nombre_medicamento['nombre'] ."</option>";
                        }
                      ?>
                    </select> 
                <?php
                  if($this->session->mensajeMedicacion['msgNombre']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgNombre'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin nombre -->
                <!-- Dosis -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgDosis']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Dosis (mg)', 'input_dosis')?>  
                  
                    <input type="text" id="input_dosis" name="dosis" class="form-control" autocomplete="off" <?php if($this->session->reEnvioMedicacion){echo ' value=' . $this->session->reEnvioMedicacion['dosis'];}else{ echo "placeholder= 'Dosis'";} ?>>
                <?php
                  if($this->session->mensajeMedicacion['msgDosis']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgDosis'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin dosis -->
                
                
                <!-- Toma -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgToma']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                      if($this->session->reEnvioMedicacion['toma']){
                        foreach($this->session->reEnvioMedicacion['toma'] as $toma){
                          switch ($toma) {
                            case MANANA:
                              $tomas[MANANA] = true;
                              break;
                            case MEDIODIA:
                              $tomas[MEDIODIA] = true;
                              break;
                            case TARDE:
                              $tomas[TARDE] = true;
                              break;
                            case NOCHE:
                              $tomas[NOCHE] = true;
                              break;
                            
                          }
                        }
                      }
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Toma ', 'input_toma')?>  
                    
                    <select class="form-control tomas" multiple name="toma[]">
                      <option <?php if($tomas[MANANA]){echo "selected";}?> value=<?=MANANA?>>Mañana</option>
                      <option <?php if($tomas[MEDIODIA]){echo "selected";}?> value=<?=MEDIODIA?>>Mediodia</option>
                      <option <?php if($tomas[TARDE]){echo "selected";}?> value=<?=TARDE?>>Tarde</option>
                      <option <?php if($tomas[NOCHE]){echo "selected";}?> value=<?=NOCHE?>>Noche</option>
                    </select> 
                    
                <?php
                  if($this->session->mensajeMedicacion['msgToma']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgToma'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin toma -->
                
                <!-- Día -->
                
                
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgDia']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                      if($this->session->reEnvioMedicacion['dia']){
                        foreach($this->session->reEnvioMedicacion['dia'] as $dia){
                          switch ($dia) {
                            case DOMINGO:
                              $dias[DOMINGO] = true;
                              break;
                            case LUNES:
                              $dias[LUNES] = true;
                              break;
                            case MARTES:
                              $dias[MARTES] = true;
                              break;
                            case MIERCOLES:
                              $dias[MIERCOLES] = true;
                              break;
                            case JUEVES:
                              $dias[JUEVES] = true;
                              break;
                            case VIERNES:
                              $dias[VIERNES] = true;
                              break;
                            case SABADO:
                              $dias[SABADO] = true;
                              break;
                          }
                        }
                      }
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Día ', 'input_dia')?>  
                    <select class="form-control dias" multiple name="dia[]">

                      <option <?php if($dias[LUNES]){echo "selected";}?> value=<?=LUNES?>>Lunes</option>
                      <option <?php if($dias[MARTES]){echo "selected";}?> value=<?=MARTES?>>Martes</option>
                      <option <?php if($dias[MIERCOLES]){echo "selected";}?> value=<?=MIERCOLES?>>Miércoles</option>
                      <option <?php if($dias[JUEVES]){echo "selected";}?> value=<?=JUEVES?>>Jueves</option>
                      <option <?php if($dias[VIERNES]){echo "selected";}?> value=<?=VIERNES?>>Viernes</option>
                      <option <?php if($dias[SABADO]){echo "selected";}?> value=<?=SABADO?>>Sábado</option>
                      <option <?php if($dias[DOMINGO]){echo "selected";}?> value=<?=DOMINGO?>>Domingo</option>
                    </select> 
                    
                <?php
                  if($this->session->mensajeMedicacion['msgDia']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgDia'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin día -->
                
                <!-- Posologia -->
                <div class="form-group <?php 
                if($this->session->mensajeMedicacion){
                  if($this->session->mensajeMedicacion['error']){
                    if($this->session->mensajeMedicacion['msgPosologia']){
                      echo 'has-error';
                    }else{
                      echo 'has-success';
                      
                    }
                  }
                }
                ?>
                ">
                  
                    <?=form_label('Posología ', 'input_posologia')?>  
                    <textarea type="text" id="input_posologia" name="posologia" style="resize:vertical ;" class="form-control" autocomplete="off" <?php if(!$this->session->reEnvioMedicacion){ echo "placeholder= 'Posologia'";} ?>><?php if($this->session->reEnvioMedicacion){echo $this->session->reEnvioMedicacion['posologia'];} ?></textarea>
                <?php
                  if($this->session->mensajeMedicacion['msgPosologia']){
                    echo '<span class="help-block">' . $this->session->mensajeMedicacion['msgPosologia'] . '</span>';
                  }
                ?>
                </div>
                
                <!-- Fin posologia -->
                </div>
                </div>
                <!-- Fin body para nueva medicacion -->
                <?php 
                  }
                ?>
                <div class="box-footer clearfix no-border">
              <?php 
              $attributes = array(
                'class' => 'btn btn-success pull-left'
              );
              ?>
              <?php
                if(isset($medicacion)){
                  echo form_submit('modificarMedicacion', 'Modicficar Medicación', $attributes);
                }else{
                  echo form_submit('nuevaMedicacion', 'Nueva Medicación', $attributes); 
                }
              
              ?>
              <?=form_close()?>
            </div>
          

          <?php $this->session->unset_userdata('mensajeMedicacion');
                $this->session->unset_userdata('mensaje'); 
                $this->session->unset_userdata('reEnvioMedicacion');?>
            <!-- Fin nueva medicacion -->

        </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('footers/footer'); ?>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- Page script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".tomas").select2({
          placeholder: "Selecciona una o más tomas"
        });
        $(".dias").select2({
          placeholder: "Selecciona uno o más dias",
        });
        $(".nombre").select2({
          placeholder: "Selecciona un medicamento",
          allowClear: true
        });
      });
    </script>
</body>

</html>
  