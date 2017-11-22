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
			
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container" style="border-color: #000000;"  >
            <?php $attributes = array('id' => 'form'); 
                echo form_open('calidad/gestion/guardarRespuesta',$attributes);
            ?>
            <input type="hidden" value="<?php IF(!empty($reclamo))echo $reclamo->recId; ?>" name="recId">
            <div class='widget-content' style="font-size: 16px">
                
                <div id="divFicha"><!--COMIENZO TRATAMIENTO DE FICHA-->
                    <div class="col-lg-12" ><br><br><br></div>
                    <?php $fecha = new datetime(date('Y-m-d')); $fecha = $fecha->format('d F Y'); ?>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">&nbsp;
                        <img src="<?php echo base_url();?>../assets/img/logo_vertical_cetep.png" class="logo" style="width:120px">&nbsp;&nbsp;&nbsp;
                        <img src="<?php echo base_url();?>../assets/img/mirAndes.png" class="logo" style="width:200px">
                    </div>
                    <div class="col-lg-11" align="right" style="margin-top:-15px">Santiago, <?php echo $fecha; ?></div>
                    <div class="col-lg-12" ><br></div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">
                        De nuestra consideración:<br><br>
                        Estimado(a) Sr(a) <b><?php echo $reclamo->recNombre.' '.$reclamo->recApePat ?></b><br><br>
                        Domicilio: <?php echo $reclamo->recDomicilio.', '.$reclamo->comNombre ?>.<br><br><br>
                    </div>
                    <?php $fecha = new datetime($reclamo->recFecha); $fecha = $fecha->format('d F Y'); ?>
                    
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">
                        En respuesta a su reclamo N° <b><?php echo $reclamo->recId; ?></b>, ingresado con fecha <?php echo $fecha; ?>, donde menciona:
                    </div>
                    <div class="col-lg-12"></div>
                    <div class='col-lg-1'></div>
                    
                    <div class="col-lg-11">
                        <label class="titulo">Resumen de Reclamo</label> 
                    </div>
                    <div class='col-lg-1'></div>
                    <div class='col-lg-10'>
                        <textarea name="reclamo" style=" width: 100%; height: 300px" placeholder="Ingrese aquí el resumen del reclamo " required="true">
                            <?php IF(!empty($reclamo) && empty($respuesta)){echo $reclamo->recHechos.'.  PETICION: '.$reclamo->recPeticion;} ELSE echo $respuesta->resHecho?>
                        </textarea>
                    </div>
                    
                    <div class="col-lg-12"><br></div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">
                        Lamentamos los inconvenientes que estos hechos pudieran haberle ocasionado y sentimos muy sinceramente el no haber respondido a sus expectativas, su reclamo ha sido registrado y revisado.
                        <br><br>
                        Habiendo revisado su caso, podemos informar que:
                    </div>
                    <div class='col-lg-1'></div>
                    <div class="col-lg-11">
                        <label class="titulo">Respuesta</label> 
                    </div>
                    <div class='col-lg-1'></div>
                    <div class='col-lg-10'>
                        <textarea name="respuesta" style=" width: 100%; height: 300px" placeholder="Ingrese aquí su respuesta" required="true"><?php IF(!empty($respuesta))echo $respuesta->resRespuesta; ?></textarea>
                    </div>
                     <div class='col-lg-12'><br></div>   
                     <div class='col-lg-1'></div>
                     
                     <div class="col-lg-10" style=" text-align: justify">
                         <b>
                             De conformidad a lo señalado en el reglamento del MINSAL sobre el procedimiento de reclamo de la ley N°20.584, le informamos su facultad para recurrir ante la Superintendencia de Salud para presentar su reclamo
                         </b>
                     </div>
                     <div class="col-lg-12" align="center"><br></div>
                     
                     <?php IF(!empty($calidad)){ ?>
                        <div class="col-lg-12" align="center">
                            <input type="checkbox" name="enviar"> <label style="color: blue;margin-top: -10px">Enviar Respuesta a paciente</label>
                        </div>
                     <?php } ?>
                    <div class="col-lg-12" align="center">
                        <?php  IF(empty($finalizado)){ ?>
                    <?php echo form_submit('','Guardar','class="btn btn-primary btn-sm btnCetep"');?>
                        <?php } ?>
                    <?php echo form_close();?>
                </div>
                    <div class='col-lg-12'><br></div>
</div><!-- FIN DIV FICHA COMPLETA-->
                
        </div><!-- div class='widget-content'-->    
                    
                
                
            </div><!-- div class="col-xs-12" -->
        </div><!-- row -->
   </div>
</div><!-- content -->
<?php
function formatearRut( $rut ) {
     while($rut[0] == "0") {
            $rut = substr($rut, 1);
        }
        $factor = 2;
        $suma = 0;
        for($i = strlen($rut) - 1; $i >= 0; $i--) {
            $suma += $factor * $rut[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $dv = 11 - $suma % 11;
        /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
        $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
        $rut=  $rut . $dv;
return number_format( substr ( $rut, 0 , -1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) -1 , 1 );
}
?>











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

