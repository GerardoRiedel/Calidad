<?php defined('BASEPATH') OR exit('No direct script access allowed');

class sugerencia extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('download', 'file','url', 'html', 'form'));
        $this->load->library(array('session','form_validation'));
        $this->load->helper('layout');
        
        $this->folder = 'uploads/';
        $this->load->model("sugerencia_model");
        $this->load->model("reclamo_model");
        $this->load->model("comunas_model");
        $this->load->model("parametros_model");
    }
    public function inicio()
    {  
        $data['menu']       = "gestion";
        //$data['submenu']    = "felicitacion";
        Layout_Helper::cargaVista($this,'inicio',$data,'visita');   
    }
    public function felicitacion()
    {  //die('aca'); 
    
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['title']           = "Felicitaciones o Sugerencias";
        $data['menu']       = "gestion";
        $data['submenu']    = "felicitacion";
        Layout_Helper::cargaVista($this,'felicitacion',$data,'visita');   
    }
    public function guardarSugerencia()
    {
        $rut        = str_replace(array(".","-"), "", $this->input->post('rut'));
        $letra      = substr($rut,0,1);if ($letra === "1" || $letra === "2"){$rut = substr($rut, 0, 8);}else {$rut = substr($rut, 0, 7);}
        
        $this->sugerencia_model->sugFecha         = date('Y-m-d H:i:s');
        $this->sugerencia_model->sugRut               = $rut;
        $this->sugerencia_model->sugNombre      = $this->input->post('nombre');
        $this->sugerencia_model->sugApePat        = $this->input->post('apePat');
        $this->sugerencia_model->sugApeMat        = $this->input->post('apeMat');
        $this->sugerencia_model->sugDomicilio    = $this->input->post('domicilio');
        $this->sugerencia_model->sugComuna     = $this->input->post('comuna');
        $this->sugerencia_model->sugTelefono     = $this->input->post('telefono');
        $this->sugerencia_model->sugEmail           = $this->input->post('email');
        $this->sugerencia_model->sugHechos       = $this->input->post('hechos');
        $this->sugerencia_model->sugUsuario       = $this->session->userdata('id_usuario');
        $this->sugerencia_model->sugUnidad       = $this->input->post('area');
        $this->sugerencia_model->guardar();
        
        $sugerencia = $this->sugerencia_model->dameUltimo($rut);
        
        $this->envioSugerencia($sugerencia->sugId);
    }
    
     public function reclamo()
    {   
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $data['title']           = "Reclamos";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'reclamo',$data,'visita');   
    }
    public function guardarReclamo()
    {
        $rut        = str_replace(array(".","-"), "", $this->input->post('rut'));
        $letra      = substr($rut,0,1);if ($letra === "1" || $letra === "2"){$rut = substr($rut, 0, 8);}else {$rut = substr($rut, 0, 7);}
        
        $this->reclamo_model->recFecha         = date('Y-m-d H:i:s');
        $this->reclamo_model->recRut               = $rut;
        $this->reclamo_model->recNombre      = $this->input->post('nombre');
        $this->reclamo_model->recApePat        = $this->input->post('apePat');
        $this->reclamo_model->recApeMat        = $this->input->post('apeMat');
        $this->reclamo_model->recArea             = $this->input->post('area');
        $this->reclamo_model->recDomicilio    = $this->input->post('domicilio');
        $this->reclamo_model->recComuna     = $this->input->post('comuna');
        $this->reclamo_model->recTelefono     = $this->input->post('telefono');
        $this->reclamo_model->recEmail           = $this->input->post('email');
        $this->reclamo_model->recRespuesta = $this->input->post('respuesta');
        $this->reclamo_model->recHechos       = $this->input->post('hechos');
        $this->reclamo_model->recPeticion       = $this->input->post('peticion');
        $this->reclamo_model->recUsuario       = $this->session->userdata('id_usuario');
        
        $apoRut = $this->input->post('apoRut');
        IF(!empty($apoRut)){
            $apoRut        = str_replace(array(".","-"), "",$apoRut);
            $letra      = substr($apoRut,0,1);if ($letra === "1" || $letra === "2"){$apoRut = substr($apoRut, 0, 8);}else {$apoRut = substr($apoRut, 0, 7);}
                
            $this->reclamo_model->recApoRut              = $apoRut;
            $this->reclamo_model->recApoNombre      = $this->input->post('apoNombre');
            $this->reclamo_model->recApoApePat        = $this->input->post('apoApePat');
            $this->reclamo_model->recApoApeMat       = $this->input->post('apoApeMat');
            $this->reclamo_model->recApoVinculo       = $this->input->post('vinculo');
            $this->reclamo_model->recApoDomicilio   = $this->input->post('apoDomicilio');
            $this->reclamo_model->recApoComuna     = $this->input->post('apoComuna');
            $this->reclamo_model->recApoTelefono     = $this->input->post('apoTelefono');
            $this->reclamo_model->recApoEmail          = $this->input->post('apoEmail');
            $this->reclamo_model->recApoRespuesta = $this->input->post('apoRespuesta');
        }
        $this->reclamo_model->guardar();
        
        $reclamo = $this->reclamo_model->dameUltimo($rut);
        $this->envioReclamo($reclamo->recId);
    }
    
    
    
    
    public function envioSugerencia($id)
    {
    $sugerencia = $this->sugerencia_model->dameUno($id);
        
        $mail = 'calidad@cetep.cl';//DESDE
        $header = 'From: ' . $mail . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";
        
        $fecha = new DateTime($sugerencia->sugFecha);
        $fecha = $fecha->format('d-m-Y');
        $nombre = strtoupper($sugerencia->sugNombre)." ".strtoupper($sugerencia->sugApePat)." ".strtoupper($sugerencia->sugApeMat);
        $domicilio = strtoupper($sugerencia->sugDomicilio);
        $comuna = strtoupper($sugerencia->comNombre);
        $telefono = $sugerencia->sugTelefono;
        $uni = $sugerencia->sugUnidad;
            IF($uni === '10')$unidadDescripcion= 'IMPULSA'; 
            ELSEIF($uni === '4')$unidadDescripcion= 'UNIDAD ATENCIÓN CLÍNICA';
            ELSEIF($uni === '2')$unidadDescripcion= 'UNIDAD GESTION HOSPITALARIO';
            ELSEIF($uni === '3')$unidadDescripcion= 'UNIDAD PERITAJE CLÍNICO';
            ELSEIF($uni === '30')$unidadDescripcion= 'SALUD MENTAL LABORAL';
            ELSE $unidadDescripcion = $uni;
        $correoJefe = $this->sugerencia_model->dameCorreoUnidad($uni);
        $email = strtoupper($sugerencia->sugEmail);
        $hecho = strtoupper($sugerencia->sugHechos);
        $resumen="
        <table border='0' style='width:700px'>
            <tr>
                <td>
                    <img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >
                    <img style='width: 35%; ' src='".base_url()."../assets/img/mirAndes.png' >
                </td>
                <td style='border-left:none' align='right'>Fecha ".$fecha."</td>
                
            </tr>
        </table>
        
        <table border='1' style='width:700px'>
            <tr>
                <td colspan='2'>Paciente</td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td>".$nombre."</td>
            </tr>
            <tr>
                <td>Rut</td>
                <td>".$sugerencia->sugRut."</td>
            </tr>
            <tr>
                <td>Domicilio</td>
                <td>".$domicilio."</td>
            </tr>
            <tr>
                <td>Comuna</td>
                <td>".$comuna."</td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td>".$telefono."</td>
            </tr>
            <tr>
                <td>Mail</td>
                <td>".$email."</td>
            </tr>
            <tr>
                <td>Unidad</td>
                <td>".$unidadDescripcion."</td>
            </tr>
            <tr>
                <td colspan='2'>Felicitación o Sugerencia</td>
            </tr>
            <tr>
                <td colspan='2'>".$hecho."</td>
            </tr>
        </table>
        <br>
        
        ";

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        
        IF(!empty($correoJefe)){
            $correoJefe=$correoJefe->correoDirector.",".$correoJefe->correoJefe;
            $headers .= "cc: griedel@cetep.cl,".$correoJefe;
        }
        ELSE $headers .= "cc: griedel@cetep.cl";
        //$headers .= "Cc: griedel@cetep.cl";
        //echo $correoJefe;
        //die(var_dump($headers));
        $asunto = 'Felicitación o sugerencia';
        //IF(!empty($email))$destinatario = $email; ELSE $destinatario = '';        
        $destinatario = 'calidad@cetep.cl';
    mail($destinatario,$asunto,$resumen,$headers) ;
    $data = array('recId' => '');$this->session->set_userdata($data);	
    //echo $resumen;die;
    $this->load->view('panel/modals/guardar_exitoso');
    }
    
    public function envioReclamo($id)
    {
        $envio = $this->reclamo_model->dameUno($id);
        $reclamo = $envio[0];
        $unidad   = $envio[1][0];
        //die(var_dump($unidad));
        $mail = 'calidad@cetep.cl';//DESDE
        $header = 'From: ' . $mail . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";
        
        $fecha = new DateTime($reclamo->recFecha);
        $fecha = $fecha->format('d-m-Y');
        $nombre = strtoupper($reclamo->recNombre)." ".strtoupper($reclamo->recApePat)." ".strtoupper($reclamo->recApeMat);
        $area = strtoupper($unidad->descripcion);
        $domicilio = strtoupper($reclamo->recDomicilio);
        $comuna = strtoupper($reclamo->comNombre);
        $telefono = $reclamo->recTelefono;
        $email = strtoupper($reclamo->recEmail);
        $respuesta = $reclamo->recRespuesta; IF($respuesta === '1')$respuesta = 'SI'; ELSE $respuesta = 'NO';
        
        $apoNombre = strtoupper($reclamo->recApoNombre)." ".strtoupper($reclamo->recApoApePat)." ".strtoupper($reclamo->recApoApeMat);
        $apoDomicilio = strtoupper($reclamo->recApoDomicilio);
        $apoComuna = strtoupper($reclamo->comApoNombre);
        $apoTelefono = $reclamo->recApoTelefono;
        $apoEmail = strtoupper($reclamo->recApoEmail);
        $vinculo = $reclamo->recApoVinculo; IF($vinculo === '1')$vinculo = 'Rep. Legal'; ELSEIF($vinculo === '2') $vinculo = 'Apoderado'; ELSE $vinculo='';
        $apoRespuesta = $reclamo->recApoRespuesta; IF($apoRespuesta === '1')$apoRespuesta = 'SI'; ELSEIF($apoRespuesta === '2') $apoRespuesta = 'NO'; ELSE $apoRespuesta= '';
        
        ////////AGREGA A PLANILLA/////////
        //$colaborador = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
        
        //$fecha = new datetime($this->input->post('fecha'));
        //$fecha = date('Y-m-d');
        //$plaId = $this->input->post('plaId');
       
        $this->parametros_model->plaUsuario = $this->session->userdata('id_usuario');
        $this->parametros_model->plaFecha = date('Y-m-d H:i:s');
       
            
        //$this->parametros_model->plaNombre = $colaborador->nombre;
        //$this->parametros_model->plaApellido = $colaborador->apellidoPaterno;
        $this->parametros_model->plaUnidad = $unidad->id;
        //$this->parametros_model->plaFechaHecho = $fecha;
        $this->parametros_model->plaMotivo = 2;
        $this->parametros_model->plaDescripcion = $this->input->post('hechos').' '.$this->input->post('peticion');
        //$this->parametros_model->plaAccion = $this->input->post('accion');
        
        $this->parametros_model->guardarPlanilla();
        ////TERMINO GUARDAR PLANILLA
        
        $hecho = $reclamo->recHechos;
        $peticion = $reclamo->recPeticion;
        
        $resumen="
            Estimado $nombre,
                <br><br>
                Junto con saludarlo, le comunicamos que hemos recibido su reclamo:
                <br><br>
        <table border='0'>
            <tr>
                <td rowspan='2' style='width:650px'>";
                    
                        IF($area === 'MIRANDES HD y RH' || $area === 'MIRANDES CLINICA ' || $area === 'MIRANDES HD CONCEPCION' || $area === 'MIRANDES HD RANCAGUA' ){

                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/mirAndes.png' >";
                        }ELSE {
                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >";
                        }
         $resumen .="
                </td>
                <td style='width:50px'>N°</td>
                <td style='width:100px'>".$reclamo->recId."</td>
            </tr>
            <tr>
                <td>Fecha</td>
                <td>".$fecha."</td>
            </tr>
        </table>
        
        <table border='1' style='width:800px'>
            <tr>
                <td colspan='2'>Paciente</td>
                <td style='border:none'></td>
                <td colspan='2'>Apoderado o Representancte legal según ley N°20.584</td>
            </tr>
            <tr>
                <td style='width:199px'>Nombre y Apellido</td>
                <td style='width:200px'>".$nombre."</td>
                <td style='border:none'></td>
                <td style='width:199px'>Nombre y Apellido</td>
                <td style='width:200px'>".$apoNombre."</td>
            </tr>
            <tr>
                <td>Área o dependencia de atención</td>
                <td>".$area."</td>
                <td style='border:none'></td>
                <td>Vinculo con el paciente</td>
                <td>".$vinculo."</td>
            </tr>
            <tr>
                <td>Rut</td>
                <td>".$reclamo->recRut."</td>
                <td style='border:none'></td>
                <td>Rut</td>
                <td>".$reclamo->recApoRut."</td>
            </tr>
            <tr>
                <td>Domicilio</td>
                <td>".$domicilio."</td>
                <td style='border:none'></td>
                <td>Domicilio</td>
                <td>".$apoDomicilio."</td>
            </tr>
            <tr>
                <td>Comuna</td>
                <td>".$comuna."</td>
                <td style='border:none'></td>
                <td>Comuna</td>
                <td>".$apoComuna."</td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td>".$telefono."</td>
                <td style='border:none'></td>
                <td>Telefono</td>
                <td>".$apoTelefono."</td>
            </tr>
            <tr>
                <td>Mail</td>
                <td>".$email."</td>
                <td style='border:none'></td>
                <td>Mail</td>
                <td>".$apoEmail."</td>
            </tr>
            <tr>
                <td>Autoriza respuesta correo electrónico</td>
                <td>".$respuesta."</td>
                <td style='border:none'></td>
                <td>Autoriza respuesta correo electrónico</td>
                <td>".$apoRespuesta."</td>
            </tr>
            <tr>
                <td colspan='5'><i>Indicación de los hechos que fundamente su reclamo y de la infracción a los derechos que contempla la ley:</i><br> ".$hecho."</td>
            </tr>
            <tr>
                <td colspan='5'><i>Petición concreta:</i> <br> ".$peticion."</td>
            </tr>
            <tr>
                <td colspan='5' style='border:none'><input type='checkbox' checked>Entiendo y acepto que puede ser necesario acceder a la información clínica para la investigación y respuesta de este caso</td>
            </tr>
            <tr>
                <td colspan='5' style='border:none; font-size:9px'>De conformidad a lo señalado en el reglamento del MINSAL sobre procedimientos de reclamo de la ley N°20.584, le informamos su facultad para recurrir ante la Superintendencia de Salud para presentar su reclamo.</td>
            </tr>
        </table>
        <br>
        <br>
        Saludos Cordiales,
        <br>
        Cetep
        ";

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        //$headers .= "cc: ";
        
        //$headers .= "cc: calidad@cetep.cl,".$unidad->correoDirector.",".$unidad->correoJefe;
        //$headers .= "Bcc: calidad@cetep.cl,cbarrera@cetep.cl,".$unidad->mail;
        //$headers .= "Bcc: griedel@cetep.cl";
        
        //ENVIO A PACIENTE
        IF(!empty($email))$destinatario = $email; ELSE $destinatario = '';
        $asunto = 'Copia de su Reclamo';
        mail($destinatario,$asunto,$resumen,$headers) ;
   // die;
        //ENVIO CON LINK PARA JEFE
        $headers2 = "MIME-Version: 1.0\r\n"; 
        $headers2 .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers2 .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        $headers2 .= "cc: calidad@cetep.cl\r\n";
        $headers2 .= "bcc: griedel@cetep.cl\r\n";
        $destinatario=$unidad->correoDirector.",".$unidad->correoJefe;

        $resumen2 = 'Estimada Jefatura,<br><br>'
                . 'Se ha recibido el  reclamo descrito a continuación.<br>'
                . 'Para responderlo favor seguir el siguiente link o ingresar a la plataforma a traves de su <b>intranet</b>-><b>unidad de calidad</b><br>'
                . 'LINK: <a href="http://www.cetep.cl/calidad/index.php/calidad/gestion/cargarRespuesta/'.$reclamo->recId.'"><b>Responder</b></a>';
    $resumen2 = $resumen2."<br><br>".$resumen;
    mail($destinatario,$asunto,$resumen2,$headers2) ;
    $data = array('recId' => $id);$this->session->set_userdata($data);	
    //echo $resumen;die;
    $this->load->view('panel/modals/guardar_exitoso');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
