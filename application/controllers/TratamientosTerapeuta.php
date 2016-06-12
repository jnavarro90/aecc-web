<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TratamientosTerapeuta extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->library('form_validation');
        //modelos 
        $this->load->model('tratamientos_model');
    }
    
    public function index() {
        $this -> mostrar();
    }
    
    private function mostrar(){
	   	if($this->session->userdata('logged_in')){
	   	    $datos['tratamientos'] = $this->obtenerDatos();
	     	$this->load->view('/terapeuta/tratamientos', $datos);
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
        
    }
    
    private function obtenerDatos(){
        $result = $this->tratamientos_model->obtener_nombres();
        $tratamientos = array();
        if($result){
            foreach($result as $row){
                $tratamiento =array(
                    'id' => $row->id_tratamiento,
                    'nombre' => $row->nombre
                    );
                    array_push($tratamientos, $tratamiento);
            }
            return $tratamientos;
        }
    }
    
     public function nuevoTratamiento(){
        //Ponemos las reglas para validar el formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[tratamiento.nombre]');
        
        //Lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('is_unique', 'Ya existe el tratamiento');
        
        //Recogemos el nombre introducido por el usuario
        $nombre = $this->input->post('nombre');
        
        if ($this->form_validation->run() == FALSE){
            //Error en el formulario
			$datos = array(
                   'mensajeTratamiento'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El tratamiento no se ha creado correctamente.'
                        ),
                    'reEnvioTratamiento' => array(
                        'nombre' => $nombre
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('tratamientosTerapeuta');
        }else{
            //Formulario correcto
            $tratamiento =array(
                'nombre' => $nombre
                );
            if($this->tratamientos_model->insertar_tratamiento($tratamiento)){
                $datos = array(
                       'mensajeTratamiento'  => array(
                           'error' => false,
                            'msgNombre' => '',
                            ),
                        'mensaje' => array(
                            'error' => false,
                            'msgTitulo' => 'Tratamiento creado',
                            'msg' => 'El tratamiento se ha creado correctamente.'
                            )
                   );
    
                $this->session->set_userdata($datos);
                redirect('tratamientosTerapeuta');
            }else{
                $datos = array(
                   'mensajeTratamiento'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El tratamiento no se ha creado correctamente.'
                        ),
                    'reEnvioTratamiento' => array(
                        'nombre' => $nombre
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('tratamientosTerapeuta');
            }
        }
    }
}
