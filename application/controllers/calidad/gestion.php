<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gestion extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();


        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
        $this->load->helper('layout');
        
        $this->folder = 'uploads/';
        $this->load->model("sugerencia_model");
        $this->load->model("reclamo_model");
        $this->load->model("comunas_model");
        $this->load->model("parametros_model");
        
        //die($this->session->userdata('acceso_ok').'okkk');
        if($this->session->userdata('acceso_ok') !== 'OK' ){
            $this->session->sess_destroy();
            header('location: http://www.cetep.cl/calidad');
        }
    }
    public function index()
    {
        
        $data['title']           = '';
        Layout_Helper::cargaVista($this,'inicio',$data,'ingresos');   
    }
    public function listar_felicitaciones()
    {
        $data['felicitaciones'] = $this->sugerencia_model->dameTodo();
        $data['menu']       = "listar";
        $data['submenu']    = "felicitaciones";
        $data['title']           = 'Listado de Sugerencias y Felicitaciones';
        Layout_Helper::cargaVista($this,'listar_felicitaciones',$data,'ingresos');   
    }
     public function listar_reclamos()
    {
        $data['reclamos'] = $this->reclamo_model->dameTodo();
        $data['menu']       = "listar";
        $data['submenu']    = "reclamos";
        $data['title']           = 'Listado de Reclamos';
        Layout_Helper::cargaVista($this,'listar_reclamos',$data,'ingresos');   
    }



    public function cargarReenviarFelicitacion($id)
    {    
        $data['data']   = $this->sugerencia_model->dameUno($id);
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['title']           = "Felicitaciones o Sugerencias";
        $data['menu']       = "gestion";
        $data['submenu']    = "felicitacion";
        Layout_Helper::cargaVista($this,'felicitacion',$data,'ingresos');   
    }
    public function reenviarFelicitacion()
    {
        $id=$this->input->post('sugId');
        $dest=$this->input->post('emailDestino');
        
        $this->sugerencia_model->sugId = $id;
        $this->sugerencia_model->sugDestinatario = $dest;
        $this->sugerencia_model->guardar();
        
        $this->envioSugerencia($id,$dest);
    }
    public function felicitacion()
    {    
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['title']           = "Felicitaciones o Sugerencias";
        $data['menu']       = "gestion";
        $data['submenu']    = "felicitacion";
        Layout_Helper::cargaVista($this,'felicitacion',$data,'ingresos');   
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
        $data['title']      = "Reclamos";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'reclamo',$data,'ingresos');   
    }
    public function verReclamo($id)
    {   
        $data['finalizado'] = 'si';
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $envio = $this->reclamo_model->dameUno($id);
        //die(var_dump($envio));;
        $data['reclamo'] = $envio[0];
        IF(!empty($envio[1]))$data['unidadReclamo']   = $envio[1][0];
        $data['title']      = "Reclamos";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'reclamo',$data,'ingresos');   
    }
    public function cargarReclamo($id)
    {   
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $envio = $this->reclamo_model->dameUno($id);
        //die(var_dump($envio));;
        $data['reclamo'] = $envio[0];
        IF(!empty($envio[1]))$data['unidadReclamo']   = $envio[1][0];
        $data['title']      = "Reclamos";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'reclamo',$data,'ingresos');   
    }
    public function guardarReclamo()
    {
        $rut        = str_replace(array(".","-"), "", $this->input->post('rut'));
        $letra      = substr($rut,0,1);if ($letra === "1" || $letra === "2"){$rut = substr($rut, 0, 8);}else {$rut = substr($rut, 0, 7);}
        
        $recId=$this->input->post('recId');
        IF(!empty($recId)){
                $this->reclamo_model->recId = $recId;
                $this->reclamo_model->recFechaModificacion = date('Y-m-d H:i:s');
        }
        ELSE {
                $this->reclamo_model->recFecha = date('Y-m-d H:i:s');
        }
        $hechos = $this->input->post('hechos');        
        $peticion = $this->input->post('peticion');
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
        $this->reclamo_model->recConformidad = $this->input->post('check');
        $this->reclamo_model->recHechos       = $hechos;
        $this->reclamo_model->recPeticion       = $peticion;
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
        $estado = $this->input->post('estado');
        IF(!empty($estado))$this->reclamo_model->recEstado = $estado;
        $obser = $this->input->post('observacion');
        IF(!empty($obser))$this->reclamo_model->recObservacion = $obser;
       
        $this->reclamo_model->guardar();
        
        
        ////////AGREGA A PLANILLA/////////
        IF(empty($estado) || $estado === 1 || $estado === '1'){
            $this->parametros_model->plaUnidad  = $this->input->post('area');
            $this->parametros_model->plaNombre =$this->input->post('nombre');
            $this->parametros_model->plaApellido = $this->input->post('apePat');
            $this->parametros_model->plaUsuario = $this->session->userdata('id_usuario');
            $this->parametros_model->plaFecha = date('Y-m-d H:i:s');
            $this->parametros_model->plaMotivo = 2;
            $this->parametros_model->plaDescripcion = $this->input->post('hechos').' '.$this->input->post('peticion');
            $this->parametros_model->guardarPlanilla();
        }
        ////TERMINO GUARDAR PLANILLA
        
        
        
        
        IF(!empty($recId)){
            IF(!empty($obser) && !empty($estado) && $estado === '2'){$this->enviarRecordatorio($recId);}
            $this->listar_reclamos();
        }
        ELSE {
            $reclamo = $this->reclamo_model->dameUltimo($rut);
            $this->envioReclamo($reclamo->recId);
        }
    }
    public function enviarRecordatorio($recId)
    {
        $envio = $this->reclamo_model->dameUno($recId);
        $reclamo = $envio[0];
        $unidad   = $envio[1][0];
        $destinatario=$unidad->correoDirector.",".$unidad->correoJefe;
        $asunto = 'Observación a Reclamo';
        $resumen = 'Estimada Jefatura,<br><br>'
                . 'El departamento de Calidad, con respecto al reclamo N°'.$reclamo->recId.', a realizado la siguiente observación: <br><br><b><span style="color:red"><i>'.$reclamo->recObservacion.'</i></span></b>.<br><br>'
                . 'Para responderlo favor ingresar a la plataforma a traves de su <b>intracetep</b>-><b>unidad de calidad</b><br>';
                //. 'LINK: <a href="http://www.cetep.cl/calidad'.$reclamo->recId.'"><b>Responder</b></a>';
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        $headers .= "bcc: griedel@cetep.cl,calidad@cetep.cl";
        mail($destinatario,$asunto,$resumen,$headers) ;
    }
    public function envioSugerencia($id,$dest='')
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
        $email = strtoupper($sugerencia->sugEmail);
        $hecho = strtoupper($sugerencia->sugHechos);
        $uni = $sugerencia->sugUnidad;
            IF($uni === '10')$unidadDescripcion= 'IMPULSA'; 
            ELSEIF($uni === '4')$unidadDescripcion= 'UNIDAD ATENCIÓN CLÍNICA';
            ELSEIF($uni === '2')$unidadDescripcion= 'UNIDAD GESTION HOSPITALARIO';
            ELSEIF($uni === '3')$unidadDescripcion= 'UNIDAD PERITAJE CLÍNICO';
            ELSEIF($uni === '30')$unidadDescripcion= 'UNIDAD SALUD LABORAL';
            ELSEIF($uni === '13'){$unidadDescripcion= 'MIRANDES CLINICA';$mirandes='si';}
            ELSE $unidadDescripcion = $uni;
        $correoJefe = $this->sugerencia_model->dameCorreoUnidad($uni);
        
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
            //$headers .= "bcc: griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,".$correoJefe."\r\n";
            IF($mirandes==='si'){$headers .= "bcc: griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,dconcha@mirandes.cl,comunicaciones@cetep.cl,".$correoJefe."\r\n";}
            ELSE {$headers .= "bcc: griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,comunicaciones@cetep.cl,".$correoJefe."\r\n";}
         
        }
        ELSE {
            IF($mirandes==='si'){$headers .= "bcc: griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,dconcha@mirandes.cl,comunicaciones@cetep.cl\r\n";}
            ELSE {$headers .= "bcc: griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,comunicaciones@cetep.cl\r\n";}
            //$headers .= "bcc: griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl\r\n";
        }
        $asunto = 'Felicitación o sugerencia';
        //IF(!empty($email))$destinatario = $email; ELSE $destinatario = '';        
        $destinatario = 'calidad@cetep.cl';
        IF(!empty($dest)){$destinatario = $dest;$headers .= "cc: calidad@cetep.cl\r\n";}
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
        $comuna = strtoupper($reclamo->comNombre);$comuna = str_replace('&NTILDE;','Ñ',$comuna);
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
        
        
        
        $hecho = $reclamo->recHechos;
        $peticion = $reclamo->recPeticion;
        IF($reclamo->recConformidad==='on')$check='Si entiendo y acepto que puede ser necesario acceder a la información clínica para la investigación y respuesta de este caso';ELSE $check='';
        
        $resumen="
            Estimado $nombre,
                <br><br>
                Junto con saludarlo, le comunicamos que hemos recibido su reclamo, el cual será respondido dentro de los plazos legales
                <br><br>
        <table border='0'>
            <tr>
                <td rowspan='2' style='width:650px'>";
                    
                        IF($area === 'MIRANDES HD y RH' || $area === 'MIRANDES CLINICA ' || $area === 'MIRANDES HD CONCEPCION' || $area === 'MIRANDES HD RANCAGUA' ){
                                    $mirandes='si';
                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/mirAndes.png' >";
                        }ELSE {
                                    $mirandes='no';
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
                <td colspan='2'>Apoderado o Representante legal según ley N°20.584</td>
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
                <td>Teléfono</td>
                <td>".$telefono."</td>
                <td style='border:none'></td>
                <td>Teléfono</td>
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
                <td colspan='5'><span style='font-size:9px'><i>Indicación de los hechos que fundamente su reclamo y de la infracción a los derechos que contempla la ley:</i></span><br> ".$hecho."</td>
            </tr>
            <tr>
                <td colspan='5'><span style='font-size:9px'><i>Petición concreta:</i></span><br> ".$peticion."</td>
            </tr>
            <tr>
                <td colspan='5' style='border:none'>".$check."</td></tr>
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
        $asunto = 'Copia de su Reclamo - IMPORTANTE: Este correo es informativo y automatizado, favor no responder.';
        mail($destinatario,$asunto,$resumen,$headers) ;
    
        //ENVIO CON LINK PARA JEFE
        $headers2 = "MIME-Version: 1.0\r\n"; 
        $headers2 .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers2 .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        IF($mirandes==='si'){$headers2 .= "bcc: calidad@cetep.cl,griedel@cetep.cl,cbarrera@cetep.cl,dconcha@mirandes.cl,comunicaciones@cetep.cl,marcelapaz@cetep.cl\r\n";}
        ELSE $headers2 .= "bcc: calidad@cetep.cl,griedel@cetep.cl,cbarrera@cetep.cl,comunicaciones@cetep.cl,marcelapaz@cetep.cl\r\n";
        //$headers2 .= "bcc: calidad@cetep.cl,griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl\r\n";
        $destinatario=$unidad->correoDirector.",".$unidad->correoJefe;

        $resumen2 = 'Estimada Jefatura,<br><br>'
                . 'Se ha recibido el  reclamo descrito a continuación.<br>'
                . 'Para responderlo favor seguir el siguiente link ingresando con su usuario y clave de intracetep, o ingresar a la plataforma a traves de su <b>intracetep</b>-><b>unidad de calidad</b><br>'
                . 'LINK: <a href="http://www.cetep.cl/calidad/index.php"><b>Responder</b></a>';
    $resumen2 = $resumen2."<br><br>".$resumen;
    mail($destinatario,$asunto,$resumen2,$headers2) ;
    $data = array('recId' => $id);$this->session->set_userdata($data);	
    //echo $resumen;die;
    $this->load->view('panel/modals/guardar_exitoso');
    }
    
    public function noConforme()
    {
        $id_usuario      = $this->session->userdata('id_usuario');
        $colaborador    = $this->parametros_model->dameColaborador($id_usuario);
        $jefe                   = $this->parametros_model->dameJefe($id_usuario);
        $data['listarUnidades'] = $this->parametros_model->dameUnidadesApoyo();
        $data['listarTipos'] = $this->parametros_model->dameTipos();
            //die(var_dump($jefe));
        //die;
        IF(!empty($colaborador->idunidad) && $colaborador->idunidad==='31')$colaborador->idunidad=4;
        ELSEIF(!empty($colaborador->idunidad) && $colaborador->idunidad==='25')$colaborador->idunidad=3;
        ELSEIF(!empty($id_usuario) && $id_usuario==='141')$colaborador->idunidad=30;
             
        IF(!empty($colaborador)){
            //IF(strtoupper($jefe->nombre) === strtoupper($colaborador->nombre) && strtoupper($jefe->apellidoPaterno) === strtoupper($colaborador->apellidoPaterno)  || $colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '285' || $colaborador->id === '38'){
            IF(!empty($jefe)  || $colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '38'){
                $data['jefeUnidad'] = 'SI';
            }
            $data['datos']    = $this->parametros_model->dameTodoUnidad($colaborador->idunidad);
        }
        ELSE {
            $uspUnidad = $this->parametros_model->dameUnidadRevisoras($id_usuario); //die(var_dump($uspUnidad));
            $data['jefeUnidad'] = 'SI';
            $data['datos'] = $this->parametros_model->dameTodoUnidad($uspUnidad->uspUnidad);
           //die(var_dump($data['datos']));
        }
        
        $data['colaborador'] = $colaborador;
        $data['title']           = "Planilla de Producto / Servicio No Conforme";
        $data['menu']       = "planilla";
        $data['submenu']    = "planilla";
        Layout_Helper::cargaVista($this,'noConforme',$data,'ingresos');   
    }
    public function guardarNoConforme()
    {
        $colaborador = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
        
        $fecha = new datetime($this->input->post('fecha'));
        $fecha = $fecha->format('Y-m-d');
        $plaId = $this->input->post('plaId');
        IF(!empty($plaId)){
             $this->parametros_model->plaId = $plaId;
             $this->parametros_model->plaEdithUsuario = $this->session->userdata('id_usuario');
             $this->parametros_model->plaEdithFecha = date('Y-m-d H:i:s');
        }ELSE{
             $this->parametros_model->plaUsuario = $this->session->userdata('id_usuario');
             $this->parametros_model->plaFecha = date('Y-m-d H:i:s');
        }
            
        
        
        IF(empty($colaborador->idunidad) && $this->session->userdata('id_usuario') != '64' && $this->session->userdata('id_usuario') != '38'){
            $uspUnidad = $this->parametros_model->dameUnidadRevisoras($this->session->userdata('id_usuario'));
            $this->parametros_model->plaUnidad = $uspUnidad->uspUnidad;
            $this->parametros_model->plaNombre = $uspUnidad->uspNombre;
            $this->parametros_model->plaApellido = $uspUnidad->uspApellidoP;
        }ELSEIF($this->session->userdata('id_usuario') != '64' && $this->session->userdata('id_usuario') != '38') {
            $plaUnidad = $colaborador->idunidad;
            IF($plaUnidad==='25')$plaUnidad=3;
            $this->parametros_model->plaUnidad = $plaUnidad;
            $this->parametros_model->plaNombre = $colaborador->nombre;
            $this->parametros_model->plaApellido = $colaborador->apellidoPaterno;
        }
        
        $this->parametros_model->plaFechaHecho = $fecha;
        $this->parametros_model->plaMotivo = $this->input->post('motivo');
        $this->parametros_model->plaTipo = $this->input->post('plaTipo');
        $this->parametros_model->plaDescripcion = $this->input->post('descripcion');
        $this->parametros_model->plaAccion = $this->input->post('accion');
        
        $seguimiento = $this->input->post('seguimiento');
        $apoyo = $this->input->post('plaUnidadDeApoyo');
        IF(!empty($apoyo)){
            $apoyo = explode('_', $apoyo);
            $this->parametros_model->plaUnidadDeApoyo = $apoyo[0];
            $this->parametros_model->plaUnidadDeApoyoId = $apoyo[1];
        }
            $this->parametros_model->plaSeguimiento = $seguimiento;
            $this->parametros_model->plaProveedor = $this->input->post('proveedor');
            $this->parametros_model->plaCliente = $this->input->post('cliente');
            $this->parametros_model->plaProfesional = $this->input->post('profesional');
            $this->parametros_model->plaUnidadCheck = $this->input->post('unidadCheck');
            $this->parametros_model->plaNoAplica = $this->input->post('noaplica');
            $this->parametros_model->plaNoAplicaText = $this->input->post('plaNoAplicaText');
            $this->parametros_model->plaUnidadDeApoyoCheck = $this->input->post('plaUnidadDeApoyoCheck');
            $this->parametros_model->plaPaciente = $this->input->post('plaPaciente');
    //    }
        $this->parametros_model->guardarPlanilla();
        $this->noConforme();
    }
     public function listar_noConforme()
    {
        $data['datos']    = $this->parametros_model->dameTodo();
        //die(var_dump($data['datos']));
        $data['title']           = "Lista Planilla de Producto / Servicio No Conforme";
        $data['menu']       = "listar";
        $data['submenu']    = "noConforme";
        Layout_Helper::cargaVista($this,'listar_noConforme',$data,'ingresos');   
    }
    public function modificarNoConforme($id)
    {
        $data['listarUnidades'] = $this->parametros_model->dameUnidadesApoyo();
        $id_usuario = $this->session->userdata('id_usuario');
        $colaborador    = $this->parametros_model->dameColaborador($id_usuario);
        $jefe                   = $this->parametros_model->dameJefe($id_usuario);
        $data['listarTipos'] = $this->parametros_model->dameTipos();
        //IF(strtoupper($jefe->nombre) === strtoupper($colaborador->nombre) && strtoupper($jefe->apellidoPaterno) === strtoupper($colaborador->apellidoPaterno)  || $colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '285' || $colaborador->id === '38'){
        IF(!empty($colaborador) && (!empty($jefe)  || $colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '38')){
            $data['jefeUnidad'] = 'SI';
            $data['datos']    = $this->parametros_model->dameTodoUnidad($colaborador->idunidad);
        }ELSE {
            $uspUnidad = $this->parametros_model->dameUnidadRevisoras($id_usuario); //die(var_dump($uspUnidad));
            //$data['jefeUnidad'] = 'SI';
            $data['datos'] = $this->parametros_model->dameTodoUnidad($uspUnidad->uspUnidad);
        }
        
        $data['planilla']    = $this->parametros_model->dameUno($id);
        $data['colaborador'] = $colaborador;
        $data['title']           = "Planilla de Producto / Servicio No Conforme";
        $data['menu']       = "planilla";
        $data['submenu']    = "planilla";
        Layout_Helper::cargaVista($this,'noConforme',$data,'ingresos');   
    }
    
    
    
    public function verRespuesta($id)
    {
        $data['finalizado'] = 'si';
        IF(!empty($this->session->userdata('id_usuario'))){
            $colaborador    = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
            //IF($colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '285' || $colaborador->id === '38'){
            IF(!empty($colaborador->id) && ($colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '38')){
                $data['calidad'] = 'SI';
            }
        }
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $envio = $this->reclamo_model->dameUno($id);
        $data['respuesta'] = $this->reclamo_model->dameRespuesta($id);
        //die(var_dump( $data['respuesta'] ));
        $data['reclamo'] = $envio[0];
        //NO SE OCUPA????
        //$data['reclamo'] = $envio[0];
        IF(!empty($envio[1]))$data['unidadReclamo']   = $envio[1][0];
        $data['title']      = "Respuesta";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'respuesta',$data,'ingresos');   
    }
    public function cargarRespuesta($id)
    {
        IF(!empty($this->session->userdata('id_usuario'))){
            $colaborador    = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
            //IF($colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '285' || $colaborador->id === '38'){
            IF(!empty($colaborador->id) && ($colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '38')){
                $data['calidad'] = 'SI';
            }
        }
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $envio = $this->reclamo_model->dameUno($id);
        $data['respuesta'] = $this->reclamo_model->dameRespuesta($id);
        //die(var_dump( $data['respuesta'] ));
        $data['reclamo'] = $envio[0];
        //NO SE OCUPA????
        //$data['reclamo'] = $envio[0];
        IF(!empty($envio[1]))$data['unidadReclamo']   = $envio[1][0];
        $data['title']      = "Respuesta";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'respuesta',$data,'ingresos');   
    }
    
    public function guardarRespuesta()
    {//die('aca');
    //$this->enviarRespuesta($recId);die;
        $usuario = $this->session->userdata('id_usuario');
        IF(empty($usuario))$usuario='0';
        
        $recId = $this->input->post('recId');
        IF(!empty($recId))$this->reclamo_model->resReclamo = $recId;
        $this->reclamo_model->resUsuario = $usuario;
        $this->reclamo_model->resFecha = date('Y-m-d H:i:s');
        $this->reclamo_model->resHecho = $this->input->post('reclamo');
        $this->reclamo_model->resRespuesta = $this->input->post('respuesta');
        $this->reclamo_model->guardarRespuesta();
        unset($this->reclamo_model->resReclamo,$this->reclamo_model->resUsuario,$this->reclamo_model->resFecha,$this->reclamo_model->resHecho,$this->reclamo_model->resRespuesta);
        
        $enviar = $this->input->post('enviar');
        IF($enviar !== 'on' || empty($enviar))$enviar='off';
        $reclamo = $this->reclamo_model->dameUno($recId);
        //die($recId);
        
      //die($usuario);
        $colaborador    = $this->parametros_model->dameColaborador($usuario);
     //  die(var_dump($colaborador));
       
        IF(!empty($colaborador->correo) && $reclamo[1][0]->correoDirector === $colaborador->correo){$this->reclamo_model->recAutorizado = 'si'; $autorizado = 'si';}
        ELSE $autorizado = 'no';
        
        
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ENVIAR
 //    $enviar='on';
        IF(($enviar === 'off' && !empty($recId) && empty($colaborador) && $autorizado==='si' ) || ($autorizado==='si' && $enviar === 'off' && !empty($recId) && $colaborador->id !== '57' && $colaborador->id !== '64' && $colaborador->id !== '38' )){
                    $this->reclamo_model->recId = $recId;
                    $this->reclamo_model->recEstado = 4;
                    $this->reclamo_model->recFechaModificacion = date('Y-m-d H:i:s');

                    $this->reclamo_model->guardar();

                   $mail = 'calidad@cetep.cl';//DESDE
                    $header = 'From: ' . $mail . " \r\n";
                    $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
                    $header .= "Mime-Version: 1.0 \r\n";
                    $header .= "Content-Type: text/html";
                    $resumen=" Estimado departamento de calidad, <br><br>Se ha generado la respuesta a requerimiento N°".$recId.", favor revisar y posteriormente enviar resolución a paciente.<br><br>"
                            . "Este correo se ha generado automaticamente, favor no responder.<br><br>"
                            . "Atte<br>"
                            . "Cetep";
                    $headers = "MIME-Version: 1.0\r\n"; 
                    $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
                    $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
                    //$headers .= "Bcc: griedel@cetep.cl";
                    $headers .= "bcc: griedel@cetep.cl\r\n";

                    $destinatario = 'calidad@cetep.cl';
                    //$destinatario = 'griedel@cetep.cl';
                    $asunto = 'Gestion de Director de Unidad a Reclamo N° '.$recId;

                    //die($resumen);
                    mail($destinatario,$asunto,$resumen,$headers) ;
                    IF(empty($colaborador)){
                        $this->load->view('panel/layout/head');
                        $this->load->view('panel/modals/guardar_respuesta');
                    }
                    ELSE $this->listar_reclamos();
            
        }ELSEIF(($enviar === 'off' && !empty($recId) && empty($colaborador) && $autorizado==='no') || ($autorizado==='no' && $enviar === 'off' && !empty($recId) && $colaborador->id !== '57' && $colaborador->id !== '64' && $colaborador->id !== '38' )){
                    $this->reclamo_model->recId = $recId;
                    $this->reclamo_model->recEstado = 6;
                    $this->reclamo_model->recFechaModificacion = date('Y-m-d H:i:s');

                    $this->reclamo_model->guardar();

                    $mail = 'calidad@cetep.cl';//DESDE
                    $header = 'From: ' . $mail . " \r\n";
                    $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
                    $header .= "Mime-Version: 1.0 \r\n";
                    $header .= "Content-Type: text/html";
                    $resumen=" Estimado director, <br><br>La jefatura de su unidad ha generado la respuesta a requerimiento N°".$recId.", favor revisar y validar resolución.<br>"
                            . 'Para responderlo favor ingresar a la plataforma a traves de su <b>intracetep</b>-><b>unidad de calidad</b><br>'
                            . "Este correo se ha generado automaticamente, favor no responder.<br><br>"
                             . "Atte<br>"
                            . "Cetep";
                    $headers = "MIME-Version: 1.0\r\n"; 
                    $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
                    $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; 
                    $headers .= "cc: calidad@cetep.cl\r\n";
                    $headers .= "bcc: griedel@cetep.cl\r\n";

                    $destinatario = $reclamo[1][0]->correoDirector;
                    $asunto = 'Gestion de Jefe de Unidad a Reclamo N° '.$recId;

                    mail($destinatario,$asunto,$resumen,$headers) ;
                    IF(empty($colaborador)){
                        $this->load->view('panel/layout/head');
                        $this->load->view('panel/modals/guardar_respuesta');
                    }
                    ELSE $this->listar_reclamos();
            
        }ELSEIF($enviar === 'on' && !empty($recId) ){//<a  onclick="window.history.go(-1)" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
            
      //     $this->resumenRespuesta($recId);
          //  echo '<script>function arriba(){$("body,html").animate({scrollTop : 0}, 500);}</script>';
            //die;
       //     echo '<script>var envia = confirm("¿Esta seguro de enviar esta respuesta?");if(envia !=true){window.history.go(-2);return false;}</script>';
            
            //die('a respuesta'); 
            $this->reclamo_model->recId = $recId;
            $this->reclamo_model->recEstado = 3;
            $this->reclamo_model->recFechaModificacion = date('Y-m-d H:i:s');
            $this->reclamo_model->guardar();
            
            $this->enviarRespuesta($recId);
            $this->listar_reclamos();
        }ELSE {
        $this->cargarRespuesta($recId);
        }
        
    }
    
    public function enviarRespuesta($id)
    {
        $respuesta = $this->reclamo_model->dameRespuesta($id);
        $envio = $this->reclamo_model->dameUno($id);
        $reclamo = $envio[0];
        $unidad   = $envio[1][0];
        
        //die(var_dump($reclamo));
        $mail = 'calidad@cetep.cl';//DESDE
        $header = 'From: ' . $mail . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";
        
        $fecha = new DateTime($respuesta->resFecha);
        //$fecha = $fecha->format('d-m-Y');
        $mes = $fecha->format('m'); if($mes==='10')$mes='Octubre';elseif($mes==='11')$mes='Noviembre';elseif($mes==='12')$mes='Diciembre';elseif($mes==='01')$mes='Enero';elseif($mes==='02')$mes='Febrero';elseif($mes==='03')$mes='Marzo';elseif($mes==='04')$mes='Abril';elseif($mes==='05')$mes='Mayo';elseif($mes==='06')$mes='Junio';elseif($mes==='07')$mes='Julio';elseif($mes==='08')$mes='Agosto';elseif($mes==='09')$mes='Septiembre';
        $dia   = $fecha->format('d'); 
        $ano= $fecha->format('Y'); 
        $fecha = $dia.' de '.$mes.' de '.$ano;
                        
                        
        $fechaReclamo = new DateTime($reclamo->recFecha);
        //$fechaReclamo = $fechaReclamo->format('d-m-Y');
        $mes = $fechaReclamo->format('m'); if($mes==='10')$mes='Octubre';elseif($mes==='11')$mes='Noviembre';elseif($mes==='12')$mes='Diciembre';elseif($mes==='01')$mes='Enero';elseif($mes==='02')$mes='Febrero';elseif($mes==='03')$mes='Marzo';elseif($mes==='04')$mes='Abril';elseif($mes==='05')$mes='Mayo';elseif($mes==='06')$mes='Junio';elseif($mes==='07')$mes='Julio';elseif($mes==='08')$mes='Agosto';elseif($mes==='09')$mes='Septiembre';
        $dia   = $fechaReclamo->format('d'); 
        $ano= $fechaReclamo->format('Y'); 
        $fechaReclamo = $dia.' de '.$mes.' de '.$ano;
        
        
        $nombre = $reclamo->recNombre." ".$reclamo->recApePat." ".$reclamo->recApeMat;
        $area = strtoupper($unidad->descripcion); 
        $domicilio = $reclamo->recDomicilio;
        $comuna = strtoupper($reclamo->comNombre);$comuna = str_replace('&NTILDE;','Ñ',$comuna);
        //$telefono = $reclamo->recTelefono;
        $email = strtoupper($reclamo->recEmail);
        
        $respuestaHecho = $respuesta->resHecho;
        $respuestaHechoLargo = strlen($respuestaHecho);
        IF($respuestaHechoLargo<600)$respuestaHechoLargo=125;
        ELSEIF($respuestaHechoLargo<900)$respuestaHechoLargo=250;
        ELSE $respuestaHechoLargo=350;
        
        $respuestaRespuesta = $respuesta->resRespuesta;
        $respuestaRespuestaLargo = strlen($respuestaRespuesta);
         IF($respuestaRespuestaLargo<600)$respuestaRespuestaLargo=125;
        ELSEIF($respuestaRespuestaLargo<900)$respuestaRespuestaLargo=250;
        ELSE $respuestaRespuestaLargo=350;
        
        $apoNombre = strtoupper($reclamo->recApoNombre)." ".strtoupper($reclamo->recApoApePat)." ".strtoupper($reclamo->recApoApeMat);
        $apoDomicilio = strtoupper($reclamo->recApoDomicilio);
        $apoComuna = strtoupper($reclamo->comApoNombre);
        //$apoTelefono = $reclamo->recApoTelefono;
        $apoEmail = strtoupper($reclamo->recApoEmail);
        //$vinculo = $reclamo->recApoVinculo; IF($vinculo === '1')$vinculo = 'Rep. Legal'; ELSEIF($vinculo === '2') $vinculo = 'Apoderado'; ELSE $vinculo='';
        //$apoRespuesta = $reclamo->recApoRespuesta; IF($apoRespuesta === '1')$apoRespuesta = 'SI'; ELSEIF($apoRespuesta === '2') $apoRespuesta = 'NO'; ELSE $apoRespuesta= '';
        
        $director = $this->parametros_model->dameDirectorUnidad($unidad->id);
        
        $directorNombre = $director->nombre.' '.$director->apellidoPaterno.' '.$director->apellidoMaterno;
        $directorNombre = strtoupper($directorNombre);
        $directorFirma = $director->director;
        
        
        $correoJefe = $this->sugerencia_model->dameCorreoUnidad($unidad->id);
        //$hecho = $reclamo->recHechos;
        //$peticion = $reclamo->recPeticion;
        
        $resumen="
        <table border='0'>
            <tr>
                <td rowspan='2' style='width:650px'>";
                    
                        IF($area === 'MIRANDES HD y RH' || $area === 'MIRANDES CLINICA ' || $area === 'MIRANDES HD CONCEPCION' || $area === 'MIRANDES HD RANCAGUA' ){
                                    $mirandes = 'si';
                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/mirAndes.png' >";
                        }ELSE {
                                    $mirandes = 'no';
                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >";
                        }
         $resumen .="
                </td>
                <td style='width:50px'></td>
                <td ></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style='width:250px'>Santiago, ".$fecha."</td>
            </tr>
        </table>
        
        <table style='width:800px; border:none'>
            <tr>
                <td colspan='2' style='border:none'>De nuestra consideración:</td>
                <td style='border:none'></td>
                <td colspan='2' style='border:none'></td>
            </tr>
            <tr>
                <td style='width:100px;border:none'>Estimado(a)</td>
                <td style='width:300px;border:none'>".$nombre."</td>
                <td style='border:none'></td>
                <td style='width:100px;border:none'></td>
                <td style='width:300px;border:none'></td>
            </tr>
            
            
            <tr>
                <td style='border:none'>Domicilio:</td>
                <td style='border:none'>".$domicilio.", ".$comuna."</td>
                <td style='border:none'></td>
                <td style='border:none'></td>
                <td style='border:none'></td>
            </tr>
           
            <tr>
                <td style='border:none' colspan='5'><br></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none' align='justify' >En respuesta a su reclamo N° <b>".$reclamo->recId."</b> con fecha ".$fechaReclamo.", donde menciona: <br><br> <pre style='font-family: arial;font-size:14px'>".$respuestaHecho."</pre><br></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none' align='justify' ><br>Lamentamos los inconvenientes que estos hechos pudieran haberle ocasionado y sentimos muy sinceramente no haber respondido a sus expectativas, su reclamo ha sido registrado y revisado.<br><br></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none' align='justify' >Podemos informar que: <br><br><i><blockquote><pre>".$respuestaRespuesta."</pre></blockquote></i></td>
            </tr>
             <tr>
                    <td colspan='5' style='border:none' align='justify' ><br>Agradecemos que nos haya hecho llegar sus observaciones, esto nos permite poder seguir mejorando nuestra calidad y servicio a clientes</td>
                </tr>
            <tr>
                <td colspan='5' style='border:none;font-size:13px' align='justify' ><br><b>De conformidad a lo señalado en el reglamento del MINSAL sobre procedimientos de reclamo de la ley N°20.584, le informamos su facultad para recurrir ante la Superintendencia de Salud para presentar su reclamo.</b></td>
            </tr>
            
            <tr>
                <td colspan='2' style='border:none;' align='center'>
                        <img style='width: 80px; ' src='".base_url()."../assets/img/firmas/".$directorFirma.".jpg' >
                 </td>
                 <td></td>
                 <td colspan='2' style='border:none;'  align='center'>
                        <img style='width: 80px; ' src='".base_url()."../assets/img/calidad.png' >
                 </td>
            </tr>
            <tr>
                <td colspan='2' style='border:none;'  align='center'>
                        __________________________<br>
                        ".$directorNombre."<br>Director Médico<br>".$area."
                 </td>
                 <td></td>
                 <td colspan='2' style='border:none; vertical-align:top'  align='center'>
                        __________________________<br>
                        Revisión Departamento de Calidad
                 </td>
                
            </tr>
        </table>
        <br>
        ";

        
        
        
        
        
        
        
        
        
     // die($resumen);
        
        
        
        $resumenPDF="
        <table border='0'>
            <tr>
                <td></td>
                <td><br><br><br><br><br><br><br></td>
                <td></td>
                <td>Fecha ".$fecha."</td>
                    
            </tr>
        </table>
        
        <table style='width:800px; border:none'>
            <tr>
                <td>De nuestra consideración:</td>
                <td></td>
            </tr>
            <tr>
                <td>Estimado(a)</td>
                <td>".$nombre."</td>
            </tr>
            <tr>
                <td>Domicilio:<br></td>
                <td>".$domicilio.", ".$comuna."</td>
            </tr>
           
            </table>
            

            <table>
                <tr>
                    <td>En respuesta a su reclamo N° <b>".$reclamo->recId."</b> con fecha ".$fechaReclamo.", donde menciona: <br><br>".$respuestaHecho."<br></td>
                </tr>
                <tr>
                    <td><br>Lamentamos los inconvenientes que estos hechos pudieran haberle ocasionado y sentimos muy sinceramente el no haber respondido a sus expectativas, su reclamo ha sido registrado y revisado.<br><br></td>
                </tr>
                <tr>
                    <td>Habiendo revisado su caso, podemos informar que: <br><br> <i><blockquote>".$respuestaRespuesta."</blockquote></i></td>
                </tr>
                <tr>
                    <td><br>Agradecemos el que nos haya hecho llegar sus observaciones, esto nos permite poder seguir mejorando en nuestra calidad y servicio a nuestros clientes</td>
                </tr>
                <tr>
                    <td><br><b><h6>De conformidad a lo señalado en el reglamento del MINSAL sobre procedimientos de reclamo de la ley N°20.584, le informamos su facultad para recurrir ante la Superintendencia de Salud para presentar su reclamo.</h6></b></td>
                </tr>
            </table>
            

            <table>
            <tr>
                <td>
                        <br><br><br><br><br><br>
                 </td>
                 <td></td>
                 <td>
                 </td>
            </tr>
            <tr>
                <td>______________________<br>".$directorNombre."<br>Director Médico<br>".$area."
                 </td>
                 <td></td>
                 <td>_____________________<br>Revisión Departamento de Calidad
                 </td>
            </tr>
        </table>
        <br>
        ";
        
 /*       
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
        
        $pdf->setJPEGQuality(75);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('', '', 12, '', true);
        $pdf->AddPage();


        $pdf->Image(base_url()."../assets/img/firmas/".$directorFirma.".jpg", 20, 200, 40, 40, 'JPG', '', '', false, 150, '', false, false, 1, false, false, false);
        $pdf->Image(base_url()."../assets/img/calidad125.png", 138, 200, 40, 40, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        
        IF($area === 'MIRANDES HD y RH' || $area === 'MIRANDES CLINICA ' || $area === 'MIRANDES HD CONCEPCION' || $area === 'MIRANDES HD RANCAGUA' ){
            $pdf->Image(base_url()."../assets/img/mirAndes.png", 20, 20, 40, 30, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        }ELSE {
            $pdf->Image(base_url()."../assets/img/logo_vertical_cetep.png", 20, 20, 40, 30, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
              
        }
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $resumenPDF, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $nombre_archivo = "Reclamo".$reclamo->recId.".pdf";
        $path = $_SERVER['DOCUMENT_ROOT'] .'/qa/calidad/temporales/';
        $pdf->Output($path.$nombre_archivo, 'F');

//////ENVIAR CORREO
    $filename = $nombre_archivo;
    $ruta_completa = $path.$filename;
    $filename = $ruta_completa;
    $subject = "Respuesta de reclamo"; 
    $message = "Esta es el cuerpo de mensaje."; 
    $email = "griedel@cetep.cl";
    $email_to = $email;
    $email_from = 'calidad@cetep.cl';
	
    
  $separator = md5(time());

    $eol = PHP_EOL;

    $pdfdoc = file_get_contents($filename);
    $attachment = chunk_split(base64_encode($pdfdoc));

    $headers  = "From: \"Calidad\"<" . $email_from . ">".$eol;
    $headers .= "MIME-Version: 1.0".$eol; 
    $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

    $body = "--".$separator.$eol;
    $body .= "Content-Type: text/html; charset=\"utf-8\"".$eol;
    $body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
    $body .= $message.$eol;

    // adjunto
    $body .= "--".$separator.$eol;
    $body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
    $body .= "Content-Transfer-Encoding: base64".$eol;
    $body .= "Content-Disposition: attachment".$eol.$eol;
    $body .= $attachment.$eol;
    $body .= "--".$separator."--";
///////////////FALTAN MAS PRUEBAS FUNCIONA
  //  $error_ocurred = mail($email_to, $subject, $body, $headers);
 //   if(!$error_ocurred){
 //       echo "<center>Ocurrio un problema al enviar su información, intente mas tarde.<br/>";
 //       echo "Si el problema persiste contacte a un administrador.</center>";
 //   }else{
 //       echo "<center>Su informacion ha sido enviada correctamente a la direccion de email especificada.<br/>(sientase libre de cerrar esta ventana)</center>";
 //   }
    
    
    
*/
 
        
        
  ///////      die; ENVIAR¿?
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
         IF(!empty($correoJefe)){
            $correoJefe=$correoJefe->correoDirector.",".$correoJefe->correoJefe;
            //$headers .= "bcc: griedel@cetep.cl,calidad@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,".$correoJefe."\r\n";
            IF($mirandes==='si'){$headers .= "bcc: calidad@cetep.cl,griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,dconcha@mirandes.cl,comunicaciones@cetep.cl,".$correoJefe."\r\n";}
            ELSE {$headers .= "bcc: calidad@cetep.cl,griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,comunicaciones@cetep.cl,".$correoJefe."\r\n";}
         }ELSE {
            IF($mirandes==='si'){$headers .= "bcc: calidad@cetep.cl,griedel@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl,comunicaciones@cetep.cl,dconcha@mirandes.cl\r\n";}
            ELSE {$headers .= "bcc: calidad@cetep.cl,griedel@cetep.cl,cbarrera@cetep.cl,comunicaciones@cetep.cl,marcelapaz@cetep.cl\r\n";}
            //$headers .= "bcc: griedel@cetep.cl,calidad@cetep.cl,cbarrera@cetep.cl,marcelapaz@cetep.cl\r\n";
        }
        //$headers .= "Bcc: griedel@cetep.cl";
        //$headers .= "";
        //$headers .= "cc: griedel@cetep.cl";
        //$headers .= "cc: griedel@cetep.cl,calidad@cetep.cl,cbarrera@cetep.cl";
        IF(!empty($email))$destinatario = $email; ELSE $destinatario = '';
        //$destinatario = 'gerardo.riedel.c@gmail.com';
        $asunto = 'Resolución Reclamo - IMPORTANTE: Este correo es informativo y automatizado, favor no responder.';
        //echo $resumen;
       // die;
    mail($destinatario,$asunto,$resumen,$headers) ;
    //$data = array('recId' => $id);$this->session->set_userdata($data);	
    //echo $resumen;die;
    $this->load->view('panel/modals/guardar_exitoso');
    }
    
    
    public function resumenRespuesta($id)
    {
        $respuesta = $this->reclamo_model->dameRespuesta($id);
        $envio = $this->reclamo_model->dameUno($id);
        
        $reclamo = $envio[0];
        $unidad   = $envio[1][0];
        IF(!empty($unidad) || !empty($reclamo)){ echo '<script>alert("Error en cuentas de director o jefe de Unidad");window.history.go(-2);}</script>';};
           
        //die(var_dump($reclamo));
        $mail = 'calidad@cetep.cl';//DESDE
        $header = 'From: ' . $mail . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";
        
        $fecha = new DateTime($respuesta->resFecha);
        //$fecha = $fecha->format('d-m-Y');
        $mes = $fecha->format('m'); if($mes==='10')$mes='Octubre';elseif($mes==='11')$mes='Noviembre';elseif($mes==='12')$mes='Diciembre';elseif($mes==='01')$mes='Enero';elseif($mes==='02')$mes='Febrero';elseif($mes==='03')$mes='Marzo';elseif($mes==='04')$mes='Abril';elseif($mes==='05')$mes='Mayo';elseif($mes==='06')$mes='Junio';elseif($mes==='07')$mes='Julio';elseif($mes==='08')$mes='Agosto';elseif($mes==='09')$mes='Septiembre';
        $dia   = $fecha->format('d'); 
        $ano= $fecha->format('Y'); 
        $fecha = $dia.' de '.$mes.' de '.$ano;
                        
                        
        $fechaReclamo = new DateTime($reclamo->recFecha);
        //$fechaReclamo = $fechaReclamo->format('d-m-Y');
        $mes = $fechaReclamo->format('m'); if($mes==='10')$mes='Octubre';elseif($mes==='11')$mes='Noviembre';elseif($mes==='12')$mes='Diciembre';elseif($mes==='01')$mes='Enero';elseif($mes==='02')$mes='Febrero';elseif($mes==='03')$mes='Marzo';elseif($mes==='04')$mes='Abril';elseif($mes==='05')$mes='Mayo';elseif($mes==='06')$mes='Junio';elseif($mes==='07')$mes='Julio';elseif($mes==='08')$mes='Agosto';elseif($mes==='09')$mes='Septiembre';
        $dia   = $fechaReclamo->format('d'); 
        $ano= $fechaReclamo->format('Y'); 
        $fechaReclamo = $dia.' de '.$mes.' de '.$ano;
        
        
        $nombre = $reclamo->recNombre." ".$reclamo->recApePat." ".$reclamo->recApeMat;
        $area = strtoupper($unidad->descripcion);
        $domicilio = $reclamo->recDomicilio;
        $comuna = strtoupper($reclamo->comNombre);
        //$telefono = $reclamo->recTelefono;
        $email = strtoupper($reclamo->recEmail);
        
        $respuestaHecho = $respuesta->resHecho;
        $respuestaHechoLargo = strlen($respuestaHecho);
        IF($respuestaHechoLargo<600)$respuestaHechoLargo=125;
        ELSEIF($respuestaHechoLargo<900)$respuestaHechoLargo=250;
        ELSE $respuestaHechoLargo=350;
        
        $respuestaRespuesta = $respuesta->resRespuesta;
        $respuestaRespuestaLargo = strlen($respuestaRespuesta);
         IF($respuestaRespuestaLargo<600)$respuestaRespuestaLargo=125;
        ELSEIF($respuestaRespuestaLargo<900)$respuestaRespuestaLargo=250;
        ELSE $respuestaRespuestaLargo=350;
        
        $apoNombre = strtoupper($reclamo->recApoNombre)." ".strtoupper($reclamo->recApoApePat)." ".strtoupper($reclamo->recApoApeMat);
        $apoDomicilio = strtoupper($reclamo->recApoDomicilio);
        $apoComuna = strtoupper($reclamo->comApoNombre);
        //$apoTelefono = $reclamo->recApoTelefono;
        $apoEmail = strtoupper($reclamo->recApoEmail);
        //$vinculo = $reclamo->recApoVinculo; IF($vinculo === '1')$vinculo = 'Rep. Legal'; ELSEIF($vinculo === '2') $vinculo = 'Apoderado'; ELSE $vinculo='';
        //$apoRespuesta = $reclamo->recApoRespuesta; IF($apoRespuesta === '1')$apoRespuesta = 'SI'; ELSEIF($apoRespuesta === '2') $apoRespuesta = 'NO'; ELSE $apoRespuesta= '';
        
        $director = $this->parametros_model->dameDirectorUnidad($unidad->id);
        
        $directorNombre = $director->nombre.' '.$director->apellidoPaterno.' '.$director->apellidoMaterno;
        $directorNombre = strtoupper($directorNombre);
        $directorFirma = $director->director;
        
        
        $correoJefe = $this->sugerencia_model->dameCorreoUnidad($unidad->id);
      
        
        $resumen="
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
                <td style='width:50px'></td>
                <td ></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style='width:250px'>Santiago, ".$fecha."</td>
            </tr>
        </table>
        
        <table style='width:800px; border:none'>
            <tr>
                <td colspan='2' style='border:none'>De nuestra consideración:</td>
                <td style='border:none'></td>
                <td colspan='2' style='border:none'></td>
            </tr>
            <tr>
                <td style='width:100px;border:none'>Estimado(a)</td>
                <td style='width:300px;border:none'>".$nombre."</td>
                <td style='border:none'></td>
                <td style='width:100px;border:none'></td>
                <td style='width:300px;border:none'></td>
            </tr>
            
            
            <tr>
                <td style='border:none'>Domicilio:</td>
                <td style='border:none'>".$domicilio.", ".$comuna."</td>
                <td style='border:none'></td>
                <td style='border:none'></td>
                <td style='border:none'></td>
            </tr>
           
            <tr>
                <td style='border:none' colspan='5'><br></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none' align='justify' >En respuesta a su reclamo N° <b>".$reclamo->recId."</b> con fecha ".$fechaReclamo.", donde menciona: <br><br> <pre style='font-family: arial;font-size:14px'>".$respuestaHecho."</pre><br></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none' align='justify' ><br>Lamentamos los inconvenientes que estos hechos pudieran haberle ocasionado y sentimos muy sinceramente no haber respondido a sus expectativas, su reclamo ha sido registrado y revisado.<br><br></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none' align='justify' >Podemos informar que: <br><br><i><blockquote><pre>".$respuestaRespuesta."</pre></blockquote></i></td>
            </tr>
             <tr>
                    <td colspan='5' style='border:none' align='justify' ><br>Agradecemos que nos haya hecho llegar sus observaciones, esto nos permite poder seguir mejorando nuestra calidad y servicio a clientes</td>
                </tr>
            <tr>
                <td colspan='5' style='border:none;font-size:13px' align='justify' ><br><b>De conformidad a lo señalado en el reglamento del MINSAL sobre procedimientos de reclamo de la ley N°20.584, le informamos su facultad para recurrir ante la Superintendencia de Salud para presentar su reclamo.</b></td>
            </tr>
            
            <tr>
                <td colspan='2' style='border:none;' align='center'>
                        <img style='width: 80px; ' src='".base_url()."../assets/img/firmas/".$directorFirma.".jpg' >
                 </td>
                 <td></td>
                 <td colspan='2' style='border:none;'  align='center'>
                        <img style='width: 80px; ' src='".base_url()."../assets/img/calidad.png' >
                 </td>
            </tr>
            <tr>
                <td colspan='2' style='border:none;'  align='center'>
                        __________________________<br>
                        ".$directorNombre."<br>Director Médico<br>".$area."
                 </td>
                 <td></td>
                 <td colspan='2' style='border:none; vertical-align:top'  align='center'>
                        __________________________<br>
                        Revisión Departamento de Calidad
                 </td>
                
            </tr>
        </table>
        <br>
        ";

        echo $resumen;
        echo '<script>var envia = confirm("¿Esta seguro de enviar esta respuesta?");if(envia !=true){window.history.go(-2);}</script>';
        sleep(10);
    //$this->load->view('panel/modals/guardar_exitoso');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    ///////////////////////////JEFE//////////////////////
    public function listar_felicitaciones_jefe()
    {
        $data['felicitaciones'] = $this->sugerencia_model->dameTodo();
        $data['menu']       = "listar";
        $data['submenu']    = "felicitaciones";
        $data['title']           = 'Listado de Sugerencias y Felicitaciones';
        Layout_Helper::cargaVista($this,'listar_felicitaciones',$data,'ingresos');   
    }
     public function listar_reclamos_jefe()
    {
        $colaborador = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
  //      die(var_dump($colaborador));
             IF($colaborador->idunidad==='31')$colaborador->idunidad=4;
             ELSEIF($colaborador->idunidad==='25')$colaborador->idunidad=3;
             ELSEIF($this->session->userdata('id_usuario')==='141')$colaborador->idunidad=30;
        IF(empty($colaborador->idunidad)){
           
            $uspUnidad = $this->parametros_model->dameUnidadRevisoras($this->session->userdata('id_usuario'));
            $this->parametros_model->plaUnidad = $uspUnidad->uspUnidad;
            $this->parametros_model->plaNombre = $uspUnidad->uspNombre;
            $this->parametros_model->plaApellido = $uspUnidad->uspApellidoP;
            $data['reclamos'] = $this->reclamo_model->dameTodoJefe($uspUnidad->uspUnidad);
        }ELSE {
            $plaUnidad = $colaborador->idunidad;
            IF($plaUnidad==='25')$plaUnidad=3;
            ELSEIF($plaUnidad==='31')$plaUnidad=4;
            $this->parametros_model->plaUnidad = $plaUnidad;
            $this->parametros_model->plaNombre = $colaborador->nombre;
            $this->parametros_model->plaApellido = $colaborador->apellidoPaterno;
            $data['reclamos'] = $this->reclamo_model->dameTodoJefe($colaborador->idunidad);
        }
        
        
        $data['menu']       = "listar";
        $data['submenu']    = "reclamos";
        $data['title']           = 'Listado de Reclamos';
        Layout_Helper::cargaVista($this,'listar_reclamos',$data,'ingresos');   
    }
    
    
    
    
    
    
    public function generar($resumen) {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetAuthor('Israel Parra');
        //$pdf->SetTitle('Ejemplo de provincías con TCPDF');
        //$pdf->SetSubject('Tutorial TCPDF');
        //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        
 
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $resumen, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $prov=1;
 
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
    
}
