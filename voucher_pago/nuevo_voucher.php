<!DOCTYPE html>
<?php
date_default_timezone_set('america/lima');
$fecha_matricula= date("Y-m-d");
?>
<head>
   <link rel="stylesheet" href="/plugins/jquery-ui.css">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/plugins/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/plugins/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/plugins/plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/plugins/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="/plugins/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="/plugins/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/plugins/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/plugins/dist/css/AdminLTE.min.css">
    <script src="/plugins/plugins/select2/select2.full.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/plugins/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/plugins/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/plugins/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/plugins/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/plugins/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/plugins/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script src="/plugins/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="/plugins/plugins/select2/select2.full.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="/plugins/plugins/morris/morris.min.js"></script>

    <!-- Sparkline -->
    <script src="/plugins/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="/plugins/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/plugins/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/plugins/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="/plugins/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="/plugins/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/plugins/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="/plugins/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/plugins/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="/plugins/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/plugins/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/plugins/dist/js/demo.js"></script>
   <style>
      input[type="text"] {
         text-transform:uppercase;
      }
   </style>
</head>
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
         <div class="box-header with-border">
            <h3 class="box-title"><b>VOUCHER DE PAGO</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
         <label id="aviso"></label>
            <form action="procesar.php" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Apoderado:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-users"></i>
                           </div>
                           <input type="text" id="apoderado" class="form-control requerido " placeholder="Por ejemplo, Ever Lazaro"/>
                           <input type="hidden" name="apoderado" id="idapoderado"/>
                        </div>
                     </div>
                  </div>
                  <br>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Numero de voucher:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control requerido numero" name="numero_voucher" placeholder="Ejemplo, 8765345678">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Imagen del voucher:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-camera"></i>
                           </div>
                           <input type="file" name="imagen_voucher" class="form-control habilitado" id="imagen_voucher" >
                        </div>
                        <p class="help-block">Archivos Permitidos(.jpg y.png)</p>
                     </div>                     
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Fecha:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" class="form-control" readonly name="fecha" value="<?php echo "$fecha_matricula";?>" />
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
               <input type="hidden" name="proceso" id="proceso" value=""/>
            </form>
         </div>
         <!-- /.body-->
         <div class="box-footer">
            <center>
            <button type="submit" class="btn btn-info" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Registrar Nuevo Voucher de Pago</span></button>
            <button id="Cancelar" class="btn btn-info" onclick="Cancelar()">
            <i class="fa fa-close">Cancelar</i>
            </button>
            </center>
         </div>
         <!-- /.footer-->
      </div>
      <!-- /.box-->
   </section>
   <!-- /.content -->
<!-- /.content-wrapper -->
<script src="../plugins/jquery-1.10.2.js"></script>
<script src="../plugins/jquery-ui.js"></script>
<script type="text/javascript">
   $('.numero').on('input', function () { 
      this.value = this.value.replace(/[^0-9]/g,'');
   });
</script>
<script type="text/javascript">
   $(function() {
      $("#apoderado").autocomplete({
         source: "busquedaapoderado.php",
         minLength: 2,
         select: function(event, ui) {
            event.preventDefault();
            $('#apoderado').val(ui.item.nombre_apoderado);
            $('#idapoderado').val(ui.item.id_apoderado);
         }
      });
   });
</script>
<script type="text/javascript">
   function Registrar() {
      var error = 0;

      $('.requerido').each(function(i, elem){
         if($(elem).val() == ''){
            $(elem).css({'background-color':'#FFEDFF','border':'1px solid red'});
            error++;
         }
      });

      if(error > 0) {
         event.preventDefault();
         $('#aviso').text(' ■ Se deben completar los campos obligatorios <br />');
         $('#aviso').css({'color':'red','font-size':'12px'});
      } else {
         $("#proceso").attr("value","Registrar");
         $( "form" ).submit();
      }
   }

   function Cancelar() {
      // Recargo la página
      location.href="../informacion/informacion.php";
   }
</script>