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
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container" style="border-color: #000000;"  >
                
<div class="col-lg-12"> <!-- 
    <div class="col-lg-12">  
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
    <div class="col-lg-6">
    <div id="pie" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>-->
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
                
                
                
                
                <i class="fa fa-table" id="btnExport" style="cursor: pointer; color:#1d7044;font-size:25px;margin-top:10px;margin-left:20px" title="Exportar Tabla a Excel"></i>  
                 
                <div  class="col-lg-12" style="overflow: auto;margin-top:-8px">
                 
                <table class='table table-bordered table-hover table-striped data-table'>
                        <thead>
                            <tr>
                                <th style="font-size: 8px">N°</th>
                                <th style="font-size: 8px">Fecha</th>
                                <th style="font-size: 8px">Unidad</th>
                                <th style="font-size: 8px">Motivo</th>
                                <th style="font-size: 8px">Nombre</th>
                                <th style="font-size: 8px">Descripción</th>
                                <th style="font-size: 8px">Acción</th>
                                <th style="font-size: 8px">Seguimiento</th>
                                <th style="font-size: 8px">No Cumplimiento de Proveedor</th>
                                <th style="font-size: 8px">No Cumplimiento de Cliente</th>
                                <th style="font-size: 8px">No Cumplimiento de Profesional</th>
                                <th style="font-size: 8px">No Cumplimiento de Paciente</th>
                                <th style="font-size: 8px">No Cumplimiento de Unidad</th>
                                <th style="font-size: 8px">No Cumplimiento de Unidad de Apoyo</th>
                                
                                <th style="font-size: 8px">No Aplica</th>
                                
                                <th style="font-size: 8px">Gestion</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php foreach ($datos as $item) : ?>
                            <tr>
                                <?php $fechaHecho = $item->plaFechaHecho;?>
                                <td style="font-size: 8px"><?php echo $item->plaId; ?></td>
                                <td style="font-size: 8px"><?php IF(!empty($fechaHecho)){$date = new DateTime($fechaHecho);echo $date->format('d-m-Y');}//echo $item->id; ?></td>
                                <td style="font-size: 8px">
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
                                <td style="font-size: 8px"><?php if($item->plaMotivo === '1') $motivo = 'Sugerencia'; elseif($item->plaMotivo === '2') $motivo = 'Reclamo'; elseif($item->plaMotivo === '3') $motivo = 'PSNC'; elseif($item->plaMotivo === '4') $motivo = 'Felicitación';echo $motivo?></td>
                                <td style="font-size: 8px"><?php echo strtoupper($item->plaNombre).' '.strtoupper($item->plaApellido); ?></td>
                                <td style="font-size: 8px;width: 200px"><?php echo substr($item->plaDescripcion,0,200).'...'; ?></td>
                                <td style="font-size: 8px;width: 200px"><?php echo substr($item->plaAccion,0,200).'...'; ?></td>
                                <td style="font-size: 8px;width: 130px"><?php IF($item->plaSeguimiento!='0')echo $item->plaSeguimiento; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaProveedor)    && $item->plaProveedor==='1')   echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaCliente)          && $item->plaCliente==='1')         echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaProfesional)  && $item->plaProfesional==='1') echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaPaciente)      && $item->plaPaciente==='1') echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaUnidadCheck)&& $item->plaUnidadCheck==='1')echo 'SI' ; ?></td>
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaUnidadDeApoyoCheck)&& $item->plaUnidadDeApoyoCheck==='1')echo 'SI' ; ?></td>
                                
                                <td style="font-size: 8px;" align="center"><?php IF(!empty($item->plaNoAplica)       && $item->plaNoAplica==='1')      echo 'SI' ; ?></td>
                                
                                <td align="center">
                                    <?php IF($this->session->userdata('perfil') == '3'){ ?>
                         
                                        <!--
                                        <a class="tip-bottom" title="Imprimir" href="<?php echo base_url("calidad/impresiones/imprimirSugerencia/" . $item->plaId )?>"><i class="fa fa-print" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                        -->
                                        <a class="tip-bottom" title="Gestionar" href="<?php echo base_url("calidad/gestion/modificarNoConforme/" . $item->plaId )?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        
                            
                                <?php } ?>
                                    <!--
                                    <a class="tip-bottom" title="Imprimir" href="<?php echo base_url("calidad/impresiones/imprimirSugerencia/" . $item->plaId )?>"><i class="fa fa-print" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                    
                                    <a class="tip-bottom" title="Gestionar" href="<?php echo base_url("calidad/gestion/cargarRespuesta/" . $item->plaId )?>"><i class="fa fa-reply" aria-hidden="true"></i></a>
                                -->
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


