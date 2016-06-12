<?php
class terapeutas_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                
        }

        public function obtener_credenciales($usuario, $password)
        {
                $this -> db -> select('*');
                $this -> db -> from('terapeuta');
                $this -> db -> where('nombre_usuario', $usuario);
                $query = $this -> db -> get();
        
                if($query -> num_rows() == 1){
        
                        return $query->result();
                }else{
                        return false;
                }
        }

        public function obtener_numero_clientes(){
                $this->db->select('*');
                $this->db->from('paciente');
                $this->db->where('fk_terapeuta_paciente', $this->session->id_terapeuta);
                $query = $this->db->get();
                return $query -> num_rows();
        }
        
        public function obtener_numero_sintomas(){
                $this->db->select('*');
                $this->db->from('sintoma');
                $query = $this->db->get();
                return $query -> num_rows();
        }
        
        public function obtener_numero_medicamentos(){
                $this->db->select('*');
                $this->db->from('medicamento');
                $query = $this->db->get();
                return $query -> num_rows();
        }
        
        public function obtener_numero_tratamientos(){
                $this->db->select('*');
                $this->db->from('tratamiento');
                $query = $this->db->get();
                return $query -> num_rows();
        }
        
        public function obtener_nombres_medicamentos(){
                $this->db->select('*');
                $this->db->from('medicamento');
                $query = $this->db->get();
                 if($query -> num_rows() > 0){
        
                        return $query->result();
                }else{
                        return false;
                }
        }

        public function obtener_datos_medicacion($id_medicacion){
                $this->db->select('*');
                $this->db->from('registro_medicacion');
                $this->db->where('id_registro_medicacion', $id_medicacion);
                $this -> db -> join('medicamento', 'registro_medicacion.fk_medicamento_regmedicacion = medicamento.id_medicamento', 'inner');
                
                $query = $this -> db -> get();

                if($query -> num_rows() > 0){
                        return $query->result();
                }else{
                        return false;
                }
                
        }
        
        public function comprobar_medicacion_valida($nombre, $tomas, $dias){
                $valido = true;
                foreach($dias as $dia){
	                foreach($tomas as $toma){
	                        $this-> db->select('*');
                                $this->db->from('registro_medicacion');
                                $this->db->where('fk_medicamento_regmedicacion', $nombre);
                                $this->db->where('dia', $dia);
                                $this->db->where('parte_dia', $toma);
                                $query = $this->db->get();
                                if($query -> num_rows() == 1){
                                        $valido = false;
                                }
	                }
	        }
	        return $valido;
	}
	
	public function comprobar_medicacion_actualizar_valida($nombre, $toma, $dia){
                $valido = true;
                $this-> db->select('*');
                $this->db->from('registro_medicacion');
                $this->db->where('fk_medicamento_regmedicacion', $nombre);
                $this->db->where('dia', $dia);
                $this->db->where('parte_dia', $toma);
                $this->db->where_not_in('id_registro_medicacion', $this->session->medicacion['id']);
                $query = $this->db->get();
                if($query -> num_rows() == 1){
                        $valido = false;
	        }
	        return $valido;
	}
        
        public function insertar_medicamento($medicamento){
                $this->db->trans_start();
                $this->db->insert('medicamento', $medicamento);
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
        
        public function insertar_medicacion($medicacion){
                $this->db->trans_start();
                $this->db->insert('registro_medicacion', $medicacion);
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE){
                        return false;
                }else{
                        return true;
                }
        }
        
        public function actualizar_medicacion($medicacion){
                $this->db->trans_start();
                $this->db->where('id_registro_medicacion', $this->session->medicacion['id']);
                $this->db->update('registro_medicacion', $medicacion);
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE){
                        return false;
                }else{
                        return true;
                }
        }
}
