<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PacientesTerapeuta extends CI_Controller {
    
    
	public function __construct(){
        parent::__construct();
        //modelos
        $this->load->model('pacientes_model');
        $this->load->model('tratamientos_model');
    }
    
    public function index() {
        $this -> mostrar();
    }
    
    private function mostrar(){
	   	if($this->session->userdata('logged_in')){
	   	    if($this->session->paciente['id']){
	   	        $datos['detalles'] = $this->obtenerDetallesPaciente();
	   	        $datos['medicacion'] = $this->obtenerMedicacionPaciente();
	   	        $datos['eventos'] = $this->obtenerEventos();
	     	    $this->load->view('/terapeuta/pacientes', $datos);
	   	    }else{
	   	        $this->load->view('/terapeuta/pacientes');
	   	    }
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
        
    }
    
    private function obtenerEventos(){
        $id_paciente = $this->session->paciente['id'];
        $result = $this->tratamientos_model->obtener_eventos($id_paciente);
        $eventos = array();
        if($result){
            foreach($result as $row){
                $date = date_create($row->fecha . $row->hora_inicio);
                $fecha_inicio = date_format($date, 'Y-m-d\TH:i:s\Z');
                $date = date_create($row->fecha . $row->hora_fin);
                $fecha_fin = date_format($date, 'Y-m-d\TH:i:s\Z');
                $evento = array(
                    'title' =>  $row->nombre,
                    'start' => $fecha_inicio,
                    'end' => $fecha_fin,
                    'url' => base_url() . 'pacientesTerapeuta/verEvento/' . $row->id_registro_tratamiento,
                    'backgroundColor' => $row->color_html,
                    'borderColor' => $row->color_html
                );
                array_push($eventos, $evento);    
            }
            
        }
        $json = json_encode($eventos);
        return $json;
    }
    
    public function verEvento($id_evento){
        if (isset($id_evento)){
            $evento = array(
                'evento'  => array(
                    'id' => $id_evento,
                )
                );
            $this->session->set_userdata($evento);
        }
        redirect('eventosTerapeuta');
    }
    
    public function verNuevoEvento(){
        redirect('eventosTerapeuta');
    }
    
    public function verPaciente($id_paciente=null){
        if(isset($id_paciente)){
            $datos = array(
               'paciente'  => array(
                    'id' => $id_paciente,
                )
             );

            $this->session->set_userdata($datos);
            redirect('pacientesTerapeuta');
        }else{
            redirect('pacientesTerapeuta');
        }
    }
    
    public function noVerPaciente(){
        $this->session->unset_userdata('paciente');
        redirect('pacientesTerapeuta');
    }
    
    //Obtener * del paciente
    
    private function obtenerDetallesPaciente(){
        $id_paciente = $this->session->paciente['id'];
        $result = $this->pacientes_model->obtener_detalles($id_paciente);
        if($result){
            $detalles = array(
                //Como en el modelo ya controlamos que solo nos devuelva una fila buscamos el primer elemento de $result
                'nombre' => $result[0]->nombre,
                'apellidos' => $result[0]->apellido1 . ' ' . $result[0]->apellido2,
                'genero' => $result[0]->genero,
                'dni' => $result[0]->dni,
                'fecha_nacimiento' => $result[0]->fecha_nacimiento,
                'fecha_admision' => $result[0]->fecha_admision,
                'direccion' => $result[0]->pais . ', ' . $result[0]->ciudad . ', ' .$result[0]->direccion,
                'email' => $result[0]->email,
                'telefono' => $result[0]->telefono
                );
        }
        return $detalles;
    }
    
    public function obtenerMedicacionPaciente(){
        $id_paciente = $this->session->paciente['id'];
        $medicacion = array();
        $result = $this->pacientes_model->obtenerMedicacion($id_paciente);
        if($result){
            
            foreach($result as $row){
                switch($row->parte_dia){
                    case MANANA:
                        $toma = 'Mañana';
                        break;
                    case MEDIODIA:
                        $toma = 'Mediodía';
                        break;
                    case TARDE:
                        $toma = 'Tarde';
                        break;
                    case NOCHE:
                        $toma = 'Noche';
                        break;
                }
                $datos = array(
                    'id_medicacion' => $row->id_registro_medicacion,
                    'nombre' => $row->nombre,
                    'dia' => $row->dia,
                    'dosis' => $row->dosis,
                    'toma' => $toma,
                    'hora' => $row->hora,
                    'posologia' => $row->posologia
                    );

                    array_push($medicacion, $datos);
            }
        }
        
        return $medicacion;
    }
    
    public function verModificarMedicacion($id_medicacion=null){
        if(isset($id_medicacion)){
            $datos = array(
                   'medicacion'  => array(
                        'id' => $id_medicacion,
                        )
               );

            $this->session->set_userdata($datos);
        }
        redirect('medicacionTerapeuta');

    }
    
    public function verNuevaMedicacion(){
        $this->session->unset_userdata('medicacion');
        redirect('medicacionTerapeuta');
    }
    
}
