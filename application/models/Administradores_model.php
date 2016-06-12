<?php
class administradores_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function obtener_credenciales()
        {
                $this -> db -> select('*');
                $this -> db -> from('administrador');
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){

                        return $query->result();
                }else{
                        return false;
                }
        }

}
