<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . "/libraries/REST_Controller.php";

class ApiAecc extends REST_Controller {
    
    public function __construct() {
        parent::__construct();

        //Carga de modelos
        $this -> load -> model('pacientes_model');
        $this -> load -> library('form_validation');
        $this -> load -> helper(array('form'));

    }

    public function index() {

    }

    //Funciones para pasar JSON a App Andrioid

    public function eventos_get($id_paciente) {
        if(isset($id_paciente)){
            $result = $this -> pacientes_model -> eventos($id_paciente);
            $datos_envio = array();
            if($result){
    	        foreach($result as $row){
    	            $fecha = $row -> fecha;
    	            $date = date_create($fecha);
                    $fecha = date_format($date, 'd/m/Y');
    	            $color_celda = $row -> color_celda;
    	            $tratamiento = $row -> nombre;
    	            $hora_inicio = $row -> hora_inicio;
    	            $observaciones = $row -> observaciones;
    	            $temp     = array(
    	                "error"             => false,
                        "fecha"             => $fecha,
                        //cambios
                        "color_celda"       => $color_celda,
                        "tratamiento"       => $tratamiento,
                        "hora_inicio"       => $hora_inicio,
                        "observaciones"     => $observaciones
                    );
                    array_push($datos_envio, $temp);
    	        }
            }
        }else{
            $datos_envio = array(
                "error" => true
            );
            $this -> response($datos_envio, 400);
        }
        $this -> response($datos_envio, 200);
        /*$datos_envio = array();
        $temp     = array(
            "fecha" => "25/4/2016",
            "color_celda"         => "color_evento_verde",
            "tratamiento"      => "Tratamiento1",
            "hora_inicio"      => "12:00",
            "observaciones"          => "Observaciones en pruebas"
        );
        $temp2     = array(
            "fecha" => "27/5/2016",
            "color_celda"         => "color_evento_rojo",
            "tratamiento"      => "Tratamiento2",
            "hora_inicio"      => "12:00",
            "observaciones"          => "Observaciones en pruebas"
        );
        array_push($datos_envio, $temp);
        array_push($datos_envio, $temp2);
        $this->response($datos_envio, 200);
        */

    }
    
    public function lista_sintomas_get(){
        
        $result = $this -> pacientes_model -> obtener_sintomas();
        $datos_envio = array();
        if($result){
    	    foreach($result as $row){
    	        $nombre = $row -> nombre;
    	        $temp     = array(
                    "nombre_sintoma" => $nombre,
                );
                array_push($datos_envio, $temp);
    	    }
        }
            /*
            $datos_envio = array();
            $temp     = array(
                "nombre_sintoma" => "Sintoma1",
            );
            $temp2     = array(
                "nombre_sintoma" => "Sintoma2",
            );
            array_push($datos_envio, $temp);
            array_push($datos_envio, $temp2);
            */
        $this->response($datos_envio, 200);
    }
    
