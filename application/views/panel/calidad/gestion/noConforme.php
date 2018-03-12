<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<style>
    .titulo{
        color: #a15ebe;
    }
    .icon{
            width: 25px;
            padding-top: 5%;
            padding-left: 5%;
    }
</style>
<div id="content" style="-webkit-box-shadow: -2px 2px 41px 2px rgba(0,0,0,0.75);
-moz-box-shadow: -2px 2px 41px 2px rgba(0,0,0,0.75);
box-shadow: -2px 2px 41px 2px rgba(0,0,0,0.75);z-index: 25; background-color: #db8918">
    <div id="content-header" style="background-color: #e9c899; max-height: 10px !important" >
        <h1 style="background-color: #a15ebe !important;border:none;color:#ffffff; margin-right: 30px;-webkit-box-shadow: 10px 10px 23px -6px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 23px -6px rgba(0,0,0,0.75);box-shadow: 10px 10px 23px -6px rgba(0,0,0,0.75);" class="alert alert-info"><?php echo $title;?>
        <div align="right" style="margin-top:-20px">
                <span><a class="tip-bottom" title="Cerrar" href="<?php echo base_url("calidad/gestion/index/")?>"><i class="fa fa-times-circle" aria-hidden="true" style="color:red"></i></a></span>
        </div>
        </h1>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
			
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container" >
            <?php $attributes = array('id' => 'form');
                echo form_open('calidad/gestion/guardarNoConforme',$attributes);//die(var_dump($planilla));
            ?>
        <input type="hidden" name="plaId" value="<?php IF(!empty($planilla)) echo $planilla->plaId; ?>">
            <div class='widget-content'>
                
                <div id="divFicha"><!--COMIENZO TRATAMIENTO DE FICHA-->
                    <div class="col-lg-12" ><br></div>
                <!-- DATOS DE PERSONALES-->               
                    <div class="col-lg-12">
                    <label class="titulo">Antecedentes</label>
                    </div>
                    <div class="col-lg-2">
                        <label>Fecha del Hecho</label> 
                    </div>
                    <div class='col-lg-4'>
                        <div class="input-group input-group-sm date datepicker" required data-date="<?php //echo (new DateTime())->format('Y-m-d H:i:s') ?>" data-date-format="yyyy-mm-dd">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" required placeholder="día-mes-año" style=" width: 158px !important" name="fecha" minlength="10" maxlength="10" title="Ingrese una fecha valida" value="<?php IF(!empty($planilla->plaFechaHecho)) {$fecha = new datetime($planilla->plaFechaHecho); $fecha = $fecha->format('d-m-Y'); echo $fecha; } ELSE {echo date('d-m-Y');} ?>" >
                        </div>
                    </div> 
                    <div class="col-lg-1">
                        <label>Motivo</label> 
                    </div>
                    <div class='col-lg-5' style="margin-top:6px">
                        <table>
                            <tbody>
                            <tr>
                                <td style=" width: 30px" align="center"><input type="radio" name="motivo" value="4" <?php IF(!empty($planilla->plaMotivo) && $planilla->plaMotivo === '4')echo 'checked'; ?>></td>
                                <td style=" width: 75px">Felicitación</td>
                                <td style=" width: 30px" align="center"><input type="radio" name="motivo" value="1" <?php IF(!empty($planilla->plaMotivo) && $planilla->plaMotivo === '1')echo 'checked'; ?>></td>
                                <td style=" width: 75px">Sugerencia</td>
                                <td style=" width: 30px" align="center"><input type="radio" name="motivo" value="2" <?php IF(!empty($planilla->plaMotivo) && $planilla->plaMotivo === '2')echo 'checked'; ?>></td>
                                <td style=" width: 75px">Reclamo</td>
                                <td style=" width: 30px" align="center"><input type="radio" name="motivo" value="3" <?php IF(!empty($planilla->plaMotivo) && $planilla->plaMotivo === '3')echo 'checked'; ?>></td>
                                <td style=" width: 75px">PSNC</td>
                                <td><img class="icon" src="<?php echo base_url();?>../assets/img/icons/signo.png" id="icon"/></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px" colspan="9">Recuerde que si desea ingresar un reclamo de paciente, debe realizarlo a travez del <span style="color:red" >menu "Contacto"</span>,   para asi darle respuesta al paciente</td>
                            </tr>
                            </tbody>
                        </table>
                         </div>
                    
                </div> 
                
                
                <div class="col-lg-12" ><br></div>
                <!-- DATOS DE PERSONALES-->               
                    <div class="col-lg-12">
                        <label>Describa</label> 
                    </div>
                <div class='col-lg-12' >
                        <textarea name="descripcion" style=" width: 100%; height: 200px; overflow: hidden " placeholder="Describa aquí lo sucedido PSNC / Informado por" required <?php IF(!empty($planilla)) echo 'readonly'; ?>><?php IF(!empty($planilla->plaDescripcion))echo $planilla->plaDescripcion; ?></textarea>
                    </div>
                    <div class="col-lg-12">
                        <label>Acción Inmediata</label> 
                    </div>
                    <div class='col-lg-12'>
                        <textarea name="accion" style=" width: 100%; height: 100px;  overflow: hidden" placeholder="Describa Aquí La Acción Inmediata Realizada" <?php //IF(!empty($planilla) && $planilla != '0') echo 'readonly'; ?>><?php IF(!empty($planilla->plaAccion))echo $planilla->plaAccion; ?></textarea>
                    </div>
                    <div class='col-lg-12'><br></div>
                    
                        
                        
                    <div class='col-lg-12'><hr></div>
                    <div class="col-lg-12">
                    <label class="titulo">Indicaciones No Cumplimiento</label>
                    </div>
                    
                    <div class='col-lg-12'><br></div>
                    
                    <div class="col-lg-4">
                        <input type="checkbox" id="proveedor" name="proveedor" <?php IF(!empty($planilla->plaProveedor) && $planilla->plaProveedor === '1')echo 'checked'; ?> value="1">
                        &nbsp;<label>No Cumplimiento de Proveedor</label> 
                    </div>
                    
                    <div class="col-lg-4">
                        <input type="checkbox" id="cliente" name="cliente" <?php IF(!empty($planilla->plaCliente) && $planilla->plaCliente === '1')echo 'checked'; ?> value="1">
                        &nbsp;<label>No Cumplimiento de Cliente</label> 
                    </div>
                    <div class="col-lg-4">
                        <input type="checkbox" id="profesional" name="profesional" <?php IF(!empty($planilla->plaProfesional) && $planilla->plaProfesional === '1')echo 'checked'; ?> value="1">
                        &nbsp;<label>No Cumplimiento de Profesional</label> 
                    </div>
                    <div class="col-lg-4">
                        <input type="checkbox" id="unidad" name="unidadCheck" <?php IF(!empty($planilla->plaUnidadCheck) && $planilla->plaUnidadCheck === '1')echo 'checked'; ?> value="1">
                        &nbsp;<label>No Cumplimiento de Unidad</label> 
                    </div>
                    
                        <div class="col-lg-4">
                        <input type="checkbox" id="apoyo" name="plaUnidadDeApoyoCheck" <?php IF(!empty($planilla->plaUnidadDeApoyoCheck) && $planilla->plaUnidadDeApoyoCheck === '1')echo 'checked'; ?> value="1">
                        &nbsp;<label>No Cumplimiento de Unidad de Apoyo</label> 
                        </div>
                    <div class="col-lg-4">
                        <input type="checkbox" id="paciente" name="plaPaciente" <?php IF(!empty($planilla->plaPaciente) && $planilla->plaPaciente === '1')echo 'checked'; ?> value="1">
                        &nbsp;<label>No Cumplimiento de Paciente</label> 
                    </div>
                    <div class="col-lg-4">
                        
                       <?php //die(var_dump($planilla));?><label>Peritaje</label> 
                    <select name="plaTipo" >
                                <option>Seleccione Tipo Peritaje</option>
                                <?php FOREACH($listarTipos as $tip){ ?>
                                    <option value="<?php echo $tip->tipId; ?>" <?php IF(!empty($planilla->plaTipo) && $planilla->plaTipo === $tip->tipId) echo 'selected'; ?> ><?php echo $tip->tipNombre; ?></option>
                                <?php } ?>
                            </select>
                    
                        
                        
                    </div>
                        <div class="col-lg-4" style="padding-left:42px">
                            <select name="plaUnidadDeApoyo" style="width:300px;" >
                                <option>Seleccione unidad de apoyo...</option>
                                <?php FOREACH($listarUnidades as $lis){ ?>
                                    <option value="<?php echo $lis->descripcion.'_'.$lis->idunidad; ?>" <?php IF(!empty($planilla->plaUnidadDeApoyo) && $planilla->plaUnidadDeApoyo === $lis->descripcion) echo 'selected'; ?> ><?php echo $lis->descripcion; ?></option>
                                <?php } ?>
                            </select>
                            <!--
                            <input type="text" name="plaUnidadDeApoyo" value="<?php IF(!empty($planilla->plaUnidadDeApoyo)) echo $planilla->plaUnidadDeApoyo;?> ">
                            -->
                        </div>
                   
                    
                    
                    <div class="col-lg-4">
                        <input type="checkbox"  id="plaNoAplica" name="noaplica" <?php IF(!empty($planilla->plaNoAplica) && $planilla->plaNoAplica === '1')echo 'checked'; ?> value="1">
                        &nbsp;<label>N/A</label> <input type="text" name="plaNoAplicaText" placeholder="Especifique..." value="<?php IF(!empty($planilla->plaNoAplicaText)) echo $planilla->plaNoAplicaText;?>">
                    </div>
                     <div class="col-lg-12"></div>
                    
                    
                     <div class="col-lg-12"></div>
                    <div class='col-lg-12'><br></div>
                    
                    <?php IF((!empty($jefeUnidad) || $this->session->userdata('perfil') == '3') && !empty($planilla)){ ?>
                    <div class="col-lg-12">
                        <label>Descripción / Observaciones / Seguimiento de Respuesta</label> 
                    </div>
                    <div class='col-lg-12'>
                        <textarea name="seguimiento" style=" width: 100%; height: 100px; overflow: hidden" placeholder="Ingrese Aquí el Seguimiento de Respuesta" <?php IF(!empty($planilla)) echo 'required'; ?>><?php IF(!empty($planilla->plaSeguimiento))echo $planilla->plaSeguimiento; ?></textarea>
                    </div>
                    <div class='col-lg-12'><br></div>
                    
                <?php } ?>
                <div class="col-lg-12" align="center">
                    <?php echo form_submit('','Guardar','class="btn btn-primary btn-sm btnCetep"');?>
                    <?php echo form_close();?>
                </div>
                <div class='col-lg-12'><br></div>
                
                <!-- INICIO TABLA-->
                <div  class="col-lg-12" style="overflow: auto;">
                    
