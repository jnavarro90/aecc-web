<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventosTerapeuta extends CI_Controller {
    
    
	public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        //modelos
        $this -> load -> model('tratamientos_model');
    }
    
    public function index() {
        $this -> mostrar();
    }
    
    private function mostrar(){
	   	if($this->session->userdata('logged_in')){
	   	    if($this->session->evento){
	   	        $datos['evento'] = $this->obtenerDatosEvento();
	   	        $datos['nombres_tratamientos'] = $this->obtenerNombresTramientos();
	   	        $datos['nombres_colores'] = $this->obtenerNombresColores();
	   	        $this->load->view('/terapeuta/eventos', $datos);
	   	    }else{
	   	        $datos['nombres_tratamientos'] = $this->obtenerNombresTramientos();
	   	        $datos['nombres_colores'] = $this->obtenerNombresColores();
	   	        $this->load->view('/terapeuta/eventos', $datos);
	   	    }
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
        
    }
    
    private function obtenerDatosEvento(){
        $id_tratamiento = $this->session->evento['id'];
        $result = $this->tratamientos_model->obtener_eventos(null, $id_tratamiento);
        if($result){
            foreach($result as $row){
                $evento = array(
                //Como en el modelo ya controlamos que solo nos devuelva una fila buscamos el primer elemento de $result
                'nombre' => $result[0]->fk_tratamiento_regtratamiento,
                'fecha' => $result[0]->fecha,
                'horaInicio' => $result[0]->hora_inicio,
                'horaFin' => $result[0]->hora_fin,
                'observaciones' => $result[0]->observaciones,
                'color' => $result[0]->id_color
                );
            }
        return $evento;
        }
    }
    
        
    private function obtenerNombresTramientos(){
        $result = $this->tratamientos_model->obtener_nombres();
        
        $tratamientos = array();
        foreach($result as $row){
            $tratamiento =array(
                'nombre' => $row->nombre,
                'id' => $row->id_tratamiento
                );
            array_push($tratamientos, $tratamiento);
        }
        return $tratamientos;
    }
    
    private function obtenerNombresColores(){
        $result = $this->tratamientos_model->obtener_nombres_colores();
        
        $colores = array();
        foreach($result as $row){
            $color =array(
                'nombre' => $row->nombre_color,
                'id' => $row->id_color
                );
            array_push($colores, $color);
        }
        return $colores;
    }
    
    public function modificarEvento(){
        //Ponemos las reglas para validar el formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('horaInicio', 'Hora inicio', 'required');
        $this->form_validation->set_rules('color', 'Color','required');
        $this->form_validation->set_rules('observaciones', 'Observaciones','required');


        //Lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        
        //Recogemos los datos introducidos por el usuario
        $nombre = $this->input->post('nombre');
        $fecha = $this->input->post('fecha');
        $horaInicio = $this->input->post('horaInicio');
        $horaFin = $this->input->post('horaFin');
        $color = $this->input->post('color');
        $observaciones = $this->input->post('observaciones');
    
        if ($this->form_validation->run() == FALSE)
		{
			//Error en el formulario
			$datos = array(
                   'mensajeEvento'  => array(
                        'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgFecha' => form_error('fecha'),
                        'msgHoraInicio' => form_error('horaInicio'),
                        'msgColor' => form_error('color'),
                        'msgObservaciones' => form_error('observaciones')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El evento no se ha modificado correctamente.'
                        ),
                    'reEnvioEvento' => array(
                        'nombre' => $nombre,
                        'fecha' => $fecha,
                        'horaInicio' => $horaInicio,
                        'horaFin' => $horaFin,
                        'color' => $color,
                        'observaciones' => $observaciones
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('eventosTerapeuta');
		}
		else
		{
		    //Formulario correcto
		    $date = new DateTime($fecha);
		    $evento = array(
		        'fk_tratamiento_regtratamiento' => $nombre,
		        'fk_paciente_regtratamiento' => $this->session->paciente['id'],
		        'fk_color_regtratamiento' => $color,
		        'fecha' => date_format($date, 'Y-m-d'),
		        'hora_inicio' => $horaInicio,
		        'observaciones' => $observaciones
		        );
		    
		    if($this->tratamientos_model->actualizar_evento($evento)){
    			$datos = array(
                       'mensajeEvento'  => array(
                            'error' => false,
                            'msgNombre' => '',
                            'msgFecha' => '',
                            'msgHoraInicio' => '',
                            'msgColor' => '',
                            'msgObservaciones' => ''
                            ),
                        'mensaje' => array(
                            'error' => false,
                            'msgTitulo' => 'Evento modificado',
                            'msg' => 'El evento se ha modificado correctamente.'
                            )
                   );
                    
                $this->session->set_userdata($datos);
                redirect('pacientesTerapeuta');
		    }else{
		        $datos = array(
                   'mensajeEvento'  => array(
                        'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgFecha' => form_error('fecha'),
                        'msgHoraInicio' => form_error('horaInicio'),
                        'msgColor' => form_error('color'),
                        'msgObservaciones' => form_error('observaciones')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El evento no se ha modificado correctamente.'
                        ),
                    'reEnvioEvento' => array(
                        'nombre' => $nombre,
                        'fecha' => $fecha,
                        'horaInicio' => $horaInicio,
                        'horaFin' => $horaFin,
                        'color' => $color,
                        'observaciones' => $observaciones
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('eventosTerapeuta');
		    }
            
		}
		

    }
    
    public function nuevoEvento(){
                //Ponemos las reglas para validar el formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('horaInicio', 'Hora inicio', 'required');
        $this->form_validation->set_rules('color', 'Color','required');
        $this->form_validation->set_rules('observaciones', 'Observaciones','required');


        //Lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        
        //Recogemos los datos introducidos por el usuario
        $nombre = $this->input->post('nombre');
        $fecha = $this->input->post('fecha');
        $horaInicio = $this->input->post('horaInicio');
        $horaFin = $this->input->post('horaFin');
        $color = $this->input->post('color');
        $observaciones = $this->input->post('observaciones');
        if ($this->form_validation->run() == FALSE)
		{
			//Error en el formulario
			$datos = array(
                   'mensajeEvento'  => array(
                        'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgFecha' => form_error('fecha'),
                        'msgHoraInicio' => form_error('horaInicio'),
                        'msgColor' => form_error('color'),
                        'msgObservaciones' => form_error('observaciones')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El evento no se ha creado correctamente.'
                        ),
                    'reEnvioEvento' => array(
                        'nombre' => $nombre,
                        'fecha' => $fecha,
                        'horaInicio' => $horaInicio,
                        'horaFin' => $horaFin,
                        'color' => $color,
                        'observaciones' => $observaciones
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('eventosTerapeuta');
		}
		else
		{
		    //Formulario correcto
		    $date = new DateTime($fecha);
		    $evento = array(
		        'fk_tratamiento_regtratamiento' => $nombre,
		        'fk_paciente_regtratamiento' => $this->session->paciente['id'],
		        'fk_color_regtratamiento' => $color,
		        'fecha' => date_format($date, 'Y-m-d'),
		        'hora_inicio' => $horaInicio,
		        'observaciones' => $observaciones
		        );
		    
		    if($this->tratamientos_model->insertar_evento($evento)){
    			$datos = array(
                       'mensajeEvento'  => array(
                            'error' => false,
                            'msgNombre' => '',
                            'msgFecha' => '',
                            'msgHoraInicio' => '',
                            'msgColor' => '',
                            'msgObservaciones' => ''
                            ),
                        'mensaje' => array(
                            'error' => false,
                            'msgTitulo' => 'Evento creado',
                            'msg' => 'El evento se ha creado correctamente.'
                            )
                   );
                    
                $this->session->set_userdata($datos);
                redirect('pacientesTerapeuta');
		    }else{
		        $datos = array(
                   'mensajeEvento'  => array(
                        'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgFecha' => form_error('fecha'),
                        'msgHoraInicio' => form_error('horaInicio'),
                        'msgColor' => form_error('color'),
                        'msgObservaciones' => form_error('observaciones')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El evento no se ha creado correctamente.'
                        ),
                    'reEnvioEvento' => array(
                        'nombre' => $nombre,
                        'fecha' => $fecha,
                        'horaInicio' => $horaInicio,
                        'horaFin' => $horaFin,
                        'color' => $color,
                        'observaciones' => $observaciones
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('eventosTerapeuta');
		    }
            
		}
    }
}
