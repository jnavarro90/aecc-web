<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrincipalTerapeuta extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->library('form_validation');
        //modelos 
        $this -> load -> model('terapeutas_model');
    }
    
    public function index() {
        $this -> mostrar();
    }
    
    private function mostrar(){
	   	if($this->session->userdata('logged_in')){
	   	    $data = $this->obtenerDatos();
	     	$this->load->view('/terapeuta/principal', $data);
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
        
    }
    
    private function obtenerDatos(){
        $numeroPacientes = $this->terapeutas_model->obtener_numero_clientes();
        $numeroSintomas = $this->terapeutas_model->obtener_numero_sintomas();
        $numeroMedicamentos = $this->terapeutas_model->obtener_numero_medicamentos();
        $numeroTratamientos = $this->terapeutas_model->obtener_numero_tratamientos();
        $datos = array(
            'num_pacientes' => $numeroPacientes,
            'num_sintomas' => $numeroSintomas,
            'num_medicamentos' => $numeroMedicamentos,
            'num_tratamientos' => $numeroTratamientos
            );
        return $datos;
    }
    
     public function nuevoMedicamento(){
        //Ponemos las reglas para validar el formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[medicamento.nombre]');
        $this->form_validation->set_rules('dosis', 'Dosis', 'required|numeric');

        //Lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo debe ser un numero');
        $this->form_validation->set_message('is_unique', 'Ya existe el medicamento');
        
        //Recogemos los datos introducidos por el usuario
        $nombre = $this->input->post('nombre');
        $dosis = $this->input->post('dosis');

        if ($this->form_validation->run() == FALSE)
		{
			//Error en el formulario
			$datos = array(
                   'mensajeMedicamento'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgDosis' => form_error('dosis'),
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El medicamento no se ha creado correctamente.'
                        ),
                    'reEnvioMedicamento' => array(
                        'nombre' => $nombre,
                        'dosis' => $dosis,
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('principalTerapeuta');
		}
		else
		{
		    //Formulario correcto
		    $medicamento = array(
		        'nombre' => $nombre,
		        'dosis_medicamento' => $dosis
		        );
		    
		    if($this->terapeutas_model->insertar_medicamento($medicamento)){
    			$datos = array(
                       'mensajeMedicamento'  => array(
                           'error' => false,
                            'msgNombre' => '',
                            'msgDosis' => '',
                            ),
                        'mensaje' => array(
                            'error' => false,
                            'msgTitulo' => 'Medicamento creado',
                            'msg' => 'El medicamento se ha creado correctamente.'
                            )
                   );
                $this->session->set_userdata($datos);
                redirect('principalTerapeuta');
		    }else{
		        $datos = array(
                   'mensajeMedicamento'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgDosis' => form_error('dosis'),
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'El medicamento no se ha creado correctamente.'
                        ),
                    'reEnvioMedicamento' => array(
                        'nombre' => $nombre,
                        'dosis' => $dosis,
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('principalTerapeuta');
		    }
            
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
            redirect('principalTerapeuta');
        }else{
            //Formulario correcto
            $tratamiento =array(
                'nombre' => $nombre
                );
            if($this->terapeutas_model->insertar_tratamiento($tratamiento)){
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
                redirect('principalTerapeuta');
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
            redirect('principalTerapeuta');
            }
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
            redirect('principalTerapeuta');
        }else{
            //Formulario correcto
            $sintoma =array(
                'nombre' => $nombre
                );
            if($this->terapeutas_model->insertar_sintoma($sintoma)){
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
                redirect('principalTerapeuta');
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
            redirect('principalTerapeuta');
            }
        }
    }
}