<?php IF(!empty($jefeUnidad)){ ?>
                                <div class='col-lg-12'><hr></div>

            <div class="col-lg-12"> 
                                    <!-- 
               GRAFICOS
                                    -->
                <div class="col-lg-6">
                <div id="pie2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                </div>
                <div class="col-lg-6">
                <div id="pie1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                </div>
                <!--
                <div class="col-lg-12">  
                <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>-->
            </div>
<?php } ?>
                    <div class='col-lg-12'><hr></div>
                  <i class="fa fa-table" id="btnExport" style="cursor: pointer; color:#1d7044;font-size:25px;margin-top:10px;margin-left:20px" title="Exportar Tabla a Excel"></i>  
                  
                <table class='table table-bordered table-hover table-striped data-table'>
                        <thead>
                            <tr>
                                <th style="font-size: 8px">N°</th>
                                <th style="font-size: 8px">Fecha</th>
                                <th style="font-size: 8px">Motivo</th>
                                <th style="font-size: 8px">Nombre</th>
                                <th style="font-size: 8px">Descripción</th>
                                <th style="font-size: 8px">Acción</th>
                                <th style="font-size: 8px">Seguimiento</th>
                                <th style="font-size: 8px">No Cumplimiento de Proveedor</th>
                                <th style="font-size: 8px">No Cumplimiento de Cliente</th>
                                <th style="font-size: 8px">No Cumplimiento de Profesional</th>
                                <th style="font-size: 8px">No Cumplimiento de Unidad</th>
                                <th style="font-size: 8px">No Cumplimiento de Unidad Apoyo</th>
                                <th style="font-size: 8px">No Cumplimiento de Paciente</th>
                                
                                <th style="font-size: 8px">No Aplica</th>
                                
                                <?php IF(!empty($jefeUnidad)){ ?>
                                    <th style="font-size: 8px">Gestion</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                                <?php foreach ($datos as $item) : ?>
                            <tr>
                                <td style="font-size: 8px"><?php echo $item->plaId; ?></td>
                                <td style="font-size: 8px"><?php IF(!empty($item->plaFechaHecho)){$date = new DateTime($item->plaFechaHecho);echo $date->format('d-m-y');}//echo $item->id; ?></td>
                                <td style="font-size: 8px"><?php if($item->plaMotivo === '1') $motivo = 'Sugerencia'; elseif($item->plaMotivo === '2') $motivo = 'Reclamo'; elseif($item->plaMotivo === '3') $motivo = 'PSNC'; elseif($item->plaMotivo === '4') $motivo = 'Felicitación'; echo $motivo?></td>
                                <td style="font-size: 8px"><?php echo strtoupper($item->plaNombre).' '.strtoupper($item->plaApellido); ?></td>
                                <td style="font-size: 8px;width: 200px" align="justify"><?php echo substr($item->plaDescripcion,0,200).'...'; ?></td>
                                <td style="font-size: 8px;width: 200px" align="justify"><?php echo substr($item->plaAccion,0,200).'...'; ?></td>
                                <td style="font-size: 8px;width: 100px" align="justify"><?php IF($item->plaSeguimiento!='0')echo substr($item->plaSeguimiento,0,100).'...'; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaProveedor)    && $item->plaProveedor==='1')   echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaCliente)          && $item->plaCliente==='1')         echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaProfesional)  && $item->plaProfesional==='1') echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaUnidadCheck)&& $item->plaUnidadCheck==='1')echo 'SI' ;?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaUnidadDeApoyoCheck) && $item->plaUnidadDeApoyoCheck==='1')echo 'SI'; ?></td>
                                
                                
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaPaciente)       && $item->plaPaciente==='1')      echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaNoAplica)       && $item->plaNoAplica==='1')      echo 'SI' ; ?></td>
                                
                                <?php IF(!empty($jefeUnidad)){ ?>
                                    <td align="center">
                                        <!--
                                        <a class="tip-bottom" title="Imprimir" href="<?php echo base_url("calidad/impresiones/imprimirSugerencia/" . $item->plaId )?>"><i class="fa fa-print" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                        -->
                                        <a class="tip-bottom" title="Gestionar" href="<?php echo base_url("calidad/gestion/modificarNoConforme/" . $item->plaId )?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        
                                    </td>
                                <?php } ?>
                            </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12"><br></div>
                
                
                <!-- FIN TABLA -->
                
                
                
                
                
