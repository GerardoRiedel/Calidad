<style>
@media (max-width: 600px) {
    #foo{
        position: absolute;
        top:500px;
    }
}
</style>
<div class="row" id="foo" style=" background-color: #f4f4f2">
            <div id="footer" class="col-xs-12 activo" style="color: black" >
            2016 &copy; Cetep. Todos los derechos reservados.
            </div>
</div>
        <div class="white-backdrop"></div>
        <script src="<?php echo base_url(); ?>../assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>../assets/js/bootstrap-colorpicker.js"></script>
        <script src="<?php echo base_url(); ?>../assets/js/bootstrap-datepicker.js"></script>
        <!-- aca iba <script src="<?php echo base_url(); ?>assets/js/jquery.icheck.min.js"></script> pero lo movi al header proque molestaba con los checkbox multiples, y debe ir despues de jquery -->
        <script src="<?php echo base_url(); ?>../assets/js/select2.js"></script>
        <script src="<?php echo base_url(); ?>../assets/js/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url(); ?>../assets/js/hs.js"></script>
        <script src="<?php echo base_url(); ?>../assets/js/fontsize.js"></script>
        <script src="<?php echo base_url(); ?>../assets/js/hs.form_common.js"></script>
      
    </div> <!-- wrapper -->
    

</body>

<script>
    $( document ).ready(function() {
        $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>" + "api/session/inicio/",
                dataType: 'json',
                success: function(data){
                    if(data === 'NO'){
                        alert('Session Terminada');
                        window.location.href = "http://www.cetep.cl/calidad/index.php/login/salirSinGuardar";
                    }
                    //else if(data === 'POR'){
                    //    alert('Estimado usuario recuerde que su sesión esta por terminar');
                    //}
                }
            })
    });
</script>
</html>