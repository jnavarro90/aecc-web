<?php
class sintomas_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                
        }

        public function obtener_nombres(){
                $this -> db -> select('*');
                $this -> db -> from('sintoma');
                $query = $this -> db -> get();
        
                if($query -> num_rows() > 0){
        
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        public function insertar_sintoma($sintoma){
                $this->db->trans_start();
                $this->db->insert('sintoma', $sintoma);
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE){
                        return false;
                }else{
                        return true;
                }
        }
}
