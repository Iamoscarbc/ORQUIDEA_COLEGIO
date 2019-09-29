<!DOCTYPE html>
<?php
// include("../seguridad.php");
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$data=$obj->consultar("SELECT * FROM periodo WHERE año=(SELECT YEAR(NOW()))");
foreach($data as $row){
$ano= $row['año'];
$pbfi=$row["pri_bim_fec_inicio"];
$pbff=$row["pri_bim_fec_fin"];
$sbfi=$row["seg_bim_fec_inicio"];
$sbff=$row["seg_bim_fec_fin"];
$tbfi=$row["ter_bim_fec_inicio"];
$tbff=$row["ter_bim_fec_fin"];
$cbfi=$row["cua_bim_fec_inicio"];
$cbff=$row["cua_bim_fec_fin"];
}
?>
<head>
   <link rel="stylesheet" href="../plugins/jquery-ui.css">   
</head>
<div class="content-wrapper">
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title"><b>PERIODO ACADEMICO</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
         <label id="aviso"></label>
            <form action="procesar.php" method="POST">
               <div class="row">
                  <div class="col-md-12">
                     <legend class="text-center">AÑO LECTIVO</legend>
                     <div align="center" style="margin-bottom: 20px;">
                        <div class="input-group col-md-3" align="center">
                           <div class="input-group-addon">
                              <i class="fa fa-ellipsis-h"></i>
                           </div>
                           <input type="number" name="ano" id="ano" class="form-control text-center numero limpiar  requerido" value="<?php echo $ano;?>" placeholder="ingrese el año" maxlength="255">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-bottom: 20px;">
                     <legend class="text-center">PRIMER BIMESTRE</legend>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha de Inicio:</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="pbfi" id="pbfi" class="form-control habilitado limpiar requerido" value="<?php echo $pbfi;?>" disabled>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha Final:</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="pbff" id="pbff" class="form-control habilitado limpiar requerido" value="<?php echo $pbff;?>" disabled>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-bottom: 20px;">
                     <legend class="text-center">SEGUNDO BIMESTRE</legend>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha de Inicio:</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="sbfi" id="sbfi" class="form-control habilitado limpiar requerido" value="<?php echo $sbfi;?>" disabled>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha Final:</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="sbff" id="sbff" class="form-control habilitado limpiar requerido" value="<?php echo $sbff;?>" disabled>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-bottom: 20px;">
                     <legend class="text-center">TERCER BIMESTRE</legend>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha de Inicio:</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="tbfi" id="tbfi" class="form-control habilitado limpiar requerido" value="<?php echo $tbfi;?>" disabled>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha Final:</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="tbff" id="tbff" class="form-control habilitado limpiar requerido" value="<?php echo $tbff;?>" disabled>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="margin-bottom: 20px;">
                     <legend class="text-center">CUARTO BIMESTRE</legend>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha de Inicio:</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="cbfi" id="cbfi" class="form-control habilitado limpiar requerido" value="<?php echo $cbfi;?>" disabled>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Fecha Final:</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="cbff" id="cbff" class="form-control habilitado limpiar requerido" value="<?php echo $cbff;?>" disabled>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
               <input type="hidden" name="proceso" id="proceso" value=""/>
            </form>
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
            <center>
            <button type="submit" class="btn btn-info" id="Registrar" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Ingresar Nuevo Periodo</span>
            </button>
            <button type="submit" class="btn btn-info" id="Modificar" onclick="Actualizar()"><i class="fa fa-pencil"></i><span>Actualizar Periodo</span></button>
            <button type="submit" class="btn btn-danger" id="Eliminar" onclick="Eliminar()"><i class="fa fa-pencil"></i><span>Eliminar Periodo</span></button>
            <button id="Cancelar" class="btn btn-info" onclick="Cancelar()">
            <i class="fa fa-close">Cancelar</i>
            </button>
            </center>
         </div>
         <!-- /.box-footer -->
      </div>
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
   $("#ano").autocomplete({
      source: "busquedaPeriodo.php",
      minLength: 1,
      select: function(event, ui) {
         event.preventDefault();
         $('#pbfi').val(ui.item.pbfi);
         $('#pbff').val(ui.item.pbff);
         $('#sbfi').val(ui.item.sbfi);
         $('#sbff').val(ui.item.sbff);
         $('#tbfi').val(ui.item.tbfi);
         $('#tbff').val(ui.item.tbff);
         $('#cbfi').val(ui.item.cbfi);
         $('#cbff').val(ui.item.cbff);
      }
   });
});
</script>

<script type="text/javascript">

   function Registrar(){
      $(".habilitado").prop( "disabled", false );
      $("#Modificar, #Eliminar").hide();
      $("#Registrar span").text("Registrar Nuevo Periodo");
      $(".limpiar").attr('value', '');
      $("#Registrar").click(function(){
         
         var error = 0;

         $('.requerido').each(function(i, elem){
            if($(elem).val() == ''){
               $(elem).css({'background-color':'#FFEDFF','border':'1px solid red'});
               error++;
            }
         });

         if(error > 0) {
            event.preventDefault();
            $('#aviso').text(' ■ Se deben completar los campos obligatorios');
            $('#aviso').css({'color':'red','font-size':'12px'});
         } else {
            $("#proceso").attr("value","Registrar");
            $( "form" ).submit();
         }
      })
   }

   function Actualizar(){
      $("#ano").attr('readonly', true);
      $(".habilitado").prop( "disabled", false );
      $("#Registrar, #Eliminar").hide();
      $("#Modificar span").text("Registrar Actualizacion");
      $("#Modificar").click(function(){

      var error = 0;

      $('.requerido').each(function(i, elem){
         if($(elem).val() == ''){
            $(elem).css({'background-color':'#FFEDFF','border':'1px solid red'});
            error++;
            }
         });

         if(error > 0) {
            event.preventDefault();
            $('#aviso').text(' ■ Se deben completar los campos obligatorios');
            $('#aviso').css({'color':'red','font-size':'12px'});
         } else {
            $("#proceso").attr("value","Modificar");
            $( "form" ).submit();
         }
      });
   }

   function Eliminar(){
      $("#proceso").attr("value","Eliminar");
      $("form").submit();
   }

   function Cancelar() {
      // Recargo la página
      location.href="periodo.php";
   }

</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>