<div  style="display:none;" id="exportar">
                    <?php $color='#D8D8D8';?>
                <table>
                           <tr>
                                <td colspan="18" align="center" style="border:1px grey solid;background-color:#424242;color:white"><b>PLANILLA PRODUCTO / SERVICIO NO CONFORME</b></td>
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
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">Tipo Peritaje</td>
                                
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Proveedor</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Cliente</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Profesional</td>                               
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Paciente</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center">No<br>Cumplimiento<br>de Unidad</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center" colspan="2">No<br>Cumplimiento<br>de Unidad Apoyo</td>
                                <td style="font-size: 9px;background-color: #A9A9A9;" align="center" colspan="2">No<br>Aplica</td>
                            </tr>
                                <?php foreach ($datos as $item) : ?>
                            <tr>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>"><?php echo $item->plaId; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>"><?php $date = new DateTime($item->plaFecha);echo $date->format('d-m-Y');//echo $item->id; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>"><?php IF(!empty($item->plaFechaHecho)){$date = new DateTime($item->plaFechaHecho);echo $date->format('d-m-Y');}//echo $item->id; } ?></td>
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
                                <td style="font-size: 9px;width: 300px;background-color: <?php echo $color; ?>"><?php 
                                                                                                                                                                                        $descripcion = str_replace('á', 'a', $item->plaDescripcion) ;$descripcion = str_replace('é', 'e', $descripcion)  ;$descripcion = str_replace('í', 'i', $descripcion) ;$descripcion = str_replace('ó', 'o', $descripcion)  ;$descripcion = str_replace('ú', 'u', $descripcion);$descripcion = str_replace('ñ', 'n', $descripcion) ; 
                                                                                                                                                                                        echo $descripcion; 
                                                                                                                                                                                    ?>
                                </td>
                                <td style="font-size: 9px;width: 200px;background-color: <?php echo $color; ?>"><?php 
                                                                                                                                                                                        $accion = str_replace('á', 'a', $item->plaAccion) ;$accion = str_replace('é', 'e', $accion)  ;$accion = str_replace('í', 'i', $accion) ;$accion = str_replace('ó', 'o', $accion)  ;$accion = str_replace('ú', 'u', $accion) ; $accion = str_replace('ñ', 'n', $accion) ; 
                                                                                                                                                                                        echo $accion; 
                                                                                                                                                                                ?>
                                </td>
                                <td style="font-size: 9px;width: 130px;background-color: <?php echo $color; ?>"><?php 
                                                                                                                                                                                        $seguimiento = str_replace('á', 'a', $item->plaSeguimiento) ;$seguimiento = str_replace('é', 'e', $seguimiento)  ;$seguimiento = str_replace('í', 'i', $seguimiento) ;$seguimiento = str_replace('ó', 'o', $seguimiento)  ;$seguimiento = str_replace('ú', 'u', $seguimiento) ; $seguimiento = str_replace('ñ', 'n', $seguimiento) ; 
                                                                                                                                                                                        echo $seguimiento; 
                                                                                                                                                                                    ?>
                                </td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaTipo)  && $item->plaTipo==='1')   echo 'Neuroquirurgico' ; ELSEIF(!empty($item->plaTipo)  && $item->plaTipo==='2')   echo 'Psiquiatrico' ;ELSEIF(!empty($item->plaTipo)  && $item->plaTipo==='3')   echo 'Traumatologico ' ; ?></td>
                                
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaProveedor)    && $item->plaProveedor==='1')   echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaCliente)          && $item->plaCliente==='1')         echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaProfesional)  && $item->plaProfesional==='1') echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaPaciente)       && $item->plaPaciente==='1')      echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaUnidadCheck)&& $item->plaUnidadCheck==='1')echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaUnidadDeApoyoCheck) && $item->plaUnidadDeApoyoCheck==='1') echo '1'; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaUnidadDeApoyoCheck) && $item->plaUnidadDeApoyoCheck==='1') echo $item->plaUnidadDeApoyo; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaNoAplica)       && $item->plaNoAplica==='1')      echo '1' ; ?></td>
                                <td style="font-size: 9px;background-color: <?php echo $color; ?>" align="center"><?php IF(!empty($item->plaNoAplicaText))  echo $item->plaNoAplicaText ; ?></td>
                                
                            </tr>
                            <?php 
                                IF($color === '#D8D8D8') $color = '#F2F2F2';
                                ELSE $color = '#D8D8D8';
                            ?>
                                <?php endforeach; ?>
                    </table>
                </div>



    
