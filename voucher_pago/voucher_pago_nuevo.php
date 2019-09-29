<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");

date_default_timezone_set('america/lima');
$fecha_matricula= date("Y-m-d");
?>
<head>
   <link rel="stylesheet" href="../plugins/jquery-ui.css">
   <style>
      input[type="text"] {
         text-transform:uppercase;
      }
   </style>
</head>
<div class="content-wrapper">
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
            <form action="procesar.php" method="post">
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
                           <input type="file" name="imagen_voucher" class="form-control habilitado" id="field-file" >
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
</div>
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
      location.href="voucher_pago.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>