<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SintomasTerapeuta extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->library('form_validation');
        //modelos
        $this -> load -> model('sintomas_model');
    }
    
    public function index() {
        $this -> mostrar();
    }
    
    private function mostrar(){
	   	if($this->session->userdata('logged_in')){
	   	    $datos['sintomas'] = $this->obtenerDatos();
	     	$this->load->view('/terapeuta/sintomas', $datos);
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
    }
    
    private function obtenerDatos(){
        $result = $this->sintomas_model->obtener_nombres();
        $sintomas = array();
        if($result){
            foreach($result as $row){
                $sintoma =array(
                    'id' => $row->id_sintoma,
                    'nombre' => $row->nombre,
                    );
                    array_push($sintomas, $sintoma);
            }
            return $sintomas;
        }
    }
    
    public function nuevoSintoma(){
        //Ponemos las reglas para validar el formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[sintoma.nombre]');
        
        //Lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('is_unique', 'Ya existe el sintoma');
        
        //Recogemos el nombre introducido por el usuario
        $nombre = $this->input->post('nombre');
        
        if ($this->form_validation->run() == FALSE){
            //Error en el formulario
			$datos = array(
                   'mensajeSintoma'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El sintoma no se ha creado correctamente.'
                        ),
                    'reEnvioSintoma' => array(
                        'nombre' => $nombre
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('sintomasTerapeuta');
        }else{
            //Formulario correcto
            $sintoma =array(
                'nombre' => $nombre
                );
            if($this->sintomas_model->insertar_sintoma($sintoma)){
                $datos = array(
                       'mensajeSintoma'  => array(
                           'error' => false,
                            'msgNombre' => '',
                            ),
                        'mensaje' => array(
                            'error' => false,
                            'msgTitulo' => 'Sintoma creado',
                            'msg' => 'El sintoma se ha creado correctamente.'
                            )
                   );
    
                $this->session->set_userdata($datos);
                redirect('sintomasTerapeuta');
            }else{
                $datos = array(
                   'mensajeSintoma'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El sintoma no se ha creado correctamente.'
                        ),
                    'reEnvioSintoma' => array(
                        'nombre' => $nombre
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('sintomasTerapeuta');
            }
        }
    }
}