</div><!-- FIN DIV FICHA COMPLETA-->
                
        </div><!-- div class='widget-content'-->    
                    
                
                
            </div><!-- div class="col-xs-12" -->
        </div><!-- row -->
   </div>
</div><!-- content -->


<script src="<?php echo base_url(); ?>../assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/hs.tables.js"></script>

<script>
$(".icon").hide();
$("#form").submit(function () { 
    $(".icon").hide();
          
 
if ($('#profesional').prop('checked') === true || $('#plaNoAplica').prop('checked') === true || $('#cliente').prop('checked') === true || $('#proveedor').prop('checked') === true || $('#unidad').prop('checked') === true || $('#apoyo').prop('checked') === true  || $('#paciente').prop('checked') === true ) {

} else {alert('Selección Item de no cumplimiento');return false;}
 
  if($('input:radio[name=motivo]:checked').val()===undefined) {  
                  $("#icon").show();
                  return false;
              }
/// Comprobacion usando funcion .is()
//f ($('#profesional').is(':checked') ) {
//alert("Checkbox seleccionado3");
//
               
});
</script>
<script>
    
function validaRut(campo){
   
	if ( campo.length == 0 ){ return false; }
	if ( campo.length < 7 ){ return false; }

	campo = campo.replace('-','')
	campo = campo.replace(/\./g,'')

	var suma = 0;
	var caracteres = "1234567890kK";
	var contador = 0;    
	for (var i=0; i < campo.length; i++){
		u = campo.substring(i, i + 1);
		if (caracteres.indexOf(u) != -1)
		contador ++;
	}
	if ( contador==0 ) { return false }
	
	var rut = campo.substring(0,campo.length-1)
	var drut = campo.substring( campo.length-1 )
	var dvr = '0';
	var mul = 2;
	
	for (i= rut.length -1 ; i >= 0; i--) {
		suma = suma + rut.charAt(i) * mul
                if (mul == 7) 	mul = 2
		        else	mul++
	}
	res = suma % 11
	if (res==1)		dvr = 'k'
                else if (res==0) dvr = '0'
	else {
		dvi = 11-res
		dvr = dvi + ""
	}
	if ( dvr != drut.toLowerCase() ) { return false; }
	else { return true; }
}

