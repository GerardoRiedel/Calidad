<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<div id="content" style="-webkit-box-shadow: -2px 2px 41px 2px rgba(0,0,0,0.75);
-moz-box-shadow: -2px 2px 41px 2px rgba(0,0,0,0.75);
box-shadow: -2px 2px 41px 2px rgba(0,0,0,0.75);z-index: 25; background-color: #db8918">
    <div id="content-header" style="background-color: #e9c899; " >
    </div>
    
    
    

    <div class="container-fluid" >
        
                

			
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container" style="margin-top:-75px"  >
            
                            
            <div class='widget-content'>
                
                  
                    
                    
                
                
                    
                    
                    
                <div class="col-lg-12"> <!-- 
    <div class="col-lg-12">  
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
    <div class="col-lg-6">
    <div id="pie" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>-->
    <div class="col-lg-12">
    <div id="pie2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div><!--
    <div class="col-lg-12">  
    <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>-->
</div>

                
 
                
                
        </div><!-- div class='widget-content'-->    
                    
                
                
            
   </div>
</div><!-- content -->
</div>



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
                
                    for(keyVar in datos) {
                        proveedor = parseInt(datos[keyVar].proveedor);
                        cliente = parseInt(datos[keyVar].cliente);
                        profesional = parseInt(datos[keyVar].profesional);
                        unidad = parseInt(datos[keyVar].unidad);
                        apoyo = parseInt(datos[keyVar].apoyo);
                    }
                    //console.log(proveedor);
                    //console.log(proveedor);
                   cantT = proveedor+cliente+profesional+unidad+apoyo;
                   //console.log(cantT);
                    
                    
                    Highcharts.chart('pie2', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Porcentaje de No Cumplimiento Por Item'
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
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Porcentaje',
                            colorByPoint: true,
                            data: [{
                                    name: 'Proveedor. ',
                                    y: proveedor,
                                    //sliced: true,
                                    //selected: true
                                },{
                                    name: 'Cliente. ',
                                    y: cliente,
                                },{
                                    name: 'Profesional. ',
                                    y: profesional,
                                },{
                                    name: 'Unidad de Negocio. ',
                                    y: unidad,
                                },{
                                    name: 'Unidad de Apoyo. ',
                                    y: apoyo,
                                }]
                        }]
                    });

            }
        });
</script>






















<script>
    $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/charts/index/",
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
                            text: 'Cantidad de Registros Mensuales a la Clínica',
                            x: -20 //center
                        },
                        subtitle: {
                            text: 'Por Mes',
                            x: -20
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
                            name: 'Universo: '+cantT+' pacientes',
                            data: cant
                        }]
                    });

            }
        });
</script>
<script>
    //PIE SEXO
    $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/charts/pieSexo/",
            dataType: 'json',
            
            success: function(datos){
                var keyVar;
                var cantM = new Array;
                var cantF = new Array;
                var cantT = '';
                
                    for(keyVar in datos) {
                        var can = '';
                        can = parseInt(datos[keyVar].cant);
                        cantT = cantT * 1 + can;
                        if(datos[keyVar].sexo === 'MASCULINO'){
                            cantM = cantM.concat(can);}
                        else if(datos[keyVar].sexo === 'FEMENINO'){
                            cantF = cantF.concat(can);}
                    }
                    cantM = cantM * 100/cantT;
                    cantF = cantF * 100/cantT;
                    
                    Highcharts.chart('pie', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Variabilidad por Sexo'
                        },
                        subtitle: {
                            text: 'Universo: '+cantT+' pacientes',
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
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Porcentaje',
                            colorByPoint: true,
                            data: [{
                                    name: 'Mujeres',
                                    y: cantF,
                                    //sliced: true,
                                    //selected: true
                                },{
                                    name: 'Hombres',
                                    y: cantM
                                }]
                        }]
                    });

            }
        });
</script>

