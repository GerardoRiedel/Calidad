<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
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
            <div class="col-lg-12">  
        
        </div>
            <div class="col-xs-12"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container" style="border-color: #000000;"  >
                <div class="col-lg-12">
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
                <div class="col-lg-6">
                    <div id="pie1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                </div>
                <div class="col-lg-12"><hr></div>
                
                <div  class="col-lg-12" style="overflow: none;">
                    
                <table class='table table-bordered table-hover table-striped data-table'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha Registro</th>
                                <th>Run</th>
                                <th style=" display: none">Run</th>
                                <th>Nombres</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Estado</th>
                                <th>Unidad</th>
                                <th>Fecha Modificación</th>
                                <th>Gestion</th>
                                <th>Respuesta</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php foreach ($reclamos as $item) : ?>
                                <?php $area = $item->recArea;
                                        IF($area === '10')$area= 'IMPULSA'; 
                                        ELSEIF($area === '4')$area= 'UNIDAD ATENCIÓN CLÍNICA';
                                        ELSEIF($area === '2')$area= 'UNIDAD GESTION HOSPITALARIO';
                                        ELSEIF($area === '3')$area= 'UNIDAD PERITAJE CLÍNICO';
                                        ELSEIF($area === '30')$area= 'UNIDAD SALUD LABORAL';
                                        ELSEIF($area === '13')$area= 'MIRANDES CLÍNICA';
                                        
                                    IF($item->recEstado === '1')$color = 'green'; 
                                    ELSEIF($item->recEstado === '2')$color = 'red'; 
                                    ELSEIF($item->recEstado === '4')$color = 'red'; 
                                    ELSEIF($item->recEstado === '6')$color = 'red'; 
                                    ELSE $color = 'grey'; 
                                    //$date2 = '';
                                ?>
                            <tr>
                                <td style="color:<?php echo $color; ?>"><?php echo $item->recId; ?></td>
                                <td style="color:<?php echo $color; ?>"><?php $date = new DateTime($item->recFecha);echo $date->format('d-m-Y H:i');//echo $item->id; ?></td>
                                <td style="color:<?php echo $color; ?>"><?php if(!empty($item->recRut)) echo formatearRut($item->recRut); ?></td>
                                <td style="display:none;color:<?php echo $color; ?>"><?php if(!empty($item->sugRut)) echo $item->recRut; ?></td>
                                <td style="color:<?php echo $color; ?>"><?php echo strtoupper($item->recNombre); ?></td>
                                <td style="color:<?php echo $color; ?>"><?php echo strtoupper($item->recApePat); ?></td>
                                <td style="color:<?php echo $color; ?>"><?php echo strtoupper($item->recApeMat); ?></td>
                                <td style="color:<?php echo $color; ?>"><?php echo strtoupper($item->estNombre); ?></td>
                                <td style="color:<?php echo $color; ?>" align="center"><?php echo strtoupper($area); ?></td>
                                <td align='center' style=" width:150px;color:<?php echo $color; ?>"><?php IF(!empty($item->recFechaModificacion)) {$date2 = new DateTime($item->recFechaModificacion);echo $date2->format('d-m-Y H:i');}//echo $item->id; ?></td>
                                <td align="center">
                                    <?php  IF(strtoupper($item->estNombre) !== 'FINALIZADO'){ ?>
                                     <a class="tip-bottom" title="Gestionar" href="<?php echo base_url("calidad/gestion/cargarReclamo/" . $item->recId )?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <?php } ELSEIF(strtoupper($item->estNombre) === 'FINALIZADO'){ ?>
                                     <a class="tip-bottom" title="Ver" href="<?php echo base_url("calidad/gestion/verReclamo/" . $item->recId )?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <?php } ?>
                                </td>
                                <td align="center">
                                    <?php IF(strtoupper($item->estNombre) !== 'FINALIZADO'){ ?>
                                    <!--
                                    <a class="tip-bottom" title="Imprimir" href="<?php echo base_url("calidad/impresiones/imprimirReclamo/" . $item->recId )?>"><i class="fa fa-print" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                    -->
                                    <a class="tip-bottom" title="Responder" href="<?php echo base_url("calidad/gestion/cargarRespuesta/" . $item->recId )?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
                                    <?php } ELSEIF(strtoupper($item->estNombre) === 'FINALIZADO'){ ?>
                                     <a class="tip-bottom" title="Ver" href="<?php echo base_url("calidad/gestion/verRespuesta/" . $item->recId )?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                </div>
                <div class="col-lg-2">
                    <!--
                    <button onclick="goBack()" class="btn btn-default btn-sm">Cancelar</button><script>function goBack(){window.history.go(-1);}</script>
                -->
                </div>
        </div><!-- div class='widget-content'-->    
                    
                
                
            </div><!-- div class="col-xs-12" -->
        </div><!-- row -->
   </div>
</div><!-- content -->
</div>
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
    
<script src="<?php echo base_url(); ?>../assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/hs.tables.js"></script>

<script>
    $("#divFicha").hide(); 
    $("#divFichaApoderado").hide(); 
    $("#divFichaEconomico").hide();
    $("#rut").attr("disabled", false).css("border-color","red");
    $("#rutApo").attr("disabled", false).css("border-color","red");
    $("#rutApoEco").attr("disabled", false).css("border-color","red");
    
</script>
<script>
    $("#form").submit(function () {  
    if($("#banco").val()==0) {  
        alert("Banco Requerido");  
        return false;
    } 
    if($("#tipoCta").val()==0) {  
        alert("Cta Requerido");  
        return false;
    } 
});  
</script>
<script>
    
    $("#rut").focusout(function(){
       
        ////LIMPIAR INPUTS
        document.getElementById("nombres").value = "";document.getElementById("apePat").value = "";document.getElementById("apeMat").value = "";document.getElementById("fecha").value = ""; document.getElementById("telFijo").value = ""; document.getElementById("telCelu").value = ""; document.getElementById("direccion").value  = ""; document.getElementById("email").value = ""; document.getElementById("ocupacion").value  = ""; document.getElementById("rutTitular").value = ""; document.getElementById("rutApo").value = "";
        $("#rut").attr("disabled", false).css("border-color",'#ccc');
        $("#divFicha").show();  
        var rut = $( "#rut" ).val();
        var rut = rut.replace(".", "");var rut = rut.replace("-", "");var rut = rut.replace(",", ""); var rut = rut.replace(".", "");
        var letra = rut.substring(0, 1);
        
        if (letra === '1' || letra === '2'){var rut = rut.substring(0, 8);}
        else {var rut = rut.substring(0, 7);}

        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/ingresos/index/"+rut,
            dataType: 'json',
            
            success: function(data){
                
                document.getElementById("nombres").value    = data.nombres;
                document.getElementById("apePat").value     = data.apellidoPaterno;
                document.getElementById("apeMat").value     = data.apellidoMaterno;
                document.getElementById("fecha").value      = data.fechaNacimiento;
                document.getElementById("telFijo").value    = data.telefono;
                document.getElementById("telCelu").value    = data.celular;
                document.getElementById("direccion").value  = data.direccion;
                document.getElementById("email").value      = data.email;
                document.getElementById("ocupacion").value  = data.ocupacion;
                document.getElementById("rutTitular").value = rut;
                document.getElementById("rutApo").value     = rut;
                
                //$("input:radio").removeAttr("checked");
                if (data.sexo == 'FEMENINO'){
                    
                    //$("#sex").append('Masculino <input type="radio" name="sexo" value="1">Femenino<input type="radio" name="sexo" value="0" id="femenino" checked>');
                }
                //document.getElementById("sexo").value = data.sexo;
                
                //$('select').empty(append('comuna'));
                $("<option class='one' selected='selected' value='"+data.comId+"'>"+data.comNombre+"</option>").appendTo("#comuna");
            
                //$('select').empty().append('isapre');
                $("<option selected value='"+data.isaId+"'>"+data.isaNombre+"</option>").appendTo("#isapre");
            }
        })
        
        
        $("#rutApo").focusout(function(){
        ////LIMPIAR INPUTS
        document.getElementById("nombresApo").value = ""; document.getElementById("apePatApo").value = ""; document.getElementById("telFijoApo").value = ""; document.getElementById("telCeluApo").value = ""; document.getElementById("direccionApo").value = ""; document.getElementById("emailApo").value = ""; document.getElementById("rutApoEco").value = "";
        $("#rutApoEco").attr("disabled", false).css("border-color","#ccc");
        $("#divFichaApoderado").show();  
        var rut = $( "#rutApo" ).val();
        var rut = rut.replace(".", "");var rut = rut.replace("-", "");var rut = rut.replace(",", ""); var rut = rut.replace(".", "");
        var rut = rut.substring(0, 8);
       
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/ingresos/index/"+rut,
            dataType: 'json',
            
            success: function(data){
                
                document.getElementById("nombresApo").value     = data.nombres;
                document.getElementById("apePatApo").value      = data.apellidoPaterno;
                document.getElementById("telFijoApo").value     = data.telefono;
                document.getElementById("telCeluApo").value     = data.celular;
                document.getElementById("direccionApo").value   = data.direccion;
                document.getElementById("emailApo").value       = data.email;
                document.getElementById("rutApoEco").value      = data.rut;
                
                
               }
        })
        })
        
        $("#rutApoEco").focusout(function(){
        ////LIMPIAR INPUTS
        document.getElementById("nombresApoEco").value = ""; document.getElementById("apePatApoEco").value = ""; document.getElementById("telFijoApoEco").value = ""; document.getElementById("telCeluApoEco").value = ""; document.getElementById("direccionApoEco").value = ""; document.getElementById("emailApoEco").value = "";
        $("#rutEco").attr("disabled", false).css("border-color","#ccc");
        $("#divFichaEconomico").show();  
        var rut = $( "#rutApoEco" ).val();
        var rut = rut.replace(".", "");var rut = rut.replace("-", "");var rut = rut.replace(",", ""); var rut = rut.replace(".", "");
        var rut = rut.substring(0, 8);
       
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/ingresos/index/"+rut,
            dataType: 'json',
            
            success: function(data){
                
                document.getElementById("nombresApoEco").value     = data.nombres;
                document.getElementById("apePatApoEco").value      = data.apellidoPaterno;
                document.getElementById("telFijoApoEco").value     = data.telefono;
                document.getElementById("telCeluApoEco").value     = data.celular;
                document.getElementById("direccionApoEco").value   = data.direccion;
                document.getElementById("emailApoEco").value       = data.email;
                
               }
        })
        })
        
        $("#rutDev").focusout(function(){
        ////LIMPIAR INPUTS
        document.getElementById("emailDev").value = ""; document.getElementById("nombresDev").value = ""; document.getElementById("apePatDev").value = "";
        $("#rutEco").attr("disabled", true).css("background-color","transparent");
        var rut = $( "#rutDev" ).val();
        var rut = rut.replace(".", "");var rut = rut.replace("-", "");var rut = rut.replace(",", ""); var rut = rut.replace(".", "");
        var rut = rut.substring(0, 8);
       
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/ingresos/index/"+rut,
            dataType: 'json',
            
            success: function(data){
                
                //AUTOCOMPLETA CAMPOS DEVOLUCIONES
                document.getElementById("emailDev").value           = data.email;
                document.getElementById("nombresDev").value         = data.nombres;
                document.getElementById("apePatDev").value          = data.apellidoPaterno;
                
               }
        })
        })
        
    
});
</script>    
<script>
    $("#divApo").click(function(){
        
        $("#divFichaApoderado").show();  
    })
    $("#divEco").click(function(){
        $("#divFichaEconomico").show();  
    })