function formatearRut(rut){
        
        if (!rut || !rut.length || typeof rut !== 'string') {
		return -1;
	}
	// serie numerica
	var secuencia = [2,3,4,5,6,7,2,3];
	var sum = 0;
	//
	for (var i=rut.length - 1; i >=0; i--) {
		var d = rut.charAt(i)
		sum += new Number(d)*secuencia[rut.length - (i + 1)];
	};
	// sum mod 11
        
	var rest = 11 - (sum % 11);
	// si es 11, retorna 0, sino si es 10 retorna K,
	// en caso contrario retorna el numero
	rest === 11 ? 0 : rest === 10 ? "K" : rest;
        if(rest===10)rest='K';else if(rest===11)rest=0;
        //console.log("Rut :"+rest);
        rut = rut+rest;
    
        //console.log("Rut :"+rut);
        var sRut1 = rut;   	//contador de para saber cuando insertar el . o la -
        var nPos = 0; //Guarda el rut invertido con los puntos y el guión agregado
        var sInvertido = ""; //Guarda el resultado final del rut como debe ser
        var sRut = "";
        for(var i = sRut1.length - 1; i >= 0; i-- )
        {
            sInvertido += sRut1.charAt(i);
            if (i == sRut1.length - 1 )
                sInvertido += "-";
            else if (nPos == 3)
            {
                sInvertido += ".";
                nPos = 0;
            }
            nPos++;
        }
        for(var j = sInvertido.length - 1; j >= 0; j-- )
        {
            if (sInvertido.charAt(sInvertido.length - 1) != ".")
                sRut += sInvertido.charAt(j);
            else if (j != sInvertido.length - 1 )
                sRut += sInvertido.charAt(j);
        }
        //Pasamos al campo el valor formateado
        //console.log(sRut);
        return sRut.toUpperCase();
        //return rut
    }