    public function medicacion_get($id_paciente){
        if(isset($id_paciente)){
            $datos_envio = array();
            $domingo    = array(
                "nombre_dia" => "Domingo",
            );
            $lunes    = array(
                "nombre_dia" => "Lunes",
            );
            $martes    = array(
                "nombre_dia" => "Martes",
            );
            $miercoles    = array(
                "nombre_dia" => "Miercoles",
            );
            $jueves    = array(
                "nombre_dia" => "Jueves",
            );
            $viernes    = array(
                "nombre_dia" => "Viernes",
            );
            $sabado    = array(
                "nombre_dia" => "Sabado",
            );
            
            $manana = array(
                "parte_dia" => "Mañana"
            );
            $mediodia = array(
                "parte_dia" => "Mediodia"
            );
            $tarde = array(
                "parte_dia" => "Tarde"
            );
            $noche = array(
                "parte_dia" => "Noche"
            );
            
            $domingo = $this -> set_medicamentos($id_paciente, DOMINGO, MANANA, $domingo, $manana);
            $domingo = $this -> set_medicamentos($id_paciente, DOMINGO, MEDIODIA, $domingo, $mediodia);
            $domingo = $this -> set_medicamentos($id_paciente, DOMINGO, TARDE, $domingo, $tarde);
            $domingo = $this -> set_medicamentos($id_paciente, DOMINGO, NOCHE, $domingo, $noche);
            
            $lunes = $this -> set_medicamentos($id_paciente, LUNES, MANANA, $lunes, $manana);
            $lunes = $this -> set_medicamentos($id_paciente, LUNES, MEDIODIA, $lunes, $mediodia);
            $lunes = $this -> set_medicamentos($id_paciente, LUNES, TARDE, $lunes, $tarde);
            $lunes = $this -> set_medicamentos($id_paciente, LUNES, NOCHE, $lunes, $noche);
            
            $martes = $this -> set_medicamentos($id_paciente, MARTES, MANANA, $martes, $manana);
            $martes = $this -> set_medicamentos($id_paciente, MARTES, MEDIODIA, $martes, $mediodia);
            $martes = $this -> set_medicamentos($id_paciente, MARTES, TARDE, $martes, $tarde);
            $martes = $this -> set_medicamentos($id_paciente, MARTES, NOCHE, $martes, $noche);
            
            $miercoles = $this -> set_medicamentos($id_paciente, MIERCOLES, MANANA, $miercoles, $manana);
            $miercoles = $this -> set_medicamentos($id_paciente, MIERCOLES, MEDIODIA, $miercoles, $mediodia);
            $miercoles = $this -> set_medicamentos($id_paciente, MIERCOLES, TARDE, $miercoles, $tarde);
            $miercoles = $this -> set_medicamentos($id_paciente, MIERCOLES, NOCHE, $miercoles, $noche);
            
            $jueves = $this -> set_medicamentos($id_paciente, JUEVES, MANANA, $jueves, $manana);
            $jueves = $this -> set_medicamentos($id_paciente, JUEVES, MEDIODIA, $jueves, $mediodia);
            $jueves = $this -> set_medicamentos($id_paciente, JUEVES, TARDE, $jueves, $tarde);
            $jueves = $this -> set_medicamentos($id_paciente, JUEVES, NOCHE, $jueves, $noche);
            
            $viernes = $this -> set_medicamentos($id_paciente, VIERNES, MANANA, $viernes, $manana);
            $viernes = $this -> set_medicamentos($id_paciente, VIERNES, MEDIODIA, $viernes, $mediodia);
            $viernes = $this -> set_medicamentos($id_paciente, VIERNES, TARDE, $viernes, $tarde);
            $viernes = $this -> set_medicamentos($id_paciente, VIERNES, NOCHE, $viernes, $noche);
            
            $sabado = $this -> set_medicamentos($id_paciente, SABADO, MANANA, $sabado, $manana);
            $sabado = $this -> set_medicamentos($id_paciente, SABADO, MEDIODIA, $sabado, $mediodia);
            $sabado = $this -> set_medicamentos($id_paciente, SABADO, TARDE, $sabado, $tarde);
            $sabado = $this -> set_medicamentos($id_paciente, SABADO, NOCHE, $sabado, $noche);
            /*
            $medicacion = array(
                "nombre" => "medicacion1",
                "dosis" => "100",
                "hora" => "8:00",
            );
            */
            
            array_push($datos_envio, $domingo);
            array_push($datos_envio, $lunes);
            array_push($datos_envio, $martes);
            array_push($datos_envio, $miercoles);
            array_push($datos_envio, $jueves);
            array_push($datos_envio, $viernes);
            array_push($datos_envio, $sabado);
        }else{
            $datos_envio = array(
                "error" => true
            );
            $this -> response($datos_envio, 400);
        }
        
        
        $this->response($datos_envio, 200);
    }
    
    public function set_medicamentos($id_paciente, $dia, $parte_dia, $array_dia, $array_parte_dia){
        $result = $this -> pacientes_model -> medicacion($id_paciente, $dia, $parte_dia);
        if($result){
            foreach($result as $row){
                $medicacion = array(
                    "nombre" => $row -> nombre,
                    "dosis" => $row -> dosis,
                    "hora" => $row -> hora
                );
                array_push($array_parte_dia, $medicacion);
            }
        }
            array_push($array_dia, $array_parte_dia);

        return $array_dia;
        
    }
    
    public function registro_encuestas_get($id_paciente){
        if(isset($id_paciente)){
            $completadas = $this -> pacientes_model -> encuestas_hoy($id_paciente);
            $completada1 = false;
            $completada2 = false;
            if($completadas == 1){
                $completada1 = true;
            }elseif($completadas == 2){
                $completada1 = true;
                $completada2 = true;
            }
            $datos_envio = array(
                "error" => false,
                "encuestas_completadas" => $completadas,
                "encuesta1_completada"  => $completada1,
                "encuesta2_completada" => $completada2
            );
        }else{
            $datos_envio = array(
                "error" => true,
                "encuestas_completadas" => $completadas,
            ); 
        }
        $this->response($datos_envio, 200);
    }

