<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrincipalAdministrador extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->library('form_validation');
        //modelos 
        $this -> load -> model('administradores_model');
    }
    
    public function index() {
        $this -> mostrar();
    }
    
    private function mostrar(){
	   	if($this->session->userdata('logged_in')){
	     	$this->load->view('/administrador/principal');
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
        
    }
    
    
    public function nuevoPaciente(){
        //Ponemos las reglas para validar el formulario
        $this->form_validation->set_rules('nombre_usuario', 'Nombre usuario ', 'required|min_length[5]|max_length[12]|is_unique[paciente.nombre_usuario]');
        $this->form_validation->set_rules('password', 'Contraseña ', 'required|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Correo electronico', 'required|valid_email|is_unique[paciente.email]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido1', 'Primer apellido', 'required');
        $this->form_validation->set_rules('apellido2', 'Segundo apellido', 'required');
        $this->form_validation->set_rules('dni', 'Dni','required|alpha_numeric|exact_length[9]');


        //Lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('min_length', 'Debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', 'Debe tener al menos %s carácteres');
        $this->form_validation->set_message('valid_email', 'Debe escribir un email válido');
        $this->form_validation->set_message('is_unique', 'No es unico en la base de datos');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
        $this->form_validation->set_message('alpha_numeric', 'El formato del dni no es correcto');
        $this->form_validation->set_message('exact_length', 'El formato del dni no es correcto');
        
        //Recogemos los datos introducidos por el usuario
        $nombreUsuario = $this->input->post('nombre_usuario');
        $password = $this->input->post('password');
        $rePassword = $this->input->post('repassword');
        $email = $this->input->post('email');
        $nombre = $this->input->post('nombre');
        $apellido1 = $this->input->post('apellido1');
        $apellido2 = $this->input->post('apellido2');
        $dni = $this->input->post('dni');
        
        if ($this->form_validation->run() == FALSE)
		{
			//Error en el formulario
			$datos = array(
                   'mensajePaciente'  => array(
                       'error' => true,
                        'msgNombreUsuario' => form_error('nombre_usuario'),
                        'msgPassword' => form_error('password'),
                        'msgRePassword' => form_error('repassword'),
                        'msgEmail' => form_error('email'),
                        'msgNombre' => form_error('nombre'),
                        'msgApellido1' => form_error('apellido1'),
                        'msgApellido2' => form_error('apellido2'),
                        'msgDni' => form_error('dni')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El usuario no se ha creado correctamente.'
                        ),
                    'reEnvioPaciente' => array(
                        'nombre_usuario' => $nombreUsuario,
                        'email' => $email,
                        'nombre' => $nombre,
                        'apellido1' => $apellido1,
                        'apellido2' => $apellido2,
                        'dni' => $dni
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('principalAdministrador');
		}
		else
		{
		    //Formulario correcto
			$datos = array(
                   'mensajePaciente'  => array(
                       'error' => false,
                       'msgNombreUsuario' => '',
                        'msgPassword' => '',
                        'msgRePassword' => '',
                        'msgEmail' => '',
                        'msgNombre' => '',
                        'msgApellido1' => '',
                        'msgApellido2' => '',
                        'msgDni' => '',
                        'msgTitulo' => 'Usuario creado',
                        'msg' => 'El usuario se ha creado correctamente.'
                        ),
                    'mensaje' => array(
                        'error' => false,
                        'msgTitulo' => 'Usuario creado',
                        'msg' => 'El usuario se ha creado correctamente.'
                        )
               );

            $this->session->set_userdata($datos);
            redirect('principalAdministrador');
		}
    }
    
    
}
