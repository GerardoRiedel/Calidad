<html>
<head>
   <meta charset="utf-8">
   <title>Mostrar Ventana Modal de forma Automático</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <script>
      $(document).ready(function()
      {
         //setTimeout(function() {window.location.href='<?php base_url(); ?>/'}, 2000);
         //window.history.go(-1);
         //setTimeout(function() {window.history.go(-1)}, 5000);
      });
    </script>
</head>
<body  style="opacity: 0.8">
    <div class="modal-dialog" id="mostrarmodal">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Envio Exitoso</h3>
           </div>
           <div class="modal-body">
               <?php $recId = $this->session->userdata('recId'); ?>
               <?php IF(!empty($recId)){ ?>
                        <h4>Su numero de solicitud es: <b><?php echo $this->session->userdata('recId'); ?></b></h4>
                        <h4>Se ha enviado una copia de su solicitud a su correo, y nos pondremos en contacto con ud a la brevedad</h4>
                        <?php $data = array('recId' => '');$this->session->set_userdata($data); ?>
               <?php } ?>
                        <h5>Gracias por su preferencia</h5>
       </div>
           <div class="modal-footer">
             
                     <a  href="<?php echo base_url();?>" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
               <!-- 
                    <a  onclick="window.history.go(-1)" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
               -->
              
           </div>
      </div>
   </div>
</body>
</html>
