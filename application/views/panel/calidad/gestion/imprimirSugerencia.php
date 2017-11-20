
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
    $fecha = new DateTime($sugerencia->sugFecha);
        $fecha = $fecha->format('d-m-Y');
        $rut = formatearRut($sugerencia->sugRut);
        $nombre = strtoupper($sugerencia->sugNombre)." ".strtoupper($sugerencia->sugApePat)." ".strtoupper($sugerencia->sugApeMat);
        $domicilio = strtoupper($sugerencia->sugDomicilio);
        $comuna = strtoupper($sugerencia->comNombre);
        $telefono = $sugerencia->sugTelefono;
        $email = strtoupper($sugerencia->sugEmail);
        $hecho = strtoupper($sugerencia->sugHechos);
        $resumen="
            
        
        <table border='0'>
            <tr>
                <td rowspan='2' style='width:650px'>
                    <img style='width: 20%; ' src='".base_url()."../assets/img/mirAndes.png' >
                </td>
                <td style='border-right:none;width:50px' align='center'>N°</td>
                <td style='border-left:none;width:100px'>".$sugerencia->sugId."</td>
            </tr>
            <tr>
                <td style='border-right:none' align='center'>Fecha</td>
                <td style='border-left:none'>".$fecha."</td>
            </tr>
        </table>
        
        <table border='1' style='width:800px'>
            <tr>
                <td colspan='2'>Paciente</td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td>".$nombre."</td>
            </tr>
            <tr>
                <td>Rut</td>
                <td>".$rut."</td>
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
                <td colspan='2'>Felicitación o Sugerencia</td>
            </tr>
            <tr>
                <td colspan='2'>".$hecho."</td>
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
    

