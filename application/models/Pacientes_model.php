<?php
class pacientes_model extends CI_Model {
        
        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function obtener_credenciales($nombre, $password){
                $this -> db -> select('*');
                $this -> db -> from('paciente');
                $this -> db -> where('nombre_usuario', $nombre);
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){

                        return $query->result();
                }else{
                        return false;
                }
        }
        
        public function obtener_detalles($id_paciente){
                $this -> db -> select('*');
                $this -> db -> from('paciente');
                $this -> db -> where('id_paciente', $id_paciente);
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){

                        return $query->result();
                }else{
                        return false;
                }
        }
        
        public function obtenerMedicacion($id_paciente){
                $this->db->select('*');
                $this->db->from('registro_medicacion');
                $this->db->where('fk_paciente_regmedicacion', $id_paciente);
                $this -> db -> join('medicamento', 'registro_medicacion.fk_medicamento_regmedicacion = medicamento.id_medicamento', 'inner');
                
                $query = $this -> db -> get();

                if($query -> num_rows() > 0){
                        return $query->result();
                }else{
                        return false;
                }
                
        }
        
        public function encuestas_hoy($id_paciente){
                $hoy = date("Y-m-d");
                $query = $this -> db -> where('fecha', $hoy) -> where('fk_paciente_regencuesta', $id_paciente) -> get('registro_encuesta');
                return $query -> num_rows();
        }
        
        public function obtener_sintomas(){
                $this -> db -> select('nombre');
                $this -> db -> from('sintoma');
                $query = $this -> db -> get();
        
                if($query -> num_rows() > 0){
        
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        public function eventos($id_paciente){
                $this -> db -> select('*');
                $this -> db -> from('registro_tratamiento');
                $this -> db -> join('tratamiento', 'registro_tratamiento.fk_tratamiento_regtratamiento = tratamiento.id_tratamiento', 'inner');
                $this -> db -> join('color', 'registro_tratamiento.fk_color_regtratamiento = color.id_color', 'inner');
                $this -> db -> where('fk_paciente_regtratamiento', $id_paciente);
                $query = $this -> db -> get();

                if($query -> num_rows() > 0){
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        public function medicacion($id_paciente, $dia, $parte_dia){
                $this -> db -> select('*');
                $this -> db -> from('registro_medicacion');
                $this -> db -> join('medicamento', 'registro_medicacion.fk_medicamento_regmedicacion = medicamento.id_medicamento', 'inner');
                $this -> db -> where('fk_paciente_regmedicacion', $id_paciente);
                $this -> db -> where('dia', $dia);
                $this -> db -> where('parte_dia', $parte_dia);
                $query = $this -> db -> get();

                if($query -> num_rows() > 0){

                        return $query->result();
                }else{
                        return false;
                }
        }
        
        //Registro de las enceustas
        
        function registrar_encuesta($registro_encuesta){
                $this -> db -> insert('registro_encuesta', $registro_encuesta); 
        }
        
        function registrar_animo($registro_animo){
                $this -> db -> insert('registro_animo', $registro_animo); 
        }
        
        function registrar_sintoma($registro_sintoma){
                $this -> db -> insert('registro_sintoma', $registro_sintoma); 
        }
        
        function registrar_actividad($registro_actividad){
                $this -> db -> insert('registro_actividad', $registro_actividad); 
        }
        
        function registrar_dolor($registro_dolor){
                $this -> db -> insert('registro_dolor', $registro_dolor); 
        }
        
        function registrar_sleep($registro_sleep){
                $this -> db -> insert('registro_sleep', $registro_sleep); 
        }
        
        function registrar_estado_fisico($registro_estado){
                $this -> db -> insert('registro_fisico', $registro_estado); 
        }
        
        function registrar_meteorologia($registro_meteorologia){
                $this -> db -> insert('registro_meteorologico', $registro_meteorologia); 
        }
        
        function get_id_animo($animo){
                $this -> db -> select('id_animo');
                $this -> db -> from('animo');
                $this -> db -> where('nombre', $animo);
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        function get_id_sintoma($sintoma){
                $this -> db -> select('id_sintoma');
                $this -> db -> from('sintoma');
                $this -> db -> where('nombre', $sintoma);
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        function get_id_actividad($actividad){
                $this -> db -> select('id_actividad');
                $this -> db -> from('actividad');
                $this -> db -> where('nombre', $actividad);
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        function get_id_parte_dolor($parte){
                $this -> db -> select('id_parte');
                $this -> db -> from('parte_cuerpo');
                $this -> db -> where('nombre', $parte);
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        function get_id_sleep($sleep){
                $this -> db -> select('id_sleep_quality');
                $this -> db -> from('sleep_quality');
                $this -> db -> where('nombre', $sleep);
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        function get_id_fisico($fisico){
                $this -> db -> select('id_estado_fisico');
                $this -> db -> from('estado_fisico');
                $this -> db -> where('nombre', $fisico);
                $query = $this -> db -> get();

                if($query -> num_rows() == 1){
                        return $query->result();
                }else{
                        return false;
                }
        }
        
        

}