</script>
<script>
        $("#rut").keyup(function (event){
		var tecla = (document.all) ? event.keyCode : event.which;
                //alert(tecla);
		if(tecla == 8 || tecla == 46){
                    document.getElementById("rut").value = "";
		}
	});
        $("#rutApo").keyup(function (event){
		var tecla = (document.all) ? event.keyCode : event.which;
                //alert(tecla);
		if(tecla == 8 || tecla == 46){
                    document.getElementById("rutApo").value = "";
		}
	});
        $("#rutApoEco").keyup(function (event){
		var tecla = (document.all) ? event.keyCode : event.which;
                //alert(tecla);
		if(tecla == 8 || tecla == 46){
                    document.getElementById("rutApoEco").value = "";
		}
	});
        $("#rutTitular").keyup(function (event){
		var tecla = (document.all) ? event.keyCode : event.which;
                //alert(tecla);
		if(tecla == 8 || tecla == 46){
                    document.getElementById("rutTitular").value = "";
		}
	});

</script>
<div id="exportar" style=" display:none">
    <table class='table table-bordered table-hover table-striped'>
        <thead>
            <tr>
                <th>Fecha Registro</th>
                <th>Run</th>
                <th>N de Ficha</th>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Direccion</th>
                <th>Comuna</th>
                <th>Telefono</th>
                <th>Celular</th>
                <th>Fecha de Nacimiento</th>
                <th>Ocupacion</th>
                <th>Fecha Salida</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ($datos as $item) : ?>
            <tr>
                <td><?php echo $item->dateIn; ?></td>
                <td><?php if(!empty($item->rut)) echo formatearRut($item->rut); ?></td>
                <td><?php echo $item->ficha; ?></td>
                <td><?php echo strtoupper($item->nombres); ?></td>
                <td><?php echo strtoupper($item->apellidoPaterno); ?></td>
                <td><?php echo strtoupper($item->apellidoMaterno); ?></td>
                <td><?php echo strtoupper($item->direccion); ?></td>
                <td><?php echo strtoupper($item->comNombre); ?></td>
                <td><?php echo strtoupper($item->telefono); ?></td>
                <td><?php echo strtoupper($item->celular); ?></td>
                <td><?php echo strtoupper($item->fechaNacimiento); ?></td>
                <td><?php echo strtoupper($item->ocupacion); ?></td>
                <td><?php IF($item->fechaSalidaReal === '0000-00-00' || empty($item->fechaSalidaReal))echo ' '; ELSE echo $item->fechaSalidaReal; ?></td>
                                
            </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $("#btnExport").click(function(e) {

        //Creamos un Elemento Temporal en forma de enlace
        var tmpElemento = document.createElement('a');
        // obtenemos la informaciÃ³n desde el div que lo contiene en el html
        // Obtenemos la informaciÃ³n de la tabla
        var data_type = 'data:application/vnd.ms-excel';
        var tabla_div = document.getElementById('exportar');
        var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
        tmpElemento.href = data_type + ', ' + tabla_html;
        //Asignamos el nombre a nuestro EXCEL
        tmpElemento.download = 'Registros de Ingresos.xls';
        // Simulamos el click al elemento creado para descargarlo
        tmpElemento.click();

        //var htmltable= document.getElementById('imprimir');
        //var html = htmltable.outerHTML;
        //window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    });

</script>





<div id="imprimir" style=" display:none">
    <table class='table table-bordered table-hover table-striped'>
        <thead>
            <tr>
                <th>Fecha Registro</th>
                <th>Run</th>
                <th>N de Ficha</th>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Fecha Salida</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ($datos as $item) : ?>
            <tr>
                <td><?php echo $item->dateIn; ?></td>
                <td><?php if(!empty($item->rut)) echo formatearRut($item->rut); ?></td>
                <td><?php echo $item->ficha; ?></td>
                <td><?php echo strtoupper($item->nombres); ?></td>
                <td><?php echo strtoupper($item->apellidoPaterno); ?></td>
                <td><?php echo strtoupper($item->apellidoMaterno); ?></td>
                <td><?php IF($item->fechaSalidaReal === '0000-00-00' || empty($item->fechaSalidaReal))echo ' '; ELSE echo $item->fechaSalidaReal; ?></td>
                                
            </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=500,width=800');
        mywindow.document.write('<html><head><title>Listado de Ingresos</title>');
        mywindow.document.write('<style>'+
                'table{border-collapse: collapse; border:black 2px solid;font-family: Arial; font-size: 100%;} '+
                '.cabecera{border-collapse: collapse; border:black 2px solid;font-family: Arial; } '+
                'td{border:grey 1px solid; height:25px;} '+
                'body{font-size: 100%;font-family: Arial;} '+
                '.titulo{font-weight: bold;} '+
                'label{font-weight: bold;} '+
                '</style>');
        
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        
        //goBack();

        return true;
    }
    function goBack()
    {
        
        window.history.go(-1);
    }
    
</script>


<script>
    $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/charts/lineaRECLAMOS/",
            dataType: 'json',
            
            success: function(datos){
                var keyVar;
                var cant = new Array;
                var dias = new Array;
                var cantT = '';
                
                    for(keyVar in datos) {
                        var can = '';
                        can = parseInt(datos[keyVar].cant);
                        cantT = cantT * 1 + can;
                        cant = cant.concat(can);
                        var dia = '';
                        dia = datos[keyVar].mes;
                        if(dia==='11')dia='Noviembre';if(dia==='12')dia='Diciembre';else if(dia==='1')dia='Enero';else if(dia==='2')dia='Febrero';else if(dia==='3')dia='Marzo';else if(dia==='4')dia='Abril';else if(dia==='5')dia='Mayo';else if(dia==='6')dia='Junio';else if(dia==='7')dia='Julio';else if(dia==='8')dia='Agosto';else if(dia==='9')dia='Septiembre';else if(dia==='10')dia='Octubre';
                        dias = dias.concat(dia);
                    }
                    Highcharts.chart('container', {
                        title: {
                            text: 'Registro total de reclamos CETEP',
                            x: -20 //center
                        },
                        subtitle: {
                            //text: 'Por Mes',
                            //x: -20
                        },
                        xAxis: {
                            title: {
                                text: 'Mes'
                            },
                            categories: dias
                        },
                        yAxis: {
                            title: {
                                text: 'Cantidad'
                            },
                            //plotLines: [{
                            //    value: 0,
                            //    width: 1,
                            //    color: '#808080'
                            //}]
                        },
                        //tooltip: {
                        //    valueSuffix: '°C'
                        //},
                        //legend: {
                        //    layout: 'vertical',
                        //    align: 'right',
                        //    verticalAlign: 'middle',
                        //    borderWidth: 0
                        //},
                        series: [{
                            name: 'Universo total: '+cantT+'  reclamos ',
                            data: cant
                        }]
                    });

            }
        });
