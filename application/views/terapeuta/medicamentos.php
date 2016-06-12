<!DOCTYPE html>

<html>
<?php $this->load->view('headers/header'); ?>
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
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
        Medicamentos
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
      <div class="row">
        <section class="col-md-12">
          <?php $this->load->view('alertas/alerta_mensaje'); ?>
            <div class="col-md-offset-2 col-md-8">
                <div class="box box-success">
                    <div class="box-body">
                        
                              <div class="box-body table-responsive">
                                <table id="tabla" class="table table-hover dataTable dt-responsive nowrap no-footer dtr-inline" role="grid">
                                  <thead>
                                      <tr class="headings">
                                          <th class="column-title" style="display: table-cell;">Nombre </th>
                                          <th class="column-title" style="display: table-cell;">Dosis </th>
                                          <th class="column-title" style="display: table-cell;"></th>
                                          </tr>
                                  </thead>
                                  <tfoot>
                                    <th class="column-title" style="display: table-cell;">Nombre </th>
                                    <th class="column-title" style="display: table-cell;">Dosis </th>
                                      <th class="column-title" id="oculto"></th>
                                    </tr>
                                  <tbody>
                                    
                                      <?php 
                                        foreach($medicamentos as $medicamento){
                                      ?>
                                      <tr class="even pointer">
                                      <?php
                                      
                                          echo '<td>' . $medicamento['nombre'] . '</td>';
                                          echo '<td>' . $medicamento['dosis'] . '</td>';
                                          echo '<td><a href="pacientesTerapeuta/borrarMedicacion/' . $medicamento['id'] . '" ><i class="fa fa-trash"></i></a></td>';
                                      ?>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                  </tbody>
                                </table>
                        </div>
                    
                    <br><br>
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
                
                <?=form_open('medicamentosTerapeuta/nuevoMedicamento');?>
                
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
                    </div>
                </div>
                </div>
        </section>
        </div>
      <!-- /.content -->
      
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('footers/footer'); ?>
        <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">

    $(document).ready(function () {
  
    $('#tabla tfoot th').each(function () {
                    if (this.id != 'oculto') {
                        var title = $(this).text();
                        $(this).html('<input type="text" placeholder="Buscar por ' + title + '" />');
                    }
                });
    var tabla = $('#tabla').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        responsive: true
    });

    tabla.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                        .search(this.value)
                        .draw();
            }
        });
        });
    });
    </script>
</body>

</html>
  