</script>

<div  style="display:none;" id="exportar">
                    <?php $color='#D8D8D8';?>
                <table>
                           <tr>
                                <td colspan="19" align="center" style="border:1px grey solid;background-color:#424242;color:white"><b>PLANILLA PRODUCTO / SERVICIO NO CONFORME</b></td>
                            </tr>
                            <tr>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">N</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Fecha Registro</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Fecha Hecho</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Unidad</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Motivo</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Nombre</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Descripcion</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Accion</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Seguimiento</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Peritaje</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Proveedor</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Cliente</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Profesional</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Unidad</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center" colspan="2">No<br>Cumplimiento<br>de Unidad Apoyo</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Paciente</td>
                                
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center" colspan="2">No<br>Aplica</td>
                                
                            </tr>
                                <?php foreach ($datos as $item) : ?>
                            <tr>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>"><?php echo $item->plaId; ?></td>
                                <td style="font-size: 8px;background-color: <?php echo $color; ?>"><?php $date = new DateTime($item->plaFecha);echo $date->format('d-m-y');//echo $item->id; ?></td>
                                <td style="font-size: 8px;background-color: <?php echo $color; ?>"><?php IF(!empty($item->plaFechaHecho)){$date = new DateTime($item->plaFechaHecho);echo $date->format('d-m-y');}//echo $item->id; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>">
                                    <?php 
                                        if(!empty($item->plaUnidad)) {
                                            IF( $item->plaUnidad==='1')$unidad = 'Gerencia';
                                            ELSEIF( $item->plaUnidad==='2')$unidad = 'UGH';
                                            ELSEIF( $item->plaUnidad==='3')$unidad = 'UPC';
                                            ELSEIF( $item->plaUnidad==='4')$unidad = 'UAC';
                                            ELSEIF( $item->plaUnidad==='5')$unidad = 'Comercial';
                                            ELSEIF( $item->plaUnidad==='6')$unidad = 'DTI';
                                            ELSEIF( $item->plaUnidad==='8')$unidad = 'RRHH';
                                            ELSEIF( $item->plaUnidad==='10')$unidad = 'Otec';
                                            ELSEIF( $item->plaUnidad==='11')$unidad = 'HD y RH';
                                            ELSEIF( $item->plaUnidad==='12')$unidad = 'MIRANDES CLINICA / HD';
                                            ELSEIF( $item->plaUnidad==='13')$unidad = 'MirAndes Clinica';
                                            ELSEIF( $item->plaUnidad==='17')$unidad = 'DO';
                                            ELSEIF( $item->plaUnidad==='18')$unidad = 'T Feliz';
                                            ELSEIF( $item->plaUnidad==='21')$unidad = 'Contabilidad';
                                            ELSEIF( $item->plaUnidad==='23')$unidad = 'Calidad';
                                            ELSEIF( $item->plaUnidad==='30')$unidad = 'USL';
                                            ELSE $unidad = $item->plaUnidad;
                                            echo $unidad; 
                                        }
                                    ?>
                                </td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>"><?php if($item->plaMotivo === '1') $motivo = 'Sugerencia'; elseif($item->plaMotivo === '2') $motivo = 'Reclamo'; elseif($item->plaMotivo === '3') $motivo = 'Otro'; echo $motivo?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>"><?php echo strtoupper($item->plaNombre).' '.strtoupper($item->plaApellido); ?></td>
                                <td style="font-size: 12px;width: 600px;background-color: <?php echo $color; ?>" align="justify"><?php 
                                                                                                                                    $descripcion = str_replace('á', 'a', $item->plaDescripcion) ;$descripcion = str_replace('é', 'e', $descripcion)  ;$descripcion = str_replace('í', 'i', $descripcion) ;$descripcion = str_replace('ó', 'o', $descripcion)  ;$descripcion = str_replace('ú', 'u', $descripcion);$descripcion = str_replace('ñ', 'n', $descripcion) ; 
                                                                                                                                    echo $descripcion; 
                                                                                                                                ?>
                                </td>
                                <td style="font-size: 12px;width: 400px;background-color: <?php echo $color; ?>" align="justify"><?php 
                                                                                                                                    $accion = str_replace('á', 'a', $item->plaAccion) ;$accion = str_replace('é', 'e', $accion)  ;$accion = str_replace('í', 'i', $accion) ;$accion = str_replace('ó', 'o', $accion)  ;$accion = str_replace('ú', 'u', $accion) ; $accion = str_replace('ñ', 'n', $accion) ; 
                                                                                                                                    echo $accion; 
                                                                                                                                ?>
                                </td>
                                <td style="font-size: 12px;width: 600px;background-color: <?php echo $color; ?>" align="justify"><?php IF($item->plaSeguimiento !=='0'){
                                                                                                                                    $seguimiento = str_replace('á', 'a', $item->plaSeguimiento) ;$seguimiento = str_replace('é', 'e', $seguimiento)  ;$seguimiento = str_replace('í', 'i', $seguimiento) ;$seguimiento = str_replace('ó', 'o', $seguimiento)  ;$seguimiento = str_replace('ú', 'u', $seguimiento) ; $seguimiento = str_replace('ñ', 'n', $seguimiento) ; 
                                                                                                                                    echo $seguimiento; 
                                                                                                                                    }
                                                                                                                                ?>
                                </td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaTipo)  && $item->plaTipo==='1')   echo 'Neuroquirurgico' ; ELSEIF(!empty($item->plaTipo)  && $item->plaTipo==='2')   echo 'Psiquiatrico' ;ELSEIF(!empty($item->plaTipo)  && $item->plaTipo==='3')   echo 'Traumatologico ' ; ?></td>
                                
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaProveedor)    && $item->plaProveedor==='1')   echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaCliente)          && $item->plaCliente==='1')         echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaProfesional)  && $item->plaProfesional==='1') echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaUnidadCheck)&& $item->plaUnidadCheck==='1')echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaUnidadDeApoyoCheck) && $item->plaUnidadDeApoyoCheck==='1') echo '1'; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaUnidadDeApoyoCheck) && $item->plaUnidadDeApoyoCheck==='1') echo $item->plaUnidadDeApoyo; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaPaciente)       && $item->plaPaciente==='1')      echo '1' ; ?></td>
                               
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaNoAplica)       && $item->plaNoAplica==='1')      echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaNoAplicaText)) echo $item->plaNoAplicaText ; ?></td>
                                
                            </tr>
                            <?php 
                                IF($color === '#D8D8D8') $color = '#F2F2F2';
                                ELSE $color = '#D8D8D8';
                            ?>
                                <?php endforeach; ?>
                    </table>
                </div>

