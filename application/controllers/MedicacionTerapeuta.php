<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MedicacionTerapeuta extends CI_Controller {
    
    
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
	   	    $datos['nombres_medicamentos'] = $this->obtenerNombresMedicamentos();
	   	    if($this->session->medicacion['id']){
	   	        $datos['medicacion'] = $this->obtenerDatosMedicacion($this->session->medicacion['id']);
	     	    $this->load->view('/terapeuta/medicacion', $datos);
	   	    }else{
	   	        $this->load->view('/terapeuta/medicacion', $datos);
	   	    }
	   	}
	   	else{
	   		$this->load->view('login');
	   	}
        
    }
    
    private function obtenerDatosMedicacion(){
        
        $result = $this->terapeutas_model->obtener_datos_medicacion($this->session->medicacion['id']);
         if($result){
            $medicacion = array(
                'id_medicacion' => $result[0]->id_registro_medicacion,
                'nombre' => $result[0]->fk_medicamento_regmedicacion,
                'dia' => $result[0]->dia,
                'dosis' => $result[0]->dosis,
                'toma' => $result[0]->parte_dia,
                'posologia' => $result[0]->posologia
                );
            }
        
        return $medicacion;
    }
    
    private function obtenerNombresMedicamentos(){
        $result = $this->terapeutas_model->obtener_nombres_medicamentos();
        $medicamentos = array();
        foreach($result as $row){
            $medicamento =array(
                'nombre' => $row->nombre . " " . $row->dosis_medicamento . " mg",
                'id' => $row->id_medicamento
                );
            array_push($medicamentos, $medicamento);
        }
        return $medicamentos;
    }
    
    public function nuevaMedicacion(){
        //Ponemos las reglas para validar el formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('dosis', 'Dosis', 'required|numeric');
        $this->form_validation->set_rules('posologia', 'Posología','required');


        //Lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo debe ser un numero');
        
        //Recogemos los datos introducidos por el usuario
        $nombre = $this->input->post('nombre');
        $dosis = $this->input->post('dosis');
        $tomas = $this->input->post('toma');
        $dias = $this->input->post('dia');
        $posologia = $this->input->post('posologia');

        if ($this->form_validation->run() == FALSE){
			//Error en el formulario
			$datos = array(
                   'mensajeMedicacion'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgDosis' => form_error('dosis'),
                        'msgToma' => form_error('toma'),
                        'msgDia' => form_error('dia'),
                        'msgPosologia' => form_error('posologia')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'La medicación no se ha creado correctamente.'
                        ),
                    'reEnvioMedicacion' => array(
                        'nombre' => $nombre,
                        'dosis' => $dosis,
                        'toma' => $tomas,
                        'dia' => $dias,
                        'posologia' => $posologia
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('medicacionTerapeuta');
		}else{
		        if($this->terapeutas_model->comprobar_medicacion_valida($nombre, $tomas, $dias)){
		            foreach($dias as $dia){
    		            foreach($tomas as $toma){
        		            switch($toma){
        		                case MANANA:
        		                    $hora = '9:00';
        		                    break;
        		                case MEDIODIA:
        		                    $hora = '14:00';
        		                    break;
        		                case TARDE:
        		                    $hora = '18:00';
        		                    break;
        		                case NOCHE:
        		                    $hora = '21:00';
        		                    break;
        		            }
            		    $medicacion = array(
        		            'fk_medicamento_regmedicacion' => $nombre,
        		            'dosis' => $dosis,
        		            'parte_dia' => $toma,
        		            'dia' => $dia,
        		            'hora' => $hora,
        		            'posologia' => $posologia,
        		            'fk_paciente_regmedicacion' => $this->session->paciente['id']
        		        );
        		        if(!$this->terapeutas_model->insertar_medicacion($medicacion)){
        		            $datos = array(
                               'mensajeMedicacion'  => array(
                                   'error' => true,
                                    'msgNombre' => form_error('nombre'),
                                    'msgDosis' => form_error('dosis'),
                                    'msgToma' => form_error('toma'),
                                    'msgDia' => form_error('dia'),
                                    'msgPosologia' => form_error('posologia')
                                    ),
                                'mensaje' => array(
                                    'error' => true,
                                    'msgTitulo' => 'Error',
                                    'msg' => 'La medicación no se ha creado correctamente.'
                                    ),
                                'reEnvioMedicacion' => array(
                                    'nombre' => $nombre,
                                    'dosis' => $dosis,
                                    'toma' => $tomas,
                                    'dia' => $dias,
                                    'posologia' => $posologia
                                    ),
                           );
            
                            $this->session->set_userdata($datos);
                            redirect('medicacionTerapeuta');
        		        }
    		        }
    		    }
    		    $datos = array(
                   'mensajeMedicacion'  => array(
                       'error' => false,
                        'msgNombre' => '',
                        'msgDosis' => '',
                        'msgToma' => '',
                        'msgDia' => '',
                        'msgPosologia' => ''
                        ),
                    'mensaje' => array(
                        'error' => false,
                        'msgTitulo' => 'Medicacion creada',
                        'msg' => 'La medicación se ha creado correctamente.'
                        )
                );

                $this->session->set_userdata($datos);
                redirect('pacientesTerapeuta'); 
    		}else{
    		    $datos = array(
                   'mensajeMedicacion'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgDosis' => form_error('dosis'),
                        'msgToma' => form_error('toma'),
                        'msgDia' => form_error('dia'),
                        'msgPosologia' => form_error('posologia')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'La medicación coincide con una ya existente.'
                        ),
                    'reEnvioMedicacion' => array(
                        'nombre' => $nombre,
                        'dosis' => $dosis,
                        'toma' => $tomas,
                        'dia' => $dias,
                        'posologia' => $posologia
                        ),
               );

                $this->session->set_userdata($datos);
                redirect('medicacionTerapeuta');
    		}
        }
    }
    
    public function modificarMedicacion(){
        //Ponemos las reglas para validar el formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('dosis', 'Dosis', 'required|numeric');
        $this->form_validation->set_rules('toma', 'Toma', 'trim|required');
        $this->form_validation->set_rules('dia', 'Día','trim|required');
        $this->form_validation->set_rules('posologia', 'Posología','required');


        //Lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo debe ser un numero');
        
        //Recogemos los datos introducidos por el usuario
        $nombre = $this->input->post('nombre');
        $dosis = $this->input->post('dosis');
        $toma = $this->input->post('toma');
        $dia = $this->input->post('dia');
        $posologia = $this->input->post('posologia');

        if ($this->form_validation->run() == FALSE){
			//Error en el formulario
			$datos = array(
                   'mensajeMedicacion'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgDosis' => form_error('dosis'),
                        'msgToma' => form_error('toma'),
                        'msgDia' => form_error('dia'),
                        'msgPosologia' => form_error('posologia')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'La medicación no se ha modificado correctamente.'
                        ),
                    'reEnvioMedicacion' => array(
                        'nombre' => $nombre,
                        'dosis' => $dosis,
                        'toma' => $toma,
                        'dia' => $dia,
                        'posologia' => $posologia
                        ),
               );

            $this->session->set_userdata($datos);
            redirect('medicacionTerapeuta');
		}else{
		    
		    	if($this->terapeutas_model->comprobar_medicacion_actualizar_valida($nombre, $toma, $dia)){
		            switch($toma){
		                case MANANA:
		                    $hora = '9:00';
		                    break;
		                case MEDIODIA:
		                    $hora = '14:00';
		                    break;
		                case TARDE:
		                    $hora = '18:00';
		                    break;
		                case NOCHE:
		                    $hora = '21:00';
		                    break;
		            }
    		        $medicacion = array(
    		            'fk_medicamento_regmedicacion' => $nombre,
    		            'dosis' => $dosis,
    		            'parte_dia' => $toma,
    		            'dia' => $dia,
    		            'hora' => $hora,
    		            'posologia' => $posologia,
    		            'fk_paciente_regmedicacion' => $this->session->paciente['id']
		                );
		            if($this->terapeutas_model->actualizar_medicacion($medicacion)){
		                $datos = array(
                            'mensajeMedicacion'  => array(
                                'error' => false,
                                'msgNombre' => '',
                                'msgDosis' => '',
                                'msgToma' => '',
                                'msgDia' => '',
                                'msgPosologia' => ''
                                ),
                            'mensaje' => array(
                                'error' => false,
                                'msgTitulo' => 'Medicacion creada',
                                'msg' => 'La medicación se ha modificado correctamente.'
                                )
                            );

                    $this->session->set_userdata($datos);
                    redirect('pacientesTerapeuta'); 
                    
		        }else{
		            $datos = array(
                       'mensajeMedicacion'  => array(
                           'error' => true,
                            'msgNombre' => form_error('nombre'),
                            'msgDosis' => form_error('dosis'),
                            'msgToma' => form_error('toma'),
                            'msgDia' => form_error('dia'),
                            'msgPosologia' => form_error('posologia')
                            ),
                        'mensaje' => array(
                            'error' => true,
                            'msgTitulo' => 'Error',
                            'msg' => 'La medicación no se ha modificado correctamente.'
                            ),
                        'reEnvioMedicacion' => array(
                            'nombre' => $nombre,
                            'dosis' => $dosis,
                            'toma' => $toma,
                            'dia' => $dia,
                            'posologia' => $posologia
                            ),
                   );
    
                    $this->session->set_userdata($datos);
                    redirect('medicacionTerapeuta');
		        }
    		}else{
    		    $datos = array(
                   'mensajeMedicacion'  => array(
                       'error' => true,
                        'msgNombre' => form_error('nombre'),
                        'msgDosis' => form_error('dosis'),
                        'msgToma' => form_error('toma'),
                        'msgDia' => form_error('dia'),
                        'msgPosologia' => form_error('posologia')
                        ),
                    'mensaje' => array(
                        'error' => true,
                        'msgTitulo' => 'Error',
                        'msg' => 'La medicación coincide con una ya existente.'
                        ),
                    'reEnvioMedicacion' => array(
                        'nombre' => $nombre,
                        'dosis' => $dosis,
                        'toma' => $toma,
                        'dia' => $dia,
                        'posologia' => $posologia
                        ),
               );

                $this->session->set_userdata($datos);
                redirect('medicacionTerapeuta');
    		}
		}
    }
}