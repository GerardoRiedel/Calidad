<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 01/02/2017
 * Time: 14:00
 */
class Cron extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->model('cron_model');
        $this->load->model('reclamo_model');
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
    }
    
    public function index()
    {
        $resp = $this->cron_model->reclamos();
        
        foreach($resp as $res){
            $resumen = 'Envio recordatorios de reclamos de Calidad';
            $date       = new DateTime($res->recFecha);
            $fechaR     = $date->format('Y-m-d');
            $fechaE     = date('Y-m-d');
            $dias = $this->getDiasHabiles($fechaR,$fechaE); 
             IF($dias <10 && $dias >= 7){
                $resumen = '';
                $recId=$res->recId;
                $envio = $this->reclamo_model->dameUno($recId);
                $reclamo = $envio[0];
                $unidad   = $envio[1][0];
                $destinatario=$unidad->correoDirector.",".$unidad->correoJefe;
                $asunto = 'Recordatorio Vencimiento de Reclamo';
                $resumen = 'Estimada Jefatura,<br><br>'
                        . 'Con respecto al reclamo N°'.$reclamo->recId.', se le recuerda que han pasado '.$dias.' días habiles sin gestionar la respuesta.<br><br>'
                     //   . '<b><span style="color:red"><i>'.$reclamo->recObservacion.'</i></span></b>.<br><br>'
                        . 'Para responderlo favor ingresar a la plataforma a traves de su <b>intracetep</b>-><b>unidad de calidad</b> <i>responder reclamo</i><br>'
                         .'<br><br>'
                        .'Atentamente,<br><br>';
                $resumen .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style='width: 100px; ' src='".base_url()."../assets/img/calidad.png' >";
                        // . 'LINK: <a href="http://www.cetep.cl/calidad'.$reclamo->recId.'"><b>Responder</b></a>';
                $headers = "MIME-Version: 1.0\r\n"; 
                $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
                $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
                $headers .= "cc: griedel@cetep.cl,calidad@cetep.cl";
                //echo ('7');
                //echo $resumen;
                mail($destinatario,$asunto,$resumen,$headers) ;
                $resumen = 'Envio recordatorios de reclamos de Calidad';
    
             }
             ELSEIF($dias>=10){
                $resumen = '';
                $recId=$res->recId;
                $envio = $this->reclamo_model->dameUno($recId);
                $reclamo = $envio[0];
                $unidad   = $envio[1][0];
                $jefe=$unidad->correoDirector.",".$unidad->correoJefe;
                $asunto = 'Recordatorio Vencimiento de Reclamo';
                $resumen = 'Estimado Dpto Calidad,<br><br>'
                        . 'Con respecto al reclamo N°'.$reclamo->recId.', se le recuerda que <b>no</b> se ha realizado la finalización, el cual lleva '.$dias.' habiles sin gestion.<br>'
                     //   . '<b><span style="color:red"><i>'.$reclamo->recObservacion.'</i></span></b>.<br><br>'
                        . 'Para responderlo favor ingresar a la plataforma a traves de su <b>intracetep</b>-><b>unidad de calidad</b><br>'
                        .'<br><br>'
                        .'Atentamente,<br><br>';
                //$resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >";
                $resumen .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style='width: 100px; ' src='".base_url()."../assets/img/calidad.png' >";
                       // . 'LINK: <a href="http://www.cetep.cl/calidad'.$reclamo->recId.'"><b>Responder</b></a>';
                $headers = "MIME-Version: 1.0\r\n"; 
                $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
                $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
                $headers .= "cc: griedel@cetep.cl,".$jefe;
                $destinatario = 'calidad@cetep.cl';
                //echo ('10');
                //echo $resumen;
                mail($destinatario,$asunto,$resumen,$headers) ;
    
             }
             ELSE {
      //        $resumen = '';
      //        $recId=$res->recId;
      //        $envio = $this->reclamo_model->dameUno($recId);
      //        $reclamo = $envio[0];
      //        $unidad   = $envio[1][0];
      //        $jefe=$unidad->correoDirector.",".$unidad->correoJefe;
      //        $asunto = 'Recordatorio Vencimiento de Reclamo';
      //        $resumen = 'Estimado Dpto Calidad,<br><br>'
      //                . 'Con respecto al reclamo N°'.$reclamo->recId.', se le recuerda que <b>no</b> se ha realizado la finalización, el cual lleva '.$dias.' habiles sin gestion.<br>'
      //             //   . '<b><span style="color:red"><i>'.$reclamo->recObservacion.'</i></span></b>.<br><br>'
      //                . 'Para responderlo favor ingresar a la plataforma a traves de su <b>intracetep</b>-><b>unidad de calidad</b><br>'
      //                .'<br><br>'
      //                .'Atentamente,<br><br>';
      //        //$resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >";
      //        $resumen .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style='width: 100px; ' src='".base_url()."../assets/img/calidad.png' >";
      //               // . 'LINK: <a href="http://www.cetep.cl/calidad'.$reclamo->recId.'"><b>Responder</b></a>';
      //        $headers = "MIME-Version: 1.0\r\n"; 
      //        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
      //        $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
      //        //$headers .= "cc: griedel@cetep.cl,".$jefe;
      //        $destinatario = 'griedel@cetep.cl';
      //        //$resumen ='';
      //        //echo ('10');
      //        //echo $resumen;
      //        mail($destinatario,$asunto,$resumen,$headers) ;
             }
             
        }
        //return $resumen;
        //echo json_encode($resumen);
    }
    
    function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array()) {
	// Convirtiendo en timestamp las fechas
        
	$fechainicio = strtotime($fechainicio);
	$fechafin = strtotime($fechafin);
	
	// Incremento en 1 dia
	$diainc = 24*60*60;
	$diasferiados = array(
       //FORMATO Y-m-d   
        '1-1', // Año Nuevo (irrenunciable) 
        '30-3', // Viernes Santo (feriado religioso) 
        '31-3', // Sábado Santo (feriado religioso) 
        '1-5', // Día Nacional del Trabajo (irrenunciable) 
        '21-5', // Día de las Glorias Navales 
        '2-7', // San Pedro y San Pablo (feriado religioso) 
        '16-7', // Virgen del Carmen (feriado religioso) 
        '15-8', // Asunción de la Virgen (feriado religioso) 
        '17-9', // Dia Festivo De Prueba EN EL EJEMPLO <-----
        '18-9', // Dia Festivo De Prueba EN EL EJEMPLO <-----
        '19-9', // Dia Festivo De Prueba EN EL EJEMPLO <-----
        '15-10', // Aniversario del Descubrimiento de América 
        '2-11', // Día Nacional de las Iglesias Evangélicas y Protestantes (feriado religioso) 
        '1-11', // Día de Todos los Santos (feriado religioso) 
        '8-12', // Inmaculada Concepción de la Virgen (feriado religioso) 
       // '13-12', // elecciones presidencial y parlamentarias (puede que se traslade al domingo 13) 
        '25-12', // Natividad del Señor (feriado religioso) (irrenunciable) 
        );
	// Arreglo de dias habiles, inicianlizacion
	$diashabiles = array();
	$sumatoria=0;
	// Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
	for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
		// Si el dia indicado, no es sabado o domingo es habil
		if (!in_array(date('N', $midia), array(6,7))) { 
			// Si no es un dia feriado entonces es habil
			if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
                                //EL ARRAY MUESTRA EL DÍA
				array_push($diashabiles, date('Y-m-d', $midia));
                                $sumatoria += 1;
			}
		}
	}
	return $sumatoria;
    }
}