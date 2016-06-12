<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();
        //modelos 
        $this -> load -> model('terapeutas_model');
        $this -> load -> model('administradores_model');
    }
    
    public function index() {
        $this -> mostrar();
    }
    
    private function mostrar(){
	   	if($this->session->userdata('logged_in')){
	     	redirect('principalTerapeuta');
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
        
    }
    
    function validar(){
        $usuario = $this -> input -> post('usuario');
	    $password = $this -> input -> post('password');
	    $result = $this -> terapeutas_model -> obtener_credenciales($usuario, $password);
        //password_hash("1234", PASSWORD_BCRYPT)
        if($result){
	    	foreach($result as $row){
	    	    $id_terapeuta = $row -> id_terapeuta;
	    	    $nombre_usuario = $row -> nombre_usuario;
	    	    $BDpassword = $row -> password;
	    	    $nombre = $row -> nombre;
	    	    $apellido1 = $row -> apellido1;
	    	    $apellido2 = $row -> apellido2;
	    	    $email = $row -> email;
	    	    $dni = $row -> dni;
	    	    if(hash_equals(md5($password), $BDpassword)){
    	    	    $datos_terapeuta    = array(
    	    	        'error' => false,
    	    	        'id_terapeuta' => $id_terapeuta,
                        'usuario' => $nombre_usuario,
                        'nombre'         => $nombre,
                        'apellido1'      => $apellido1,
                        'apellido2'      => $apellido2,
                        'email'          => $email,
                        'dni'           => $dni,
                        'logged_in' => TRUE
                    );
                    $this -> session -> set_userdata($datos_terapeuta);
                    $logueado = true;
	    	    }else{
                    $logueado = false;
                }
                if ($logueado) {
                    redirect('principalTerapeuta', 'refresh');
                }else{
                    redirect('login', 'refresh');
                }
	    	}
        }else{
            $result = $this -> administradores_model -> obtener_credenciales($usuario, $password);
            if($result){
                foreach($result as $row){
                    $id_administrador = $row->id_administrador;
                    $nombre_usuario = $row->nombre_usuario;
                    $BDpassword = $row->password;
                    if(hash_equals(md5($password), $BDpassword)){
                        $datos_administrador = array(
                            'error' => false,
                            'id_administrador' => $id_administrador,
                            'nombre_usuario' => $nombre_usuario,
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($datos_administrador);
                        $logueado = true;
	    	        }else{
                        $logueado = false;
                    }
                    if ($logueado) {
                        redirect('principalAdministrador', 'refresh');
                    }else{
                        redirect('login', 'refresh');
                    }
	    	    }
            }
        }
    }
    
    function cerrarSesion(){
      	session_destroy();
    	redirect('principalTerapeuta', 'refresh');
  	}
}
