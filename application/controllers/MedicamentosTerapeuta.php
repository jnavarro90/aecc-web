<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MedicamentosTerapeuta extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->library('form_validation');
        //modelos 
        $this->load->model('medicamentos_model');
    }
    
    public function index() {
        $this -> mostrar();
    }
    
    private function mostrar(){
	   	if($this->session->userdata('logged_in')){
	   	    $datos['medicamentos'] = $this->obtenerDatos();
	     	$this->load->view('/terapeuta/medicamentos', $datos);
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
        
    }
    
    private function obtenerDatos(){
        $result = $this->medicamentos_model->obtener_nombres();
        $medicamentos = array();
        if($result){
            foreach($result as $row){
                $medicamento =array(
                    'id' => $row->id_medicamento,
                    'nombre' => $row->nombre,
                    'dosis' => $row->dosis_medicamento
                    );
                    array_push($medicamentos, $medicamento);
            }
            return $medicamentos;
        }
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
            redirect('medicamentosTerapeuta');
		}
		else
		{
		    //Formulario correcto
		    $medicamento = array(
		        'nombre' => $nombre,
		        'dosis_medicamento' => $dosis
		        );
		    
		    if($this->medicamentos_model->insertar_medicamento($medicamento)){
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
                redirect('medicamentosTerapeuta');
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
            redirect('medicamentosTerapeuta');
		    }
            
		}
	
    }
    
}
