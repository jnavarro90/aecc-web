<?php
class tratamientos_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                
        }

        public function obtener_nombres(){
                $this -> db -> select('*');
                $this -> db -> from('tratamiento');
                $query = $this -> db -> get();
        
                if($query -> num_rows() > 0){
        
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        public function obtener_nombres_colores(){
                $this -> db -> select('*');
                $this -> db -> from('color');
                $query = $this -> db -> get();
        
                if($query -> num_rows() > 0){
        
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        public function obtener_eventos($id_paciente=null, $id_tratamiento=null){
                
                $this->db->select('*');
                $this->db->from('registro_tratamiento');
                if($id_paciente != null){
                        $this->db->where('fk_paciente_regtratamiento', $id_paciente);
                }elseif($id_tratamiento != null){
                        $this->db->where('id_registro_tratamiento', $id_tratamiento);
                }
                $this -> db -> join('tratamiento', 'registro_tratamiento.fk_tratamiento_regtratamiento = tratamiento.id_tratamiento', 'inner');
                $this -> db -> join('color', 'registro_tratamiento.fk_color_regtratamiento = color.id_color', 'inner');
                
                $query = $this -> db -> get();

                if($query -> num_rows() > 0){
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        public function insertar_evento($evento){
                $this->db->trans_start();
                $this->db->insert('registro_tratamiento', $evento);
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE){
                        return false;
                }else{
                        return true;
                }
        }
         
        public function actualizar_evento($evento){
                $this->db->trans_start();
                $this->db->where('id_registro_tratamiento', $this->session->evento['id']);
                $this->db->update('registro_tratamiento', $evento);

                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE){
                        return false;
                }else{
                        return true;
                }
        } 
        
        public function insertar_tratamiento($tratamiento){
                $this->db->trans_start();
                $this->db->insert('tratamiento', $tratamiento);
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE){
                        return false;
                }else{
                        return true;
                }
        }
}