    public function validar_post() {
        if ($this -> post() == null) {
            $datos_envio = array(
                    "error" => "true"    
                );
            $this->response($datos_envio, 404);
        }
        $datos_recibidos = $this->post();
        $nombre = $datos_recibidos['nombre'];
        $password = $datos_recibidos['password'];
        $result = $this -> pacientes_model -> obtener_credenciales($nombre, $password);
        if($result){
	    	foreach($result as $row){
	    	    $id_paciente = $row -> id_paciente;
	    	    $nombre_usuario = $row -> nombre_usuario;
	    	    $BDpassword = $row -> password;
	    	    $salt_bd = $row -> salt_bd;
	    	    $salt_pass = substr($password, 0, 10);
	    	    $salt = $salt_pass . $salt_bd;
                $pass = $this -> crypt_password($password, $salt);
	    	    $nombre = $row -> nombre;
	    	    $apellido1 = $row -> apellido1;
	    	    $apellido2 = $row -> apellido2;
	    	    $email = $row -> email;
	    	    $dni = $row -> dni;
	    	    $id_terapeuta = $row -> fk_terapeuta_paciente;
	    	    if(hash_equals($pass, $BDpassword)){
    	    	    $datos_envio     = array(
    	    	        "error" => false,
    	    	        "id_paciente" => $id_paciente,
                        "nombre_usuario" => $nombre_usuario,
                        "nombre"         => $nombre,
                        "apellido1"      => $apellido1,
                        "apellido2"      => $apellido2,
                        "email"          => $email,
                        "dni"            => $dni,
                        "idTerapeuta"    => $id_terapeuta,
                    );
                    $this->response($datos_envio, 200);
	    	    }else{
                    $datos_envio = array(
                        "error" => "true"    
                    );
                    $this->response($datos_envio, 401);
                }
	    	}
        }else{
            $datos_envio = array(
                "error" => "true"
            );
            $this->response($datos_envio, 402);
        }
        
        /*
        $datos_envio = array(
            "password" => $password,
            "salt_bd" => $salt_bd,
            "salt" => $salt,
            "pass" => $pass
        );
        $this -> response($datos_envio, 200);
        */
    }
    
    public function crypt_password($password, $salt){
        return password_hash($password, PASSWORD_BCRYPT, array(
            'cost' => 12,
            'salt' => $salt
            ));
    }
    
    function randomString($length){
        $chars = "abcdefghijklmnopqrtsuvwxyz0123456789";
        srand((double)microtime()*1000000);
        $str = "";
        $i = 0;
        while($i <= $length){
            $num = rand() % strlen($chars);
            $tmp = substr($chars, $num, 1);
            $str = $str . $tmp;
            $i++;
        }
        return $str;
    }
    
