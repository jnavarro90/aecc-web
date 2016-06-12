<?php 
        if($this->session->mensaje){
          if($this->session->mensaje['error']){
            ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> <?=$this->session->mensaje['msgTitulo']?></h4>
                <?=$this->session->mensaje['msg']?>
              </div>
            <?php
          }else{
            ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> <?=$this->session->mensaje['msgTitulo']?></h4>
                <?=$this->session->mensaje['msg']?>
              </div>
            <?php
          }
        }
        ?>