<script>
    $("#btnExport").click(function(e) {
       
      //var htmltable= document.getElementById('exportar');
      // var html = htmltable.outerHTML;
     //  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
 

        //Creamos un Elemento Temporal en forma de enlace
        var tmpElemento = document.createElement('a');
        // obtenemos la informaciÃ³n desde el div que lo contiene en el html
        // Obtenemos la informaciÃ³n de la tabla
        var data_type = 'data:application/vnd.ms-excel; charset=UTF-8; charset=utf-8';
        var tabla_div = document.getElementById('exportar');
       console.log(tabla_div);
        var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
        tmpElemento.href = data_type + ', ' + tabla_html;
        //Asignamos el nombre a nuestro EXCEL
        tmpElemento.download = 'Planilla Producto No Conforme.xls';
        // Simulamos el click al elemento creado para descargarlo
        tmpElemento.click();
    });


</script>



<script>
    //PIE PISO
    $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/charts/piePSNC/",
            dataType: 'json',
            
            success: function(datos){
                var keyVar;
                var proveedor = 0;
                var cliente = 0;
                var profesional = 0;
                var unidad = 0;
                var apoyo = 0;
                var cantT = 0;
                var otro = 0;
                var paciente = 0;
                
                    for(keyVar in datos) {
                        proveedor = parseInt(datos[keyVar].proveedor);
                        cliente = parseInt(datos[keyVar].cliente);
                        profesional = parseInt(datos[keyVar].profesional);
                        unidad = parseInt(datos[keyVar].unidad);
                        apoyo = parseInt(datos[keyVar].apoyo);
                        otro = parseInt(datos[keyVar].otro);
                        paciente = parseInt(datos[keyVar].paciente);
                        //console.log(datos[keyVar].apoyo);
                    }
                    //console.log(proveedor);
                    //console.log(proveedor);
                    
                   cantT = parseInt(proveedor)+parseInt(cliente)+parseInt(profesional)+parseInt(unidad)+parseInt(apoyo)+parseInt(paciente)+parseInt(otro);
                   //console.log(cantT);
                    
                    //alert('...'+cantT);
                    Highcharts.chart('pie2', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'No Cumplimiento Por Item'
                        },
                        subtitle: {
                            text: 'Universo: '+cantT+' registros',
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || '#a15ebe'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Porcentaje',
                            colorByPoint: true,
                            data: [{
                                    name: 'Cliente',
                                    y: cliente
                                    //sliced: true,
                                    //selected: true
                                },{
                                    name: 'No aplica',
                                    y: otro
                                },{
                                    name: 'Paciente',
                                    y: paciente
                                },{
                                    name: 'Profesional',
                                    y: profesional
                                },{
                                    name: 'Proveedor',
                                    y: proveedor
                                },{
                                    name: 'Unidad de Apoyo',
                                    y: apoyo
                                    //sliced: true,
                                    //selected: true
                                },{
                                    name: 'Unidad de Negocio',
                                    y: unidad
                                }]
                        }]
                    });

            }
        });
        
        
        
        
        
          //PIE APOYO
    $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/charts/pieAPOYO/",
            dataType: 'json',
            
            success: function(datos){
                var keyVar;
                var dti = 0;
                var comunicaciones = 0;
                var operaciones = 0;
                var calidad = 0;
                var uaf = 0;
                var contabilidad = 0;
                var comercial = 0;
                var desarrollo = 0;
                var cantT = 0;
               
                
                    for(keyVar in datos) {
                        //alert(datos[keyVar].plaUnidadDeApoyo);
                        if(datos[keyVar].plaUnidadDeApoyo === 'DTI'){dti = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'COMUNICACIONES'){comunicaciones = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'CONTABILIDAD'){contabilidad = parseInt(datos[keyVar].cant);}
                        
                        if(datos[keyVar].plaUnidadDeApoyo === 'OPERACIONES'){operaciones = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'CALIDAD'){calidad = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'DESARROLLO ORGANIZACIONAL'){desarrollo = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'UAF-GESTION DE RRHH' || datos[keyVar].plaUnidadDeApoyo === 'GESTION DE RRHH'){uaf = parseInt(datos[keyVar].cant);}
                        
                        if(datos[keyVar].plaUnidadDeApoyo === 'COMERCIAL'){comercial = parseInt(datos[keyVar].cant);}
                        
                        
                    }
                    //alert(dti);alert(comunicaciones);alert(contabilidad);
                    //console.log(proveedor);
                    //console.log(proveedor);
                   cantT = dti+comunicaciones+contabilidad+operaciones+calidad+uaf+comercial+desarrollo;
                   //console.log(cantT);
                    
                    
                    Highcharts.chart('pie1', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: null,
                            type: 'pie'
                        },
                        title: {
                            text: 'No Cumplimiento Por Unidad de Apoyo'
                        },
                        subtitle: {
                            text: 'Universo: '+cantT+' registros',
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || '#a15ebe'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Porcentaje',
                            colorByPoint: true,
                            data: [{
                                    name: 'Calidad',
                                    y: calidad,
                                    //sliced: true,
                                    //selected: true
                                },{
                                    name: 'Contabilidad',
                                    y: contabilidad
                                },{
                                    name: 'Comercial',
                                    y: comercial
                                },{
                                    name: 'Comunicaciones',
                                    y: comunicaciones
                                },{
                                    name: 'Desarrollo Organizacional',
                                    y: desarrollo
                                },{
                                    name: 'Dti',
                                    y: dti
                                },{
                                    name: 'Operaciones',
                                    y: operaciones
                                },{
                                    name: 'UAF-Gestion de RRHH',
                                    y: uaf
                                }]
                        }]
                    });

            }
        });
</script>



