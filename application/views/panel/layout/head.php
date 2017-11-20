
<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
<?php IF(empty($title))$title = 'Cetep'; ?>
    <title>Cetep :: <?php echo $title;?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/colorpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/datepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/icheck/flat/blue.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/hs_admin.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/hs_admin2.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/sprite.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/jquery.gritter.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/component.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/export.css" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>../favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="<?php echo base_url(); ?>../favicon.ico" type="image/x-icon"/>
    <script  src="<?php echo base_url(); ?>../assets/js/jquery.min.js"></script>
    <script  src="<?php echo base_url(); ?>../assets/js/cron.js"></script>
    <script  src="<?php echo base_url(); ?>../assets/js/jquery.icheck.min.js"></script>
    <script  src="<?php echo base_url(); ?>../assets/js/jquery-ui.custom.js"></script>
    <script  src="<?php echo base_url(); ?>../assets/js/amcharts.js"></script>
    <script  src="<?php echo base_url(); ?>../assets/js/export.js"></script>
   
</head>

<body data-color="grey" style="padding: 0 !important; background-color: transparent" class="flat <?php //echo $clase; ?> " >
    <!--
<div id="wrapper" style="background-color: #e9c899">
    -->
    <div id="wrapper" style="background-color: #f4f4f2">
        
    	
<div class=" header header" >
    <!--LOGO mirandes-->	
    <div id="logos" style="width: 120%;position:relative;left:1200px" >
        <img  style="height: 105px;margin-top: 40px" src="<?php echo base_url();?>../assets/img/logo_vertical_cetep.png" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img  style="height: 90px;margin-top: 45px" src="<?php echo base_url();?>../assets/img/MirandesTrans.png" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img  style="height: 90px;margin-top: 45px" src="<?php echo base_url();?>../assets/img/logo impulsa.png" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img  style="height: 90px;margin-top: 45px" src="<?php echo base_url();?>../assets/img/trf.png" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img  style="height: 90px;margin-top: 45px" src="<?php echo base_url();?>../assets/img/atrapa.png" />
    </div>
    <!--FIN LOGO mirandes-->	

    <center>
    <style>
    @media (max-width: 600px) {
      .subcontainer {
        display: none;
      }
      #content-logo {
        margin-left: -60px;
        text-align:center;
      }
      .activo{
        display: none;
        }
    }
    .container-fluid{
        background:#e9c899;
    }
    .activo{
        font-size: 7px;
    }
    </style>
    </center>
</div>
    
<script>
    $(document).ready(function() {
        
    function ocultar(){
        $("#logos").animate({
            left:'-1200px',
        },20000,'linear');
        mostrar();
    }
    function mostrar(){
         $("#logos").animate({
            left:'1300px',
        },0,'linear');
        ocultar();
    }
        window.onload=ocultar;
});
    </script>


