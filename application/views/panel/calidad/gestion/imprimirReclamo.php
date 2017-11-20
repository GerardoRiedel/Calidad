
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=500,width=800');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('<style>'+
                'table{border-collapse: collapse; border:black 2px solid;font-family: Arial; font-size: 100%;} '+
                '.cabecera{border-collapse: collapse; border:black 2px solid;font-family: Arial; } '+
                'td{border:grey 1px solid; height:25px;} '+
                'body{font-size: 80%;font-family: Arial;} '+
                '.titulo{font-weight: bold;} '+
                'label{font-weight: bold;} '+
                '.cuadrado{color:black;width: 20px; height: 20px; '+
                'border: 1px solid #555;} '+
                '.cuadradoCheck {width: 20px; height: 20px; border: 10px solid #555; }'+
                '</style>');
        
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        
        
        mywindow.print();
        
        mywindow.close();
        
        goBack();

        return true;
    }
    function goBack()
    {
        window.history.go(-1);
    }
    
</script>
<body onload="PrintElem('#imprimir')">

<div id="imprimir" style="display: none">
    <?php
    
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
        
        
        $hecho = $reclamo->recHechos;
        $peticion = $reclamo->recPeticion;
        
        $resumen="
        <table border='0'>
            <tr>
                <td rowspan='2' style='width:650px'>
                    <img style='width: 20%; ' src='".base_url()."../assets/img/mirAndes.png' >
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
        
        ";
        echo $resumen;
        ?>
</div>
</body>
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
    

