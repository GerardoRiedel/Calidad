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
        <h1 style="background-color: #a15ebe !important;border:none;color:#ffffff; margin-right: 30px;-webkit-box-shadow: 10px 10px 23px -6px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 23px -6px rgba(0,0,0,0.75);box-shadow: 10px 10px 23px -6px rgba(0,0,0,0.75);" class="alert alert-info"><?php echo $title;?></h1>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
			
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container" style="border-color: #000000;"  >
            <?php $attributes = array('id' => 'form');
                echo form_open('calidad/gestion/guardarSugerencia',$attributes);
            ?>
                            
            <div class='widget-content'>
                
                <div id="divFicha"><!--COMIENZO TRATAMIENTO DE FICHA-->
                    <div class="col-lg-12" ><br></div>
                <!-- DATOS DE PERSONALES-->   
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">
                    <label class="titulo">Antecedentes Paciente</label>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <label>Rut</label> 
                    </div>
                    <div class='col-lg-4'>
                        <input name="rut"  type="text" placeholder="Digite run de paciente" minlength="7" required id="rut"><br><h7 style="font-size:8px">&nbsp;&nbsp;&nbsp;ejemplo 12345678-9</h7>
                    </div>
                    <div class="col-lg-12"></div>
                    <div class="col-lg-1"></div>
                     <div class="col-lg-2">
                        <label>Nombres</label>
                    </div>
                    <div class='col-lg-4'>
                        <input name="nombre"  type="text" minlength="3" required>
                    </div>
                    <div class="col-lg-12"></div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <label>Apellido Paterno</label>
                    </div>
                    <div class='col-lg-3'>
                        <input name="apePat"  type="text" minlength="3" required>
                    </div> 
                    <div class="col-lg-2">
                        <label>Apellido Materno</label>
                    </div>
                    <div class='col-lg-3'>
                        <input name="apeMat"  type="text" minlength="3" required>
                    </div>     
                    <div class="col-lg-12"></div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <label>Domicilio</label>
                    </div>
                    <div class='col-lg-3'>
                        <input name="domicilio"  type="text" minlength="3" required>
                    </div> 
                     <div class="col-lg-2">
                        <label>Comuna</label>
                    </div>
                    <div class='col-lg-3' >
                         <select name="comuna" id="comuna">
                            <option value="0">Seleccione...</option>
                            <?php foreach($comuna as $com): ?>
                                <option value="<?php echo $com->comId;?>"><?php echo $com->comNombre;?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-1" align="left" style="margin-left:-50px">
                        <img class="icon" src="<?php echo base_url();?>../assets/img/icons/signo.png" id="iconCom"/>
                    </div>
                    <div class="col-lg-12"></div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <label>Teléfono</label>
                    </div>
                    <div class='col-lg-3'>
                        <input name="telefono" type="text" minlength="9" pattern="[0-9]{9}" required id="telefono" title="Ingrese un telefono valido de 9 números">
                    </div>
                    <div class="col-lg-2">
                        <label>Email</label>
                    </div>
                    <div class='col-lg-4'>
                        <input name="email" type=   "text" minlength="9" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" title="mail@ejemplo.com"  required="true">
                    </div>
                </div> 
                
                
                <div class="col-lg-12" ><br></div>
                <!-- DATOS DE PERSONALES-->     
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">
                        <label>Describa</label> 
                    </div>
                    <div class="col-lg-1"></div>
                    <div class='col-lg-10'>
                        <textarea name="hechos" style=" width: 94%; height: 100px" placeholder="Describa aquí sus felicitaciones o sugerencias" required></textarea>
                    </div>
                    <div class='col-lg-12'><br></div>
                <div class="col-lg-12" align="center">
                    <?php echo form_submit('','Enviar','class="btn btn-primary btn-sm btnCetep"');?>
                    <?php echo form_close();?>
                </div>
                    <div class="col-lg-12"><br></div>
</div><!-- FIN DIV FICHA COMPLETA-->
                
        </div><!-- div class='widget-content'-->    
                    
                
                
            </div><!-- div class="col-xs-12" -->
        </div><!-- row -->
   </div>
</div><!-- content -->

<script>
    //////VALIDACIONES DE TECLAS//////
        $("#telefono").keyup(function (event){
                if(event.keyCode == 8 || event.keyCode == 46){
                    document.getElementById("telefono").value = "";
                }
                else if (event.keyCode == 13 || event.keyCode == 110 || event.keyCode == 190 || event.keyCode == 75 || event.keyCode > 95 && event.keyCode < 106 || event.keyCode == 27 || event.keyCode == 190 || event.keyCode == 111 || event.keyCode == 16 || event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode > 47 && event.keyCode < 58)
                {}
                else {
                texto = $( "#telefono" ).val();
                texto = texto.substring(0,texto.length-1);
                document.getElementById("telefono").value = texto;
                event.returnValue = false;
                }
        });
</script>

<script>
   $("#rut").bind({
        
    focusout:function(){
    
        var rut = $( "#rut" ).val();
        var validar = validaRut(rut);
        if (validar != true && rut !== ''){
            alert('Rut Invalido');
          document.getElementById("rut").value = '';
          //$("#rut").attr("disabled", false).css("box-shadow","0 0 15px red"); event.stopPropagation()
        }
    }
    });
</script>

<script>
$(".icon").hide();
$("#form").submit(function () { 
    $(".icon").hide();
     if($("#comuna").val()==='0') {  
        $("#iconCom").show();
        return false;
    }
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