<script>
    //BARRA DEPOSITO
    $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>" + "api/charts/depositos/",
            dataType: 'json',
            
            success: function(datos){
                var keyVar;
                var cheque = new Array;
                var efectivo = new Array;
                var trans = new Array;
                var web = new Array;
                var cred = new Array;
                var deb = new Array;
                var cheqN = tranN = efecN = weN = creN = deN = cantT = 0;
                var cheqD = tranD = efecD = weD = creD = deD = 0;
                var cheqE = tranE = efecE = weE = creE = deE = 0;
                var cheqF = tranF = efecF = weF = creF = deF = 0;
                var cheqM = tranM = efecM = weM = creM = deM = 0;
                var cheqA = tranA = efecA = weA = creA = deA = 0;
                //var trans = 0;
                //efectivo = 0;
                    for(keyVar in datos) {
                        var tip = '';
                        tip     = parseInt(datos[keyVar].depTipo);
                        
                        var can = '';
                        can     = parseInt(datos[keyVar].monto);
                        
                        var dia = '';
                        dia = datos[keyVar].mes;
                        if(dia==='11'){
                            if      (tip===1)efecN  = efecN * 1 + can;
                            else if (tip===2)cheqN  = cheqN * 1 + can;
                            else if (tip===3)tranN  = tranN * 1 + can;
                            else if (tip===4)weN    = weN * 1 + can;
                            else if (tip===5)creN   = creN * 1 + can;
                            else if (tip===6)deN    = deN * 1 + can;
                        }
                        else if(dia==='12'){
                            if      (tip===1)efecD  = efecD * 1 + can;
                            else if (tip===2)cheqD  = cheqD * 1 + can;
                            else if (tip===3)tranD  = tranD * 1 + can;
                            else if (tip===4)weD    = weD * 1 + can;
                            else if (tip===5)creD   = creD * 1 + can;
                            else if (tip===6)deD    = deD * 1 + can;
                        }
                        else if(dia==='1'){
                            if      (tip===1)efecE  = efecE * 1 + can;
                            else if (tip===2)cheqE  = cheqE * 1 + can;
                            else if (tip===3)tranE  = tranE * 1 + can;
                            else if (tip===4)weE    = weE * 1 + can;
                            else if (tip===5)creE   = creE * 1 + can;
                            else if (tip===6)deE    = deE * 1 + can;
                        }
                        else if(dia==='2'){
                            if      (tip===1)efecF  = efecF * 1 + can;
                            else if (tip===2)cheqF  = cheqF * 1 + can;
                            else if (tip===3)tranF  = tranF * 1 + can;
                            else if (tip===4)weF    = weF * 1 + can;
                            else if (tip===5)creF   = creF * 1 + can;
                            else if (tip===6)deF    = deF * 1 + can;
                        }
                        else if(dia==='3'){
                            if      (tip===1)efecM  = efecM * 1 + can;
                            else if (tip===2)cheqM  = cheqM * 1 + can;
                            else if (tip===3)tranM  = tranM * 1 + can;
                            else if (tip===4)weM    = weM * 1 + can;
                            else if (tip===5)creM   = creM * 1 + can;
                            else if (tip===6)deM    = deM * 1 + can;
                        }
                        else if(dia==='4'){
                            if      (tip===1)efecA  = efecA * 1 + can;
                            else if (tip===2)cheqA  = cheqA * 1 + can;
                            else if (tip===3)tranA  = tranA * 1 + can;
                            else if (tip===4)weA    = weA * 1 + can;
                            else if (tip===5)creA   = creA * 1 + can;
                            else if (tip===6)deA    = deA * 1 + can;
                        }
                        //else if(dia==='5'){
                        //    dia='Mayo';
                        //}
                        //else if(dia==='6'){
                        //    dia='Junio';
                        //}
                        //else if(dia==='7'){
                        //    dia='Julio';
                        //}
                        //else if(dia==='8'){
                        //    dia='Agosto';
                        //}
                        //else if(dia==='9'){
                        //    dia='Septiembre';
                        //}
                        //else if(dia==='10'){
                        //    dia='Octubre';
                        //}
                        
                        
                        }
                        efectivo = efectivo.concat(efecN).concat(efecD).concat(efecE).concat(efecF);//.concat(efecM);//.concat(efecA);
                        cheque = cheque.concat(cheqN).concat(cheqD).concat(cheqE).concat(cheqF);//.concat(cheqM);//.concat(cheqA);
                        trans  = trans.concat(tranN).concat(tranD).concat(tranE).concat(tranF);//.concat(tranM);//.concat(tranA);
                        web  = web.concat(weN).concat(weD).concat(weE).concat(weF);//.concat(weM);//.concat(weA);
                        cred  = cred.concat(creN).concat(creD).concat(creE).concat(creF);//.concat(creM);//.concat(creA);
                        deb  = deb.concat(deN).concat(deD).concat(deE).concat(deF);//.concat(deM);//.concat(deA);
                    
                    
                    //alert(mes);
                    Highcharts.chart('container2', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Flujo de Caja Mensual',
                            x: -20 //center
                        },
                        xAxis: {
                            title: {
                                text: 'Mes'
                            },
                            categories: ['Noviembre','Diciembre','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre']
                        },
                        yAxis: {
                            title: {
                                text: 'Monto'
                            },
                            stackLabels: {
                                enabled: true,
                                style: {
                                    fontWeight: 'bold',
                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                }
                            }
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        tooltip: {
                            headerFormat: '<b>{point.x}</b><br/>',
                            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                        },
                        plotOptions: {
                            column: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: true,
                                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                                }
                            }
                        },
    
                        series: [{
                            name: 'Efectivo',
                            data: efectivo
                        },{
                            name: 'Transferencia',
                            data: trans
                        },{
                            name: 'Cheque',
                            data: cheque
                        },{
                            name: 'Web Pay',
                            data: web
                        },{
                            name: 'Crédito',
                            data: cred
                        },{
                            name: 'Débito',
                            data: deb
                        }]
                    });

            }
        });
</script>