</script>



<script>
    
    $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/charts/pieRECLAMOS/",
            dataType: 'json',
            
            success: function(datos){
                var keyVar;
                //APOYO
                var dti = 0;
                var comunicaciones = 0;
                var operaciones = 0;
                var calidad = 0;
                var uaf = 0;
                var contabilidad = 0;
                var comercial = 0;
                
                //PRODUCCION
                 var otec = 0;
                 var mirandes_clinica = 0;
                 var upc = 0;
                 var usl = 0;
                 var uac = 0;
                 var mirandes_hd = 0;
                 var mirandes_conce = 0;
                 var mirandes_rancagua = 0;
                
                 var cantT = 0;
               
                
                    for(keyVar in datos) {
                        //APOYO
                        if(datos[keyVar].recArea === 'DTI'){dti = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === 'COMUNICACIONES'){comunicaciones = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === 'CONTABILIDAD'){contabilidad = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === 'OPERACIONES'){operaciones = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === 'CALIDAD'){calidad = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === 'UAF-GESTION DE RRHH'){uaf = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === 'COMERCIAL'){comercial = parseInt(datos[keyVar].cant);}
                        
                        //PRODUCCIÓN
                        if(datos[keyVar].recArea === '10'){otec = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === '13'){mirandes_clinica = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === '3'){upc = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === '30'){usl = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === '4'){uac = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === '11'){mirandes_hd = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === '20'){mirandes_conce = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].recArea === '36'){mirandes_rancagua = parseInt(datos[keyVar].cant);}
                        
                        
                    }
                    //alert(dti);alert(comunicaciones);alert(contabilidad);
                    //console.log(proveedor);
                    //console.log(proveedor);
                   cantT = dti+comunicaciones+contabilidad+operaciones+calidad+uaf+comercial+otec+mirandes_clinica+upc+usl+uac+mirandes_hd+mirandes_conce+mirandes_rancagua;
                   //console.log(cantT);
                    
                    
                    Highcharts.chart('pie1', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: null,
                            type: 'pie'
                        },
                        title: {
                            text: 'Reclamos Por Unidad'
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
                                    name: 'Mirandes Clínica',
                                    y: mirandes_clinica
                                },{
                                    name: 'Mirandes HD',
                                    y: mirandes_hd
                                },{
                                    name: 'Mirandes Concepción',
                                    y: mirandes_conce
                                },{
                                    name: 'Mirandes Rancagua',
                                    y: mirandes_rancagua
                                },{
                                    name: 'Otec',
                                    y: otec
                                },{
                                    name: 'Centro Médico',
                                    y: uac
                                },{
                                    name: 'Peritajes',
                                    y: upc
                                },{
                                    name: 'Salud Laboral',
                                    y: usl
                                }]
                        }]
                    });

            }
        });
</script>