<script src="<?php echo base_url(); ?>../assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/hs.tables.js"></script>
<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />

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
                //var otro = 0;
                var paciente = 0;
                
                    for(keyVar in datos) {
                        proveedor = parseInt(datos[keyVar].proveedor);
                        cliente = parseInt(datos[keyVar].cliente);
                        profesional = parseInt(datos[keyVar].profesional);
                        unidad = parseInt(datos[keyVar].unidad);
                        apoyo = parseInt(datos[keyVar].apoyo);
                        //otro = parseInt(datos[keyVar].otro);
                        paciente = parseInt(datos[keyVar].paciente);
                        //console.log(datos[keyVar].apoyo);
                    }
                    //console.log(proveedor);
                    //console.log(proveedor);
                    
                   cantT = parseInt(proveedor)+parseInt(cliente)+parseInt(profesional)+parseInt(unidad)+parseInt(apoyo)+parseInt(paciente);
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
                                    y: apoyo,
                                    sliced: true,
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
                var cantT = 0;
               
                
                    for(keyVar in datos) {
                        //alert(datos[keyVar].plaUnidadDeApoyo);
                        if(datos[keyVar].plaUnidadDeApoyo === 'DTI'){dti = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'COMUNICACIONES'){comunicaciones = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'CONTABILIDAD'){contabilidad = parseInt(datos[keyVar].cant);}
                        
                        if(datos[keyVar].plaUnidadDeApoyo === 'OPERACIONES'){operaciones = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'CALIDAD'){calidad = parseInt(datos[keyVar].cant);}
                        if(datos[keyVar].plaUnidadDeApoyo === 'UAF-GESTION DE RRHH'){uaf = parseInt(datos[keyVar].cant);}
                        
                        if(datos[keyVar].plaUnidadDeApoyo === 'COMERCIAL'){comercial = parseInt(datos[keyVar].cant);}
                        
                        
                    }
                    //alert(dti);alert(comunicaciones);alert(contabilidad);
                    //console.log(proveedor);
                    //console.log(proveedor);
                   cantT = dti+comunicaciones+contabilidad+operaciones+calidad+uaf+comercial;
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
                                    name: 'UAF-Gestion de RRHH',
                                    y: uaf
                                },{
                                    name: 'Dti',
                                    y: dti
                                },{
                                    name: 'Operaciones',
                                    y: operaciones
                                }]
                        }]
                    });

            }
        });
</script>