    public function registrar_encuesta_post(){
        if ($this -> post() == null) {
            $datos_envio = array(
                    "error" => "true"    
                );
            $this->response($datos_envio, 404);
        }
        $datos_recibidos = $this->post();
        $registro_encuesta = $datos_recibidos['registro_encuesta'];
        
        //Parsear datos para introducirlos en la base de datos
        $registro_encuesta = json_decode($registro_encuesta);
        
        //Id del paciente
        $id_paciente = $registro_encuesta -> mIdPaciente;
        
        //Datos de la encuesta
        $tiempo_encuesta = gmdate("H:i:s", $registro_encuesta -> mTiempoEncuesta);
        $fecha = $registro_encuesta -> mFecha;
        $cambios_actividades = $registro_encuesta -> mCambiosActividades;
        $cambios_animo = $registro_encuesta -> mCambiosAnimo;
        $cambios_dolor = $registro_encuesta -> mCambiosDolor;
        $cambios_estado_fisico = $registro_encuesta -> mCambiosEstadoFisico;
        $cambios_nivel_dolor = $registro_encuesta -> mCambiosNivelDolor;
        $cambios_partes = $registro_encuesta -> mCambiosPartes;
        $cambios_sintomas = $registro_encuesta -> mCambiosSintomas;
        $cambios_sleep = $registro_encuesta -> mCambiosSleep;
        
        $registro = array(
            'fk_paciente_regencuesta' => $id_paciente,
            'fecha' => $fecha,
            'cambios_actividades' => $cambios_actividades,
            'cambios_animo' => $cambios_animo,
            'cambios_dolor' => $cambios_dolor,
            'cambios_nivel_dolor' => $cambios_nivel_dolor,
            'cambios_partes' => $cambios_partes,
            'cambios_sleep' => $cambios_sleep,
            'cambios_sintomas' => $cambios_sintomas,
            'cambios_estado_fisico' => $cambios_estado_fisico,
            'tiempo_encuesta' => $tiempo_encuesta
        );
        
        $this -> pacientes_model -> registrar_encuesta($registro);
        
        //Animo
        $animo = $registro_encuesta -> mAnimo;
        $result = $this -> pacientes_model -> get_id_animo($animo);
        foreach ($result as $row){
            $id_animo = $row -> id_animo;
        }
        $registro_animo = array(
                'fk_animo_reganimo' => $id_animo,
                'fk_paciente_reganimo' => $id_paciente,
                'fecha' => $fecha
        );
        
        $this -> pacientes_model -> registrar_animo($registro_animo);
        
        //Sintomas
        if (isset($registro_encuesta -> mSintomas)){
            $sintomas = array();
            foreach($registro_encuesta -> mSintomas as $sintoma){
                array_push($sintomas, $sintoma);
            }
            
            $id_sintomas = array();
            foreach($sintomas as $sintoma){
                $result = $this -> pacientes_model -> get_id_sintoma($sintoma);
                foreach ($result as $row){
                    $id_sintoma = $row -> id_sintoma;
                }
                array_push($id_sintomas, $id_sintoma);
            }
            foreach($id_sintomas as $id_sintoma){
                $registro_sintoma = array(
                    'fk_sintoma_regsintoma' => $id_sintoma,
                    'fk_paciente_regsintoma' => $id_paciente,
                    'fecha' => $fecha
                );
                $this -> pacientes_model -> registrar_sintoma($registro_sintoma);
            }
        }
        
        //Actividades
        if (isset($registro_encuesta -> mActividades)){
            $actividades = array();
            foreach($registro_encuesta -> mActividades as $actividad){
                array_push($actividades, $actividad);
            }
            $id_actividades = array();
            foreach($actividades as $actividad){
                $result = $this -> pacientes_model -> get_id_actividad($actividad);
                foreach ($result as $row){
                    $id_actividad = $row -> id_actividad;
                }
                array_push($id_actividades, $id_actividad);
            }
            foreach($id_actividades as $id_actividad){
                $registro_actividad = array(
                    'fk_actividad_regactividad' => $id_actividad,
                    'fk_paciente_regsintoma' => $id_paciente,
                    'fecha' => $fecha
                );
                $this -> pacientes_model -> registrar_actividad($registro_actividad);
            }
        }
        
        //Sleep
        if (isset($registro_encuesta -> mSleep)){
            $sleep = $registro_encuesta -> mSleep;
            $result = $this -> pacientes_model -> get_id_sleep($sleep);
            foreach ($result as $row){
                $id_sleep = $row -> id_sleep_quality;
            }
            $registro_sleep = array(
                    'fk_sleep_regsleep' => $id_sleep,
                    'fk_paciente_regsleep' => $id_paciente,
                    'fecha' => $fecha
            );
        
            $this -> pacientes_model -> registrar_sleep($registro_sleep);
        }
 
        //Meteorologia
        $temperatura = $registro_encuesta -> mTemperatura;
        $descripcion_tiempo = $registro_encuesta -> mTiempoDescripcion;
        $registro_meteorologia = array(
            'fk_paciente_regmeteorologico' => $id_paciente,
            'fecha' => $fecha,
            'descripcion' => $descripcion_tiempo,
            'temperatura' => $temperatura
        );
        $this -> pacientes_model -> registrar_meteorologia($registro_meteorologia);
        
        //Estado fisico
        $estado_fisico = $registro_encuesta -> mEstadoFisico;
        $result = $this -> pacientes_model -> get_id_fisico($estado_fisico);
        foreach ($result as $row){
            $id_estado_fisico = $row -> id_estado_fisico;
        }
        $registro_estado_fisico = array(
                'fk_fisico_regfisico' => $id_estado_fisico,
                'fk_paciente_regfisico' => $id_paciente,
                'fecha' => $fecha
        );
        
        $this -> pacientes_model -> registrar_estado_fisico($registro_estado_fisico);
        
        //Dolor
        if ($registro_encuesta -> mDolor){
            $dolor = 1;
            $nivel_dolor = $registro_encuesta -> mNivelDolor;
            $partes_dolor = array();
            foreach($registro_encuesta -> mPartes as $parte){
                array_push($partes_dolor, $parte);
            }
            $id_partes = array();
            foreach($partes_dolor as $parte){
                $result = $this -> pacientes_model -> get_id_parte_dolor($parte);
                foreach ($result as $row){
                    $id_parte = $row -> id_parte;
                }
                array_push($id_partes, $id_parte);
            }
            foreach($id_partes as $id_parte){
                $registro_dolor = array(
                    'fk_parte_regdolor' => $id_parte,
                    'fk_paciente_regdolor' => $id_paciente,
                    'fecha' => $fecha,
                    'nivel_dolor' => $nivel_dolor,
                    'tiene_dolor' => $dolor 
                );
                $this -> pacientes_model -> registrar_dolor($registro_dolor);
            }
        }else{
            $dolor = 0;
            $registro_dolor = array(
                    'fk_parte_regdolor' => 0,
                    'fk_paciente_regdolor' => $id_paciente,
                    'fecha' => $fecha,
                    'nivel_dolor' => 0,
                    'tiene_dolor' => $dolor 
                );
                $this -> pacientes_model -> registrar_dolor($registro_dolor);
        }
        
        
        //Respuesta a la aplicacion
        $datos_envio = array(
	        "error" => false,
	        "animo" => $registro_encuesta,
            
        );
        $this->response($datos_envio, 200);
    }
    
    
